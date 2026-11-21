<?php

namespace App\Models;

use App\Mail\ClientNotificationMail;
use App\Services\PushService;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ClientNotification extends Model
{
    protected $fillable = ['user_id', 'type', 'icon', 'title', 'body', 'data', 'read_at'];

    protected $casts = [
        'data'     => 'array',
        'read_at'  => 'datetime',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function isUnread(): bool
    {
        return is_null($this->read_at);
    }

    /**
     * Notification dans l'espace client, traduite dans la langue du client.
     * $mail = false quand l'action envoie déjà son propre e-mail (virement, facture, KYC…), pour éviter un doublon.
     */
    public static function notifyUser(User $user, string $type, string $titleKey, string $bodyKey, array $params = [], array $data = [], bool $mail = true): self
    {
        $locale = $user->locale ?? config('app.locale', 'fr');
        return self::forUser($user->id, $type, __($titleKey, $params, $locale), __($bodyKey, $params, $locale), $data, $mail);
    }

    public static function forUser(int $userId, string $type, string $title, string $body, array $data = [], bool $mail = true): self
    {
        $iconMap = [
            'transfer'    => 'paper-plane',
            'loan_update' => 'file-contract',
            'credit'      => 'circle-plus',
            'debit'       => 'circle-minus',
            'system'      => 'bell',
        ];

        $notification = self::create([
            'user_id' => $userId,
            'type'    => $type,
            'icon'    => $iconMap[$type] ?? 'bell',
            'title'   => $title,
            'body'    => $body,
            'data'    => $data ?: null,
        ]);

        // Envoyer une push notification si l'utilisateur a des subscriptions
        try {
            $user = $notification->user;
            if ($user && PushSubscription::where('user_id', $userId)->exists()) {
                $url = $data['url'] ?? '/app/notifications';
                (new PushService())->sendToUser($user, $title, $body, $url, $type);
            }
        } catch (\Throwable $e) {
            Log::error('[Push] sendToUser exception for user ' . $userId . ': ' . $e->getMessage(), [
                'exception' => get_class($e),
                'file'      => $e->getFile() . ':' . $e->getLine(),
            ]);
        }

        // E-mail au client, dans sa langue (envoyé après validation de la transaction en cours)
        if ($mail) {
            DB::afterCommit(fn () => self::sendMail($userId, $type, $title, $body, $data));
        }

        return $notification;
    }

    private static function sendMail(int $userId, string $type, string $title, string $body, array $data): void
    {
        try {
            $user = User::find($userId);
            if (! $user || ! $user->email) {
                return;
            }
            Mail::to($user->email)
                ->locale($user->locale ?: 'fr')
                ->send(new ClientNotificationMail($user, $title, $body, $type, $data));
        } catch (\Throwable $e) {
            Log::error('[ClientNotificationMail] user ' . $userId . ' : ' . $e->getMessage());
        }
    }
}
