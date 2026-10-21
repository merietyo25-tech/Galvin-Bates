<?php

namespace App\Providers;

use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\ServiceProvider;
use Symfony\Component\Mailer\Transport\Smtp\EsmtpTransport;
use Symfony\Component\Mailer\Transport\Smtp\Stream\SocketStream;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void {}

    public function boot(): void
    {
        // Sans cela, un simple ->links() rend le theme Tailwind livre par defaut avec
        // Laravel. Le projet n utilise pas Tailwind sur le back-office : la pagination
        // sortait donc sans aucun style. On impose le partial maison partout, y compris
        // pour les vues futures qui oublieraient de le preciser.
        Paginator::defaultView('partials.pagination');
        Paginator::defaultSimpleView('partials.pagination');

        $this->configureResetPasswordMail();

        Mail::extend('smtp-no-verify', function (array $config) {
            // $tls = null : laisse Symfony choisir TLS implicite (port 465) ou
            // STARTTLS (587) selon le port — seule la vérification du certificat
            // est désactivée ci-dessous, pas le chiffrement lui-même.
            $transport = new EsmtpTransport(
                $config['host'] ?? 'localhost',
                (int) ($config['port'] ?? 587),
                null
            );
            $transport->setUsername($config['username'] ?? '');
            $transport->setPassword($config['password'] ?? '');

            $stream = $transport->getStream();
            if ($stream instanceof SocketStream) {
                $stream->setStreamOptions([
                    'ssl' => [
                        'verify_peer'       => false,
                        'verify_peer_name'  => false,
                        'allow_self_signed' => true,
                    ],
                ]);
            }

            return $transport;
        });
    }

    private function configureResetPasswordMail(): void
    {
        ResetPassword::toMailUsing(function ($notifiable, string $token) {
            $locale  = $notifiable->locale ?? 'fr';
            $url     = route('password.reset', ['token' => $token, 'email' => $notifiable->email]);
            $expire  = (int) config('auth.passwords.users.expire', 60);

            $subjects = [
                'fr' => 'Réinitialisation de votre mot de passe — ' . site_name(),
                'en' => 'Reset your password — ' . site_name(),
                'es' => 'Restablecimiento de su contraseña — ' . site_name(),
                'pl' => 'Resetowanie hasła — ' . site_name(),
                'bg' => 'Нулиране на паролата ви — ' . site_name(),
                'hu' => 'Jelszó visszaállítása — ' . site_name(),
                'it' => 'Reimposta la tua password — ' . site_name(),
                'de' => 'Zurücksetzen Ihres Passworts — ' . site_name(),
                'lt' => 'Slaptažodžio atkūrimas — ' . site_name(),
                'ro' => 'Resetarea parolei dumneavoastră — ' . site_name(),
                'lv' => 'Paroles atiestatīšana — ' . site_name(),
                'nl' => 'Uw wachtwoord opnieuw instellen — ' . site_name(),
                'pt' => 'Redefinição da sua palavra-passe — ' . site_name(),
            ];

            return (new MailMessage)
                ->subject($subjects[$locale] ?? $subjects['fr'])
                ->view('emails.password-reset', [
                    'url'            => $url,
                    'user'           => $notifiable,
                    'locale'         => $locale,
                    'expireMinutes'  => $expire,
                ]);
        });
    }
}
