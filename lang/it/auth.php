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

    'failed'   => 'Queste credenziali non corrispondono ai nostri archivi.',
    'password' => 'La password inserita non è corretta.',
    'throttle' => 'Troppi tentativi. Riprova tra :seconds secondi.',

    'client_login_title'  => 'Area Cliente',
    'client_login_sub'    => 'Accedi per consultare le tue pratiche',
    'client_brand_title'  => 'Il tuo spazio<br>cliente ' . site_name(),
    'client_brand_sub'    => 'Segui le tue richieste, gestisci il tuo profilo e accedi a tutti i tuoi documenti in totale sicurezza.',

    'staff_login_title'   => 'Portale Amministrazione',
    'staff_login_sub'     => 'Riservato esclusivamente al personale autorizzato',
    'staff_brand_title'   => 'Amministrazione<br>' . site_name(),
    'staff_brand_sub'     => 'Accesso sicuro agli strumenti di gestione, monitoraggio delle pratiche e amministrazione degli utenti.',

    'email'               => 'Indirizzo email',
    'email_staff'         => 'Email aziendale',
    'email_ph'            => 'tu@esempio.com',
    'email_ph_staff'      => 'agent@mellenthinfinancial.online',
    'password_label'      => 'Password',
    'remember'            => 'Ricordami',
    'remember_staff'      => 'Resta connesso',
    'submit'              => 'Accedi',
    'submit_staff'        => 'Vai alla dashboard',
    'back_site'           => 'Torna al sito',
    'staff_portal_link'   => 'Portale operatore / amministratore',
    'client_portal_link'  => 'Area cliente',
    'staff_restricted'    => 'Accesso limitato — Personale autorizzato',
    'staff_notice'        => 'Questo portale è riservato agli operatori ' . site_name() . '. Tutti gli accessi vengono registrati.',
    'or_staff'            => 'Sei un operatore o un amministratore?',
    'or_client'           => 'Sei un cliente?',

    'stat_clients'        => 'Clienti soddisfatti',
    'stat_amount'         => 'Prestito max / pratica',
    'stat_time'           => 'Risposta garantita',
    'stat_years'          => 'Anni di esperienza',

    'feature_secure'      => 'Dati crittografati',
    'feature_currencies'  => '6 valute accettate',
    'feature_certified'   => 'Autorizzazione europea',
    'feature_fast'        => 'Risposta entro 24 ore',

    'role_superadmin'     => 'Super amministratore',
    'role_superadmin_sub' => 'Gestione globale e ruoli',
    'role_admin'          => 'Amministratore',
    'role_admin_sub'      => 'Gestione delle pratiche',

    // Identifier (email or phone)
    'identifier'          => 'Email o telefono',
    'identifier_ph'       => 'tua@email.com o +39...',
    'forgot_password'     => 'Password dimenticata?',
    'portal_clients_only' => 'Questo portale è riservato ai clienti.',

    // OTP page
    'otp_title'           => 'Verifica',
    'otp_heading'         => 'Codice di sicurezza',
    'otp_subtitle'        => 'Abbiamo inviato un codice a 6 cifre a',
    'otp_enter'           => 'Inserisci il codice ricevuto via email',
    'otp_verify_btn'      => 'Verifica',
    'otp_resend'          => 'Invia di nuovo il codice',
    'otp_resend_in'       => 'Invia di nuovo tra',
    'otp_back'            => 'Cambia account',
    'otp_verifying'       => 'Verifica in corso…',
    'otp_invalid'         => 'Codice errato. Ti restano :remaining tentativo/i.',
    'otp_expired'         => 'Questo codice è scaduto. Richiedine uno nuovo.',
    'otp_too_many'        => 'Troppi tentativi. Riprova tra :seconds secondi.',
    'otp_resend_limit'    => 'Troppi invii. Riprova tra qualche minuto.',
    'otp_send_failed'     => 'Impossibile inviare il codice. Riprova.',
    'otp_session_expired' => 'Sessione scaduta. Accedi di nuovo.',
    'otp_resend_success'  => 'Nuovo codice inviato!',

    // Compte mémorisé
    'change_account' => 'Cambia account',

    // Compte bloqué
    'account_blocked'                     => 'Il tuo account è bloccato a causa di troppi tentativi errati. Controlla la tua email per ricevere il link di sblocco.',
    'account_blocked_notified'            => 'Troppi tentativi errati. Il tuo account è stato bloccato. Ti è stato inviato un link di sblocco via email.',
    'account_unblocked'                   => 'Il tuo account è stato sbloccato con successo. Ora puoi accedere.',
    'unblock_invalid'                     => 'Questo link di sblocco non è valido o è scaduto. Contatta l\'assistenza.',

    'account_blocked_email_subject'       => 'Il tuo account ' . site_name() . ' è stato bloccato',
    'account_blocked_email_title'         => 'Account temporaneamente bloccato',
    'account_blocked_email_intro'         => 'Il tuo account è stato temporaneamente bloccato a seguito di diversi tentativi di accesso errati.',
    'account_blocked_email_reason_title'  => 'Perché questo blocco?',
    'account_blocked_email_reason_body'   => 'Sono stati inseriti 4 codici OTP errati consecutivamente durante un tentativo di accesso al tuo account. Per motivi di sicurezza, l\'accesso è stato sospeso.',
    'account_blocked_email_btn'           => 'Sblocca il mio account',
    'account_blocked_email_fallback'      => 'Se il pulsante non funziona, copia questo link nel tuo browser:',
    'account_blocked_email_notice'        => 'Se non sei tu all\'origine di questi tentativi, non cliccare su questo link e contatta immediatamente l\'assistenza ' . site_name() . '.',
    'account_blocked_email_footer'        => 'Link valido per 48 ore.',

    // OTP email
    'otp_email_subject'      => 'Il tuo codice di accesso — ' . site_name(),
    'otp_email_title'        => 'Codice di verifica',
    'otp_email_intro'        => 'Ecco il tuo codice di accesso monouso. Non comunicarlo a nessuno.',
    'otp_email_code_label'   => 'Il tuo codice',
    'otp_email_expiry'       => 'Questo codice scade tra 10 minuti.',
    'otp_email_notice_title' => 'Avviso di sicurezza importante',
    'otp_email_notice_body'  => site_name() . ' non ti chiederà mai questo codice per telefono o messaggio. Se non hai richiesto questo codice, ignora questa email.',
    'otp_email_footer'       => 'Se non hai richiesto questo codice, ignora questa email.',

    // Banner di installazione PWA (pagine di accesso)
    'pwa_install_title' => 'Installa l\'app',
    'pwa_install_hint'  => 'Accesso rapido · Notifiche · Modalità offline',
    'pwa_install_btn'   => 'Installa',
    'pwa_ios_title'     => 'Installa l\'app ' . site_name() . ' sul tuo iPhone',
    'pwa_ios_step1'     => 'Tocca <strong>Condividi</strong> in Safari',
    'pwa_ios_step2'     => 'Scegli <strong>Aggiungi a Home</strong>',
    'pwa_ios_step3'     => 'Tocca <strong>Aggiungi</strong> — fatto!',
    'pwa_close'         => 'Chiudi',

];
