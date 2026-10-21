<?php

namespace App\Notifications;

use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class StaffResetPasswordNotification extends Notification
{
    public function __construct(public string $token) {}

    public function via($notifiable): array
    {
        return ['mail'];
    }

    public function toMail($notifiable): MailMessage
    {
        $locale = $notifiable->locale ?? 'fr';
        $url    = route('staff.password.reset', [
            'token' => $this->token,
            'email' => $notifiable->getEmailForPasswordReset(),
        ]);
        $expire = (int) config('auth.passwords.users.expire', 60);

        $subjects = [
            'fr' => 'Réinitialisation de votre mot de passe administrateur — ' . site_name(),
            'en' => 'Reset your administrator password — ' . site_name(),
            'es' => 'Restablecimiento de su contraseña de administrador — ' . site_name(),
            'pl' => 'Resetowanie hasła administratora — ' . site_name(),
            'bg' => 'Нулиране на администраторската ви парола — ' . site_name(),
            'hu' => 'Adminisztrátori jelszó visszaállítása — ' . site_name(),
            'it' => 'Reimposta la tua password amministratore — ' . site_name(),
            'de' => 'Zurücksetzen Ihres Administrator-Passworts — ' . site_name(),
            'lt' => 'Administratoriaus slaptažodžio atkūrimas — ' . site_name(),
            'ro' => 'Resetarea parolei dumneavoastră de administrator — ' . site_name(),
            'lv' => 'Administratora paroles atiestatīšana — ' . site_name(),
            'nl' => 'Uw beheerderswachtwoord opnieuw instellen — ' . site_name(),
            'pt' => 'Redefinição da sua palavra-passe de administrador — ' . site_name(),
        ];

        return (new MailMessage)
            ->subject($subjects[$locale] ?? $subjects['fr'])
            ->view('emails.password-reset', [
                'url'           => $url,
                'user'          => $notifiable,
                'locale'        => $locale,
                'expireMinutes' => $expire,
                'portal'        => 'staff',
            ]);
    }
}
