<?php

namespace App\Services;

use App\Models\SmsMessage;
use App\Models\SmsSetting;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

/**
 * Envoi de SMS via Android SMS Gateway (open-source, gratuit, utilise la carte
 * SIM d'un téléphone Android — https://sms-gate.app). Le pilote "log" écrit
 * simplement dans laravel.log, pour tester sans téléphone.
 */
class SmsService
{
    private SmsSetting $settings;

    public function __construct()
    {
        $this->settings = SmsSetting::current();
    }

    /** Normalise en format international E.164 (+33612345678). Retourne null si invalide. */
    public function normalize(?string $phone): ?string
    {
        $p = preg_replace('/[^\d+]/', '', (string) $phone);
        if ($p === '' || $p === null) {
            return null;
        }
        if (str_starts_with($p, '00')) {
            $p = '+' . substr($p, 2);
        } elseif (! str_starts_with($p, '+')) {
            $cc = ltrim((string) $this->settings->default_country_code, '+');
            if ($cc === '') {
                return null; // pas d'indicatif par défaut : le numéro doit commencer par + ou 00
            }
            $p = '+' . $cc . ltrim($p, '0');
        }

        return preg_match('/^\+\d{8,15}$/', $p) ? $p : null;
    }

    /**
     * Envoie un SMS et journalise le résultat.
     *
     * @return array{ok:bool,error:?string}
     */
    public function send(string $phone, string $body, ?int $userId = null, ?int $sentBy = null, ?string $batchId = null): array
    {
        $message = $this->enqueue($phone, $body, $userId, $sentBy, $batchId);

        return $this->deliver($message);
    }

    /** Crée le message en base (statut "pending", ou "failed" si le numéro est invalide) sans l'envoyer. */
    public function enqueue(string $phone, string $body, ?int $userId = null, ?int $sentBy = null, ?string $batchId = null): SmsMessage
    {
        $number = $this->normalize($phone);

        return SmsMessage::create([
            'batch_id' => $batchId ?? (string) Str::uuid(),
            'user_id'  => $userId,
            'sent_by'  => $sentBy,
            'phone'    => $number ?? $phone,
            'body'     => $body,
            'status'   => $number ? 'pending' : 'failed',
            'error'    => $number ? null : "Numéro invalide : ajoutez l'indicatif du pays (ex. +229...)",
        ]);
    }

    /**
     * Envoie un message "pending" et met à jour son statut.
     *
     * @return array{ok:bool,error:?string}
     */
    public function deliver(SmsMessage $message): array
    {
        if ($message->status !== 'pending') {
            return ['ok' => in_array($message->status, ['queued', 'sent', 'delivered'], true), 'error' => $message->error];
        }

        $result = $this->settings->enabled
            ? $this->dispatch($message->phone, $message->body)
            : ['ok' => false, 'error' => 'Service SMS désactivé'];

        // Accepté par la passerelle ≠ envoyé : le téléphone doit encore le récupérer et
        // l'envoyer avec sa SIM. On garde son identifiant pour suivre l'état réel.
        $status = ! $result['ok'] ? 'failed' : (! empty($result['gateway_id']) ? 'queued' : 'sent');

        $message->update([
            'status'     => $status,
            'gateway_id' => $result['gateway_id'] ?? null,
            'error'      => $result['error'],
        ]);

        return $result;
    }

