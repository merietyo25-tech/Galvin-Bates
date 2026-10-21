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

    'failed'   => 'Deze inloggegevens komen niet overeen met een account.',
    'password' => 'Het opgegeven wachtwoord is onjuist.',
    'throttle' => 'Te veel pogingen. Probeer het over :seconds seconden opnieuw.',

    'client_login_title'  => 'Klantenzone',
    'client_login_sub'    => 'Log in om toegang te krijgen tot uw dossiers',
    'client_brand_title'  => 'Uw klantenzone<br>bij ' . site_name(),
    'client_brand_sub'    => 'Volg uw aanvragen, beheer uw profiel en krijg op een veilige manier toegang tot al uw documenten.',

    'staff_login_title'   => 'Beheerportaal',
    'staff_login_sub'     => 'Uitsluitend voorbehouden aan bevoegd personeel',
    'staff_brand_title'   => 'Beheer<br>' . site_name(),
    'staff_brand_sub'     => 'Beveiligde toegang tot de beheertools, dossieropvolging en gebruikersbeheer.',

    'email'               => 'E-mailadres',
    'email_staff'         => 'Zakelijk e-mailadres',
    'email_ph'            => 'u@voorbeeld.com',
    'email_ph_staff'      => 'agent@mellenthinfinancial.online',
    'password_label'      => 'Wachtwoord',
    'remember'            => 'Onthoud mij',
    'remember_staff'      => 'Aangemeld blijven',
    'submit'              => 'Inloggen',
    'submit_staff'        => 'Naar het dashboard',
    'back_site'           => 'Terug naar de website',
    'staff_portal_link'   => 'Portaal voor medewerkers/beheerders',
    'client_portal_link'  => 'Klantenzone',
    'staff_restricted'    => 'Beperkte toegang — Bevoegd personeel',
    'staff_notice'        => 'Dit portaal is uitsluitend bestemd voor medewerkers van ' . site_name() . '. Alle aanmeldingen worden geregistreerd.',
    'or_staff'            => 'Bent u medewerker of beheerder?',
    'or_client'           => 'Bent u klant?',

    'stat_clients'        => 'Tevreden klanten',
    'stat_amount'         => 'Max. lening / dossier',
    'stat_time'           => 'Gegarandeerde reactietijd',
    'stat_years'          => "Jaar ervaring",

    'feature_secure'      => 'Versleutelde gegevens',
    'feature_currencies'  => '6 geaccepteerde valuta',
    'feature_certified'   => 'Europese erkenning',
    'feature_fast'        => 'Reactie binnen 24 uur',

    'role_superadmin'     => 'Superbeheerder',
    'role_superadmin_sub' => 'Algemeen beheer & rollen',
    'role_admin'          => 'Beheerder',
    'role_admin_sub'      => 'Dossierbeheer',

    // Identifier (email or phone)
    'identifier'          => 'E-mail of telefoon',
    'identifier_ph'       => 'uw@email.com of +31...',
    'forgot_password'     => 'Wachtwoord vergeten?',
    'portal_clients_only' => 'Dit portaal is uitsluitend bestemd voor klanten.',

    // OTP page
    'otp_title'           => 'Verificatie',
    'otp_heading'         => 'Beveiligingscode',
    'otp_subtitle'        => 'We hebben een 6-cijferige code verzonden naar',
    'otp_enter'           => 'Voer de code in die u per e-mail hebt ontvangen',
    'otp_verify_btn'      => 'Verifiëren',
    'otp_resend'          => 'Code opnieuw versturen',
    'otp_resend_in'       => 'Opnieuw versturen over',
    'otp_back'            => 'Van account wisselen',
    'otp_verifying'       => 'Bezig met verifiëren…',
    'otp_invalid'         => 'Onjuiste code. U heeft nog :remaining poging(en) over.',
    'otp_expired'         => 'Deze code is verlopen. Vraag een nieuwe aan.',
    'otp_too_many'        => 'Te veel pogingen. Probeer het over :seconds seconden opnieuw.',
    'otp_resend_limit'    => 'Te veel verzoeken om opnieuw te versturen. Probeer het over enkele minuten opnieuw.',
    'otp_send_failed'     => 'De code kon niet worden verzonden. Probeer het opnieuw.',
    'otp_session_expired' => 'Sessie verlopen. Log opnieuw in.',
    'otp_resend_success'  => 'Nieuwe code verzonden!',

    // Compte mémorisé
    'change_account' => 'Van account wisselen',

    // Compte bloqué
    'account_blocked'                     => 'Uw account is geblokkeerd na te veel onjuiste pogingen. Raadpleeg uw e-mail voor de deblokkeringslink.',
    'account_blocked_notified'            => 'Te veel onjuiste pogingen. Uw account is geblokkeerd. Er is een deblokkeringslink naar uw e-mailadres verzonden.',
    'account_unblocked'                   => 'Uw account is succesvol gedeblokkeerd. U kunt nu inloggen.',
    'unblock_invalid'                     => 'Deze deblokkeringslink is ongeldig of verlopen. Neem contact op met de klantenservice.',

    'account_blocked_email_subject'       => 'Uw account bij ' . site_name() . ' is geblokkeerd',
    'account_blocked_email_title'         => 'Account tijdelijk geblokkeerd',
    'account_blocked_email_intro'         => 'Uw account is tijdelijk geblokkeerd na meerdere onjuiste inlogpogingen.',
    'account_blocked_email_reason_title'  => 'Waarom deze blokkering?',
    'account_blocked_email_reason_body'   => 'Er zijn 4 onjuiste OTP-codes achter elkaar ingevoerd bij een poging om in te loggen op uw account. Uit veiligheidsoverwegingen is de toegang opgeschort.',
    'account_blocked_email_btn'           => 'Mijn account deblokkeren',
    'account_blocked_email_fallback'      => 'Als de knop niet werkt, kopieert u deze link naar uw browser:',
    'account_blocked_email_notice'        => 'Als u niet degene bent die deze pogingen heeft ondernomen, klik dan niet op deze link en neem onmiddellijk contact op met de klantenservice van ' . site_name() . '.',
    'account_blocked_email_footer'        => 'Link 48 uur geldig.',

    // OTP email
    'otp_email_subject'      => 'Uw inlogcode — ' . site_name(),
    'otp_email_title'        => 'Verificatiecode',
    'otp_email_intro'        => 'Hier is uw eenmalige inlogcode. Deel deze met niemand.',
    'otp_email_code_label'   => 'Uw code',
    'otp_email_expiry'       => 'Deze code verloopt over 10 minuten.',
    'otp_email_notice_title' => 'Belangrijke veiligheidsmelding',
    'otp_email_notice_body'  => site_name() . ' zal u nooit telefonisch of per bericht om deze code vragen. Als u deze code niet heeft aangevraagd, kunt u deze e-mail negeren.',
    'otp_email_footer'       => 'Als u deze code niet heeft aangevraagd, kunt u deze e-mail negeren.',

    // Bannière d'installation PWA (pages de connexion)
    'pwa_install_title' => 'App installeren',
    'pwa_install_hint'  => 'Snelle toegang · Meldingen · Offline modus',
    'pwa_install_btn'   => 'Installeren',
    'pwa_ios_title'     => 'Installeer de app van ' . site_name() . ' op uw iPhone',
    'pwa_ios_step1'     => 'Tik op <strong>Delen</strong> in Safari',
    'pwa_ios_step2'     => 'Kies <strong>Zet op beginscherm</strong>',
    'pwa_ios_step3'     => 'Tik op <strong>Voeg toe</strong> — klaar!',
    'pwa_close'         => 'Sluiten',

];
