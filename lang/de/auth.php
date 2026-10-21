<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Authentication Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines are used during authentication for various
    | messages that we need to display to the user. You are free to modify
    | these language lines according to your application's requirements.
    |
    */

    'failed'   => 'Diese Zugangsdaten stimmen nicht mit unseren Unterlagen überein.',
    'password' => 'Das eingegebene Passwort ist falsch.',
    'throttle' => 'Zu viele Anmeldeversuche. Bitte versuchen Sie es in :seconds Sekunden erneut.',

    'client_login_title'  => 'Kundenportal',
    'client_login_sub'    => 'Melden Sie sich an, um auf Ihre Kreditanträge zuzugreifen',
    'client_brand_title'  => 'Ihr ' . site_name() . '<br>Kundenbereich',
    'client_brand_sub'    => 'Verfolgen Sie Ihre Anträge, verwalten Sie Ihr Profil und greifen Sie sicher auf alle Ihre Dokumente zu.',

    'staff_login_title'   => 'Verwaltungsportal',
    'staff_login_sub'     => 'Nur für autorisiertes Personal',
    'staff_brand_title'   => site_name() . '<br>Verwaltung',
    'staff_brand_sub'     => 'Sicherer Zugriff auf Verwaltungstools, Vorgangsverfolgung und Benutzerverwaltung.',

    'email'               => 'E-Mail-Adresse',
    'email_staff'         => 'Berufliche E-Mail',
    'email_ph'            => 'sie@beispiel.de',
    'email_ph_staff'      => 'agent@mellenthinfinancial.online',
    'password_label'      => 'Passwort',
    'remember'            => 'Angemeldet bleiben',
    'remember_staff'      => 'Angemeldet bleiben',
    'submit'              => 'Anmelden',
    'submit_staff'        => 'Zum Dashboard',
    'back_site'           => 'Zurück zur Website',
    'staff_portal_link'   => 'Mitarbeiter-/Admin-Portal',
    'client_portal_link'  => 'Kundenbereich',
    'staff_restricted'    => 'Eingeschränkter Zugang — Nur autorisiertes Personal',
    'staff_notice'        => 'Dieses Portal ist ausschließlich für ' . site_name() . ' Mitarbeiter reserviert. Alle Anmeldungen werden protokolliert.',
    'or_staff'            => 'Sind Sie Mitarbeiter oder Administrator?',
    'or_client'           => 'Sind Sie Kunde?',

    'stat_clients'        => 'Zufriedene Kunden',
    'stat_amount'         => 'Max. Kredit / Akte',
    'stat_time'           => 'Garantierte Antwortzeit',
    'stat_years'          => 'Jahre Erfahrung',

    'feature_secure'      => 'Verschlüsselte Daten',
    'feature_currencies'  => '6 akzeptierte Währungen',
    'feature_certified'   => 'EU-zertifiziert',
    'feature_fast'        => 'Antwort innerhalb von 48h',

    'role_superadmin'     => 'Superadministrator',
    'role_superadmin_sub' => 'Globale Verwaltung & Rollen',
    'role_admin'          => 'Administrator',
    'role_admin_sub'      => 'Aktenverwaltung',

    'identifier'          => 'E-Mail oder Telefon',
    'identifier_ph'       => 'ihre@email.de oder +49...',
    'forgot_password'     => 'Passwort vergessen?',
    'portal_clients_only' => 'Dieses Portal ist ausschließlich für Kunden bestimmt.',

    'otp_title'           => 'Verifizierung',
    'otp_heading'         => 'Sicherheitscode',
    'otp_subtitle'        => 'Wir haben einen 6-stelligen Code gesendet an',
    'otp_enter'           => 'Geben Sie den per E-Mail erhaltenen Code ein',
    'otp_verify_btn'      => 'Bestätigen',
    'otp_resend'          => 'Code erneut senden',
    'otp_resend_in'       => 'Erneut senden in',
    'otp_back'            => 'Konto wechseln',
    'otp_verifying'       => 'Wird überprüft…',
    'otp_invalid'         => 'Ungültiger Code. :remaining Versuch(e) verbleibend.',
    'otp_expired'         => 'Dieser Code ist abgelaufen. Fordern Sie einen neuen an.',
    'otp_too_many'        => 'Zu viele Versuche. Versuchen Sie es in :seconds Sekunden erneut.',
    'otp_resend_limit'    => 'Zu viele Versuche zum erneuten Senden. Versuchen Sie es in ein paar Minuten erneut.',
    'otp_send_failed'     => 'Der Code konnte nicht gesendet werden. Bitte versuchen Sie es erneut.',
    'otp_session_expired' => 'Sitzung abgelaufen. Bitte melden Sie sich erneut an.',
    'otp_resend_success'  => 'Neuer Code gesendet!',

    // Remembered account
    'change_account' => 'Konto wechseln',

    // Account blocked
    'account_blocked'                     => 'Ihr Konto wurde nach zu vielen fehlgeschlagenen Versuchen gesperrt. Prüfen Sie Ihre E-Mails auf den Entsperrlink.',
    'account_blocked_notified'            => 'Zu viele fehlgeschlagene Versuche. Ihr Konto wurde gesperrt. Ein Entsperrlink wurde an Ihre E-Mail-Adresse gesendet.',
    'account_unblocked'                   => 'Ihr Konto wurde erfolgreich entsperrt. Sie können sich jetzt anmelden.',
    'unblock_invalid'                     => 'Dieser Entsperrlink ist ungültig oder abgelaufen. Bitte kontaktieren Sie den Support.',

    'account_blocked_email_subject'       => 'Ihr ' . site_name() . ' Konto wurde gesperrt',
    'account_blocked_email_title'         => 'Konto vorübergehend gesperrt',
    'account_blocked_email_intro'         => 'Ihr Konto wurde nach mehreren fehlgeschlagenen Anmeldeversuchen vorübergehend gesperrt.',
    'account_blocked_email_reason_title'  => 'Warum wurde mein Konto gesperrt?',
    'account_blocked_email_reason_body'   => 'Bei einem Anmeldeversuch wurden 4 falsche OTP-Codes hintereinander eingegeben. Aus Sicherheitsgründen wurde der Zugriff ausgesetzt.',
    'account_blocked_email_btn'           => 'Mein Konto entsperren',
    'account_blocked_email_fallback'      => 'Falls die Schaltfläche nicht funktioniert, kopieren Sie diesen Link in Ihren Browser:',
    'account_blocked_email_notice'        => 'Wenn Sie diese Versuche nicht selbst unternommen haben, klicken Sie nicht auf diesen Link und kontaktieren Sie umgehend den ' . site_name() . ' Support.',
    'account_blocked_email_footer'        => 'Link gültig für 48 Stunden.',

    'otp_email_subject'      => 'Ihr Anmeldecode — ' . site_name(),
    'otp_email_title'        => 'Bestätigungscode',
    'otp_email_intro'        => 'Hier ist Ihr einmaliger Anmeldecode. Geben Sie ihn niemals an Dritte weiter.',
    'otp_email_code_label'   => 'Ihr Code',
    'otp_email_expiry'       => 'Dieser Code läuft in 10 Minuten ab.',
    'otp_email_notice_title' => 'Wichtiger Sicherheitshinweis',
    'otp_email_notice_body'  => site_name() . ' wird Sie niemals telefonisch oder per Nachricht nach diesem Code fragen. Wenn Sie diesen Code nicht angefordert haben, ignorieren Sie bitte diese E-Mail.',
    'otp_email_footer'       => 'Wenn Sie diesen Code nicht angefordert haben, ignorieren Sie diese E-Mail.',

    // PWA install banner (login pages)
    'pwa_install_title' => 'App installieren',
    'pwa_install_hint'  => 'Schneller Zugriff · Benachrichtigungen · Offline-Modus',
    'pwa_install_btn'   => 'Installieren',
    'pwa_ios_title'     => 'Installieren Sie die ' . site_name() . ' App auf Ihrem iPhone',
    'pwa_ios_step1'     => 'Tippen Sie in Safari auf <strong>Teilen</strong>',
    'pwa_ios_step2'     => 'Wählen Sie <strong>Zum Home-Bildschirm</strong>',
    'pwa_ios_step3'     => 'Tippen Sie auf <strong>Hinzufügen</strong> — fertig!',
    'pwa_close'         => 'Schließen',

];