    /**
     * Met à jour l'état des SMS transmis à la passerelle (« queued ») en l'interrogeant.
     * États de SMS Gateway : Pending / Processed (pas encore parti), Sent, Delivered, Failed.
     *
     * @param  iterable<SmsMessage>  $messages
     */
    public function refreshStatuses(iterable $messages, int $max = 15): void
    {
        if ($this->settings->driver === 'log' || ! $this->settings->api_url) {
            return;
        }

        $done = 0;
        foreach ($messages as $message) {
            if ($done >= $max) {
                break;
            }
            if (! $message->gateway_id || ! in_array($message->status, ['queued', 'sent'], true)) {
                continue;
            }
            $done++;

            try {
                $res = Http::timeout(6)
                    ->withBasicAuth((string) $this->settings->username, (string) $this->settings->password)
                    ->acceptJson()
                    ->get($this->endpoint() . '/' . rawurlencode($message->gateway_id));
            } catch (\Throwable) {
                return; // passerelle injoignable : on réessaiera au prochain affichage
            }
            if (! $res->successful()) {
                continue;
            }

            $state     = strtolower((string) ($res->json('recipients.0.state') ?? $res->json('state')));
            $recipError = $res->json('recipients.0.error');

            $new = match ($state) {
                'delivered' => 'delivered',
                'sent'      => 'sent',
                'failed'    => 'failed',
                default     => 'queued', // pending, processed
            };

            if ($new !== $message->status) {
                $message->update([
                    'status' => $new,
                    'error'  => $new === 'failed' ? Str::limit('Échec sur le téléphone : ' . ($recipError ?: 'raison inconnue'), 250) : null,
                ]);
            }
        }
    }

    private function dispatch(string $number, string $body): array
    {
        if ($this->settings->driver === 'log') {
            Log::info("[SMS] {$number}: {$body}");
            return ['ok' => true, 'error' => null];
        }

        if (! $this->settings->api_url) {
            return ['ok' => false, 'error' => 'URL de la passerelle non configurée'];
        }

        try {
            $response = Http::timeout(15)
                ->withBasicAuth((string) $this->settings->username, (string) $this->settings->password)
                ->acceptJson()
                ->post($this->endpoint(), array_filter([
                    'message'      => $body,
                    'phoneNumbers' => [$number],
                    // SIM imposée sur un téléphone double SIM (sinon choix automatique)
                    'simNumber'    => $this->settings->sim_number ?: null,
                ], fn ($v) => $v !== null));

            if ($response->successful()) {
                return ['ok' => true, 'error' => null, 'gateway_id' => $response->json('id')];
            }

            $hint = match ($response->status()) {
                401, 403 => " — identifiant ou mot de passe de la passerelle incorrect (voir l'appli SMS Gateway sur le téléphone)",
                404      => " — adresse de la passerelle incorrecte ({$this->endpoint()}). Cloud : https://api.sms-gate.app/3rdparty/v1 · Local : http://IP-du-téléphone:8080",
                default  => '',
            };

            return ['ok' => false, 'error' => Str::limit('HTTP ' . $response->status() . $hint . ' ' . $response->body(), 250)];
        } catch (\Throwable $e) {
            Log::warning('[SMS] ' . $e->getMessage());
            return ['ok' => false, 'error' => Str::limit($e->getMessage(), 200)];
        }
    }

    /**
     * Adresse d'envoi. Accepte :
     *  - mode local : "http://192.168.1.20:8080" (ou ".../message") ;
     *  - mode cloud : toute saisie pointant vers sms-gate.app, même incomplète
     *    ("https://api.sms-gate.app", "https://sms-gate.app", ".../3rdparty/v1/messages"…),
     *    ramenée à l'unique adresse valide https://api.sms-gate.app/3rdparty/v1/message.
     *    (Sans « /3rdparty/v1 », l'API cloud répond 404 Not Found.)
     */
    public function endpoint(): string
    {
        $url = rtrim(trim((string) $this->settings->api_url), '/');
        $url = preg_replace('#/messages?$#', '', $url);

        // Adresse recopiée sans protocole (l'appli affiche « api.sms-gate.app:443 »)
        if ($url !== '' && ! preg_match('#^https?://#i', $url)) {
            $url = 'http://' . $url;
        }

        $host = (string) parse_url($url, PHP_URL_HOST);
        if ($host === 'sms-gate.app' || str_ends_with($host, '.sms-gate.app')) {
            return 'https://api.sms-gate.app/3rdparty/v1/message';
        }

        return $url . '/message';
    }
}
