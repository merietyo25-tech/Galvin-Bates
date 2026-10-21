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

    'failed'   => 'Ezek az adatok nem egyeznek egyetlen fiókunkkal sem.',
    'password' => 'A megadott jelszó helytelen.',
    'throttle' => 'Túl sok próbálkozás. Próbálja újra :seconds másodperc múlva.',

    'client_login_title'  => 'Ügyfélfiók',
    'client_login_sub'    => 'Jelentkezzen be az ügyei eléréséhez',
    'client_brand_title'  => 'Az Ön ' . site_name() . '<br>ügyfélfiókja',
    'client_brand_sub'    => 'Kövesse nyomon kérelmeit, kezelje profilját, és férjen hozzá minden dokumentumához teljes biztonságban.',

    'staff_login_title'   => 'Adminisztrációs portál',
    'staff_login_sub'     => 'Kizárólag jogosult munkatársak számára',
    'staff_brand_title'   => site_name() . '<br>Adminisztráció',
    'staff_brand_sub'     => 'Biztonságos hozzáférés az ügykezelési, nyomon követési és felhasználó-adminisztrációs eszközökhöz.',

    'email'               => 'E-mail cím',
    'email_staff'         => 'Céges e-mail cím',
    'email_ph'            => 'on@pelda.com',
    'email_ph_staff'      => 'agent@mellenthinfinancial.online',
    'password_label'      => 'Jelszó',
    'remember'            => 'Emlékezzen rám',
    'remember_staff'      => 'Bejelentkezve maradok',
    'submit'              => 'Bejelentkezés',
    'submit_staff'        => 'Irányítópult megnyitása',
    'back_site'           => 'Vissza a weboldalra',
    'staff_portal_link'   => 'Munkatársi / adminisztrátori portál',
    'client_portal_link'  => 'Ügyfélfiók',
    'staff_restricted'    => 'Korlátozott hozzáférés — kizárólag jogosult munkatársak',
    'staff_notice'        => 'Ez a portál kizárólag a ' . site_name() . ' munkatársai számára érhető el. Minden bejelentkezés naplózásra kerül.',
    'or_staff'            => 'Munkatárs vagy adminisztrátor?',
    'or_client'           => 'Ön ügyfél?',

    'stat_clients'        => 'Elégedett ügyfelek',
    'stat_amount'         => 'Max. kölcsön / ügy',
    'stat_time'           => 'Garantált válaszidő',
    'stat_years'          => 'Év tapasztalat',

    'feature_secure'      => 'Titkosított adatok',
    'feature_currencies'  => '6 elfogadott pénznem',
    'feature_certified'   => 'Európai engedély',
    'feature_fast'        => 'Válasz 24 órán belül',

    'role_superadmin'     => 'Szuperadminisztrátor',
    'role_superadmin_sub' => 'Globális kezelés és szerepkörök',
    'role_admin'          => 'Adminisztrátor',
    'role_admin_sub'      => 'Ügykezelés',

    // Identifier (email or phone)
    'identifier'          => 'E-mail cím vagy telefonszám',
    'identifier_ph'       => 'on@email.com vagy +36...',
    'forgot_password'     => 'Elfelejtette jelszavát?',
    'portal_clients_only' => 'Ez a portál kizárólag ügyfelek számára érhető el.',

    // OTP page
    'otp_title'           => 'Ellenőrzés',
    'otp_heading'         => 'Biztonsági kód',
    'otp_subtitle'        => 'Küldtünk egy 6 jegyű kódot erre a címre:',
    'otp_enter'           => 'Adja meg az e-mailben kapott kódot',
    'otp_verify_btn'      => 'Ellenőrzés',
    'otp_resend'          => 'Kód újraküldése',
    'otp_resend_in'       => 'Újraküldés ekkor',
    'otp_back'            => 'Fiók váltása',
    'otp_verifying'       => 'Ellenőrzés folyamatban…',
    'otp_invalid'         => 'Helytelen kód. Még :remaining próbálkozása van.',
    'otp_expired'         => 'A kód lejárt. Kérjen újat.',
    'otp_too_many'        => 'Túl sok próbálkozás. Próbálja újra :seconds másodperc múlva.',
    'otp_resend_limit'    => 'Túl sok újraküldés. Próbálja újra néhány perc múlva.',
    'otp_send_failed'     => 'A kód elküldése nem sikerült. Próbálja újra.',
    'otp_session_expired' => 'A munkamenet lejárt. Jelentkezzen be újra.',
    'otp_resend_success'  => 'Új kód elküldve!',

    // Compte mémorisé
    'change_account' => 'Fiók váltása',

    // Compte bloqué
    'account_blocked'                     => 'Fiókja túl sok helytelen próbálkozás miatt zárolva lett. A feloldó linkért ellenőrizze e-mail postafiókját.',
    'account_blocked_notified'            => 'Túl sok helytelen próbálkozás. Fiókját zároltuk. Feloldó linket küldtünk e-mailben.',
    'account_unblocked'                   => 'Fiókja sikeresen feloldásra került. Most már bejelentkezhet.',
    'unblock_invalid'                     => 'Ez a feloldó link érvénytelen vagy lejárt. Vegye fel a kapcsolatot ügyfélszolgálatunkkal.',

    'account_blocked_email_subject'       => site_name() . ' fiókja zárolásra került',
    'account_blocked_email_title'         => 'Ideiglenesen zárolt fiók',
    'account_blocked_email_intro'         => 'Fiókját több helytelen bejelentkezési kísérlet miatt ideiglenesen zároltuk.',
    'account_blocked_email_reason_title'  => 'Miért történt a zárolás?',
    'account_blocked_email_reason_body'   => 'A fiókjába történő bejelentkezési kísérlet során 4 helytelen OTP kódot adtak meg egymás után. Biztonsági okokból a hozzáférést felfüggesztettük.',
    'account_blocked_email_btn'           => 'Fiókom feloldása',
    'account_blocked_email_fallback'      => 'Ha a gomb nem működik, másolja be ezt a linket böngészőjébe:',
    'account_blocked_email_notice'        => 'Ha nem Ön kezdeményezte ezeket a próbálkozásokat, ne kattintson erre a linkre, és azonnal vegye fel a kapcsolatot a ' . site_name() . ' ügyfélszolgálatával.',
    'account_blocked_email_footer'        => 'A link 48 óráig érvényes.',

    // OTP email
    'otp_email_subject'      => 'Bejelentkezési kódja — ' . site_name(),
    'otp_email_title'        => 'Megerősítő kód',
    'otp_email_intro'        => 'Íme az egyszer használatos bejelentkezési kódja. Ne ossza meg senkivel.',
    'otp_email_code_label'   => 'Az Ön kódja',
    'otp_email_expiry'       => 'Ez a kód 10 perc múlva lejár.',
    'otp_email_notice_title' => 'Fontos biztonsági figyelmeztetés',
    'otp_email_notice_body'  => 'A ' . site_name() . ' soha nem kéri el ezt a kódot telefonon vagy üzenetben. Ha nem Ön kérte ezt a kódot, hagyja figyelmen kívül ezt az e-mailt.',
    'otp_email_footer'       => 'Ha nem Ön kérte ezt a kódot, hagyja figyelmen kívül ezt az e-mailt.',

    // PWA telepítési banner (bejelentkezési oldalak)
    'pwa_install_title' => 'Alkalmazás telepítése',
    'pwa_install_hint'  => 'Gyors elérés · Értesítések · Offline mód',
    'pwa_install_btn'   => 'Telepítés',
    'pwa_ios_title'     => 'Telepítse a ' . site_name() . ' alkalmazást iPhone-jára',
    'pwa_ios_step1'     => 'Koppintson a <strong>Megosztás</strong> gombra a Safariban',
    'pwa_ios_step2'     => 'Válassza a <strong>Főképernyőhöz adás</strong> lehetőséget',
    'pwa_ios_step3'     => 'Koppintson a <strong>Hozzáadás</strong> gombra — kész!',
    'pwa_close'         => 'Bezárás',

];
