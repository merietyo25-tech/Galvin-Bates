<?php

return [

    'failed'   => 'Aquestes credencials no coincideixen amb els nostres registres.',
    'password' => 'La contrasenya indicada és incorrecta.',
    'throttle' => 'Massa intents d\'inici de sessió. Torneu-ho a provar d\'aquí a :seconds segons.',

    'client_login_title'  => 'Espai client',
    'client_login_sub'    => 'Inicieu sessió per accedir a les vostres sol·licituds de préstec',
    'client_brand_title'  => 'El vostre espai<br>client ' . site_name(),
    'client_brand_sub'    => 'Feu el seguiment de les vostres sol·licituds, gestioneu el vostre perfil i accediu a tots els vostres documents de manera segura.',

    'staff_login_title'   => 'Portal d\'administració',
    'staff_login_sub'     => 'Reservat exclusivament al personal autoritzat',
    'staff_brand_title'   => site_name() . '<br>Administració',
    'staff_brand_sub'     => 'Accés segur a les eines de gestió, al seguiment d\'expedients i a l\'administració d\'usuaris.',

    'email'               => 'Adreça electrònica',
    'email_staff'         => 'Correu professional',
    'email_ph'            => 'vosaltres@exemple.com',
    'email_ph_staff'      => 'agent@mellenthinfinancial.online',
    'password_label'      => 'Contrasenya',
    'remember'            => 'Recorda\'m',
    'remember_staff'      => 'Mantenir la sessió oberta',
    'submit'              => 'Iniciar sessió',
    'submit_staff'        => 'Accedir al tauler',
    'back_site'           => 'Tornar al lloc',
    'staff_portal_link'   => 'Portal d\'agents / administradors',
    'client_portal_link'  => 'Espai client',
    'staff_restricted'    => 'Accés restringit — Només personal autoritzat',
    'staff_notice'        => 'Aquest portal està reservat al personal de ' . site_name() . '. Tots els accessos queden registrats.',
    'or_staff'            => 'Sou agent o administrador?',
    'or_client'           => 'Sou client?',

    'stat_clients'        => 'Clients satisfets',
    'stat_amount'         => 'Préstec màx. / expedient',
    'stat_time'           => 'Resposta garantida',
    'stat_years'          => 'Anys d\'experiència',

    'feature_secure'      => 'Dades xifrades',
    'feature_currencies'  => '6 divises acceptades',
    'feature_certified'   => 'Certificat UE',
    'feature_fast'        => 'Resposta en 48 h',

    'role_superadmin'     => 'Superadministrador',
    'role_superadmin_sub' => 'Gestió global i rols',
    'role_admin'          => 'Administrador',
    'role_admin_sub'      => 'Gestió d\'expedients',

    'identifier'          => 'Correu electrònic o telèfon',
    'identifier_ph'       => 'vosaltres@correu.com o +34...',
    'forgot_password'     => 'Heu oblidat la contrasenya?',
    'portal_clients_only' => 'Aquest portal és només per a clients.',

    'otp_title'           => 'Verificació',
    'otp_heading'         => 'Codi de seguretat',
    'otp_subtitle'        => 'Hem enviat un codi de 6 xifres a',
    'otp_enter'           => 'Introduïu el codi rebut per correu electrònic',
    'otp_verify_btn'      => 'Verificar',
    'otp_resend'          => 'Tornar a enviar el codi',
    'otp_resend_in'       => 'Tornar a enviar d\'aquí a',
    'otp_back'            => 'Canviar de compte',
    'otp_verifying'       => 'S\'està verificant…',
    'otp_invalid'         => 'Codi no vàlid. Queden :remaining intent(s).',
    'otp_expired'         => 'Aquest codi ha caducat. Sol·liciteu-ne un de nou.',
    'otp_too_many'        => 'Massa intents. Torneu-ho a provar d\'aquí a :seconds segons.',
    'otp_resend_limit'    => 'Massa reenviaments. Torneu-ho a provar d\'aquí a uns minuts.',
    'otp_send_failed'     => 'No s\'ha pogut enviar el codi. Torneu-ho a provar.',
    'otp_session_expired' => 'La sessió ha caducat. Torneu a iniciar sessió.',
    'otp_resend_success'  => 'S\'ha enviat un codi nou!',

    // Compte recordat
    'change_account' => 'Canviar de compte',

    // Compte bloquejat
    'account_blocked'                     => 'El vostre compte s\'ha bloquejat després de massa intents incorrectes. Consulteu el vostre correu per rebre l\'enllaç de desbloqueig.',
    'account_blocked_notified'            => 'Massa intents incorrectes. El vostre compte s\'ha bloquejat. Us hem enviat un enllaç de desbloqueig per correu electrònic.',
    'account_unblocked'                   => 'El vostre compte s\'ha desbloquejat correctament. Ja podeu iniciar sessió.',
    'unblock_invalid'                     => 'Aquest enllaç de desbloqueig no és vàlid o ha caducat. Contacteu amb l\'assistència.',

    'account_blocked_email_subject'       => 'El vostre compte ' . site_name() . ' s\'ha bloquejat',
    'account_blocked_email_title'         => 'Compte bloquejat temporalment',
    'account_blocked_email_intro'         => 'El vostre compte s\'ha bloquejat temporalment després de diversos intents d\'inici de sessió incorrectes.',
    'account_blocked_email_reason_title'  => 'Per què s\'ha bloquejat?',
    'account_blocked_email_reason_body'   => 'S\'han introduït 4 codis OTP incorrectes consecutius durant un intent d\'inici de sessió. Per motius de seguretat, l\'accés s\'ha suspès.',
    'account_blocked_email_btn'           => 'Desbloquejar el meu compte',
    'account_blocked_email_fallback'      => 'Si el botó no funciona, copieu aquest enllaç al vostre navegador:',
    'account_blocked_email_notice'        => 'Si no heu fet aquests intents, no feu clic en aquest enllaç i contacteu immediatament amb l\'assistència de ' . site_name() . '.',
    'account_blocked_email_footer'        => 'Enllaç vàlid durant 48 hores.',

    'otp_email_subject'      => 'El vostre codi d\'accés — ' . site_name(),
    'otp_email_title'        => 'Codi de verificació',
    'otp_email_intro'        => 'Aquí teniu el vostre codi d\'accés d\'un sol ús. No el compartiu mai amb ningú.',
    'otp_email_code_label'   => 'El vostre codi',
    'otp_email_expiry'       => 'Aquest codi caduca d\'aquí a 10 minuts.',
    'otp_email_notice_title' => 'Avís de seguretat important',
    'otp_email_notice_body'  => site_name() . ' no us demanarà mai aquest codi per telèfon ni per missatge. Si no l\'heu sol·licitat, ignoreu aquest correu.',
    'otp_email_footer'       => 'Si no heu sol·licitat aquest codi, ignoreu aquest correu.',

    // Bàner d'instal·lació PWA (pàgines d'inici de sessió)
    'pwa_install_title' => 'Instal·lar l\'aplicació',
    'pwa_install_hint'  => 'Accés ràpid · Notificacions · Mode fora de línia',
    'pwa_install_btn'   => 'Instal·lar',
    'pwa_ios_title'     => 'Instal·leu l\'aplicació ' . site_name() . ' al vostre iPhone',
    'pwa_ios_step1'     => 'Toqueu <strong>Compartir</strong> a Safari',
    'pwa_ios_step2'     => 'Trieu <strong>Afegir a la pantalla d\'inici</strong>',
    'pwa_ios_step3'     => 'Toqueu <strong>Afegir</strong> — ja està!',
    'pwa_close'         => 'Tancar',


];
