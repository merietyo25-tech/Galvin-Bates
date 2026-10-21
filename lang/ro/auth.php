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

    'failed'   => 'Aceste date de autentificare nu corespund înregistrărilor noastre.',
    'password' => 'Parola introdusă este incorectă.',
    'throttle' => 'Prea multe încercări. Încercați din nou peste :seconds secunde.',

    'client_login_title'  => 'Zona Clienți',
    'client_login_sub'    => 'Conectați-vă pentru a accesa cererile dumneavoastră de împrumut',
    'client_brand_title'  => 'Spațiul dumneavoastră<br>client ' . site_name(),
    'client_brand_sub'    => 'Urmăriți-vă cererile, gestionați-vă profilul și accesați toate documentele dumneavoastră în deplină siguranță.',

    'staff_login_title'   => 'Portal Administrare',
    'staff_login_sub'     => 'Rezervat exclusiv personalului autorizat',
    'staff_brand_title'   => 'Administrare<br>' . site_name(),
    'staff_brand_sub'     => 'Acces securizat la instrumentele de gestionare, urmărirea dosarelor și administrarea utilizatorilor.',

    'email'               => 'Adresă de e-mail',
    'email_staff'         => 'E-mail profesional',
    'email_ph'            => 'dvs@exemplu.com',
    'email_ph_staff'      => 'agent@mellenthinfinancial.online',
    'password_label'      => 'Parolă',
    'remember'            => 'Ține-mă minte',
    'remember_staff'      => 'Rămâi conectat',
    'submit'              => 'Conectare',
    'submit_staff'        => 'Accesează tabloul de bord',
    'back_site'           => 'Înapoi la site',
    'staff_portal_link'   => 'Portal agent / administrator',
    'client_portal_link'  => 'Zona Clienți',
    'staff_restricted'    => 'Acces restricționat — doar personal autorizat',
    'staff_notice'        => 'Acest portal este rezervat personalului ' . site_name() . '. Toate conectările sunt înregistrate.',
    'or_staff'            => 'Sunteți agent sau administrator?',
    'or_client'           => 'Sunteți client?',

    'stat_clients'        => 'Clienți mulțumiți',
    'stat_amount'         => 'Împrumut max. / dosar',
    'stat_time'           => 'Răspuns garantat',
    'stat_years'          => 'Ani de experiență',

    'feature_secure'      => 'Date criptate',
    'feature_currencies'  => '6 valute acceptate',
    'feature_certified'   => 'Certificat UE',
    'feature_fast'        => 'Răspuns în 48h',

    'role_superadmin'     => 'Super Administrator',
    'role_superadmin_sub' => 'Gestionare globală și roluri',
    'role_admin'          => 'Administrator',
    'role_admin_sub'      => 'Gestionarea dosarelor',

    'identifier'          => 'E-mail sau telefon',
    'identifier_ph'       => 'dvs@email.com sau +40...',
    'forgot_password'     => 'Ați uitat parola?',
    'portal_clients_only' => 'Acest portal este destinat exclusiv clienților.',

    'otp_title'           => 'Verificare',
    'otp_heading'         => 'Cod de securitate',
    'otp_subtitle'        => 'Am trimis un cod din 6 cifre la',
    'otp_enter'           => 'Introduceți codul primit prin e-mail',
    'otp_verify_btn'      => 'Verifică',
    'otp_resend'          => 'Retrimite codul',
    'otp_resend_in'       => 'Retrimite în',
    'otp_back'            => 'Schimbă contul',
    'otp_verifying'       => 'Se verifică…',
    'otp_invalid'         => 'Cod incorect. Vă mai rămân :remaining încercare(-ări).',
    'otp_expired'         => 'Acest cod a expirat. Solicitați unul nou.',
    'otp_too_many'        => 'Prea multe încercări. Încercați din nou peste :seconds secunde.',
    'otp_resend_limit'    => 'Prea multe retrimiteri. Încercați din nou peste câteva minute.',
    'otp_send_failed'     => 'Codul nu a putut fi trimis. Încercați din nou.',
    'otp_session_expired' => 'Sesiunea a expirat. Vă rugăm să vă reconectați.',
    'otp_resend_success'  => 'Cod nou trimis!',

    // Remembered account
    'change_account' => 'Schimbă contul',

    // Account blocked
    'account_blocked'                     => 'Contul dumneavoastră a fost blocat după prea multe încercări incorecte. Verificați e-mailul pentru linkul de deblocare.',
    'account_blocked_notified'            => 'Prea multe încercări incorecte. Contul dumneavoastră a fost blocat. Un link de deblocare v-a fost trimis prin e-mail.',
    'account_unblocked'                   => 'Contul dumneavoastră a fost deblocat cu succes. Vă puteți conecta acum.',
    'unblock_invalid'                     => 'Acest link de deblocare este invalid sau a expirat. Vă rugăm să contactați asistența.',

    'account_blocked_email_subject'       => 'Contul dumneavoastră ' . site_name() . ' a fost blocat',
    'account_blocked_email_title'         => 'Cont blocat temporar',
    'account_blocked_email_intro'         => 'Contul dumneavoastră a fost blocat temporar în urma mai multor încercări de conectare incorecte.',
    'account_blocked_email_reason_title'  => 'De ce a fost blocat contul meu?',
    'account_blocked_email_reason_body'   => 'Au fost introduse 4 coduri OTP incorecte consecutiv în timpul unei încercări de conectare. Din motive de securitate, accesul a fost suspendat.',
    'account_blocked_email_btn'           => 'Deblochează contul meu',
    'account_blocked_email_fallback'      => 'Dacă butonul nu funcționează, copiați acest link în browser:',
    'account_blocked_email_notice'        => 'Dacă nu dumneavoastră ați efectuat aceste încercări, nu accesați acest link și contactați imediat asistența ' . site_name() . '.',
    'account_blocked_email_footer'        => 'Link valabil 48 de ore.',

    'otp_email_subject'      => 'Codul dumneavoastră de conectare — ' . site_name(),
    'otp_email_title'        => 'Cod de verificare',
    'otp_email_intro'        => 'Iată codul dumneavoastră de conectare de unică folosință. Nu îl comunicați nimănui.',
    'otp_email_code_label'   => 'Codul dumneavoastră',
    'otp_email_expiry'       => 'Acest cod expiră în 10 minute.',
    'otp_email_notice_title' => 'Notificare importantă de securitate',
    'otp_email_notice_body'  => site_name() . ' nu vă va solicita niciodată acest cod prin telefon sau mesaj. Dacă nu ați solicitat acest cod, ignorați acest e-mail.',
    'otp_email_footer'       => 'Dacă nu ați solicitat acest cod, ignorați acest e-mail.',

    // PWA install banner (login pages)
    'pwa_install_title' => 'Instalează aplicația',
    'pwa_install_hint'  => 'Acces rapid · Notificări · Mod offline',
    'pwa_install_btn'   => 'Instalează',
    'pwa_ios_title'     => 'Instalează aplicația ' . site_name() . ' pe iPhone-ul dumneavoastră',
    'pwa_ios_step1'     => 'Atingeți <strong>Distribuire</strong> în Safari',
    'pwa_ios_step2'     => 'Alegeți <strong>Adaugă pe ecranul principal</strong>',
    'pwa_ios_step3'     => 'Atingeți <strong>Adaugă</strong> — gata!',
    'pwa_close'         => 'Închide',

];
