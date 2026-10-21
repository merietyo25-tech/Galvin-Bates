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

    'failed'   => 'Šie duomenys neatitinka mūsų įrašų.',
    'password' => 'Įvestas slaptažodis neteisingas.',
    'throttle' => 'Per daug prisijungimo bandymų. Bandykite dar kartą po :seconds sek.',

    'client_login_title'  => 'Kliento portalas',
    'client_login_sub'    => 'Prisijunkite, kad pasiektumėte savo paskolos paraiškas',
    'client_brand_title'  => 'Jūsų ' . site_name() . '<br>kliento erdvė',
    'client_brand_sub'    => 'Stebėkite savo paraiškas, tvarkykite profilį ir saugiai pasiekite visus savo dokumentus.',

    'staff_login_title'   => 'Administravimo portalas',
    'staff_login_sub'     => 'Prieinama tik įgaliotam personalui',
    'staff_brand_title'   => site_name() . '<br>administravimas',
    'staff_brand_sub'     => 'Saugus priėjimas prie valdymo įrankių, bylų stebėjimo ir naudotojų administravimo.',

    'email'               => 'El. pašto adresas',
    'email_staff'         => 'Darbinis el. paštas',
    'email_ph'            => 'jus@pavyzdys.lt',
    'email_ph_staff'      => 'agent@mellenthinfinancial.online',
    'password_label'      => 'Slaptažodis',
    'remember'            => 'Prisiminti mane',
    'remember_staff'      => 'Likti prisijungus',
    'submit'              => 'Prisijungti',
    'submit_staff'        => 'Pasiekti skydelį',
    'back_site'           => 'Grįžti į svetainę',
    'staff_portal_link'   => 'Darbuotojo / administratoriaus portalas',
    'client_portal_link'  => 'Kliento erdvė',
    'staff_restricted'    => 'Ribota prieiga — tik įgaliotas personalas',
    'staff_notice'        => 'Šis portalas skirtas tik ' . site_name() . ' darbuotojams. Visi prisijungimai registruojami.',
    'or_staff'            => 'Ar esate darbuotojas ar administratorius?',
    'or_client'           => 'Ar esate klientas?',

    'stat_clients'        => 'Patenkinti klientai',
    'stat_amount'         => 'Maks. paskola / byla',
    'stat_time'           => 'Garantuotas atsakymo laikas',
    'stat_years'          => 'Metų patirtis',

    'feature_secure'      => 'Šifruoti duomenys',
    'feature_currencies'  => '6 priimamos valiutos',
    'feature_certified'   => 'Sertifikuota ES',
    'feature_fast'        => 'Atsakymas per 24 val.',

    'role_superadmin'     => 'Vyriausiasis administratorius',
    'role_superadmin_sub' => 'Bendras valdymas ir rolės',
    'role_admin'          => 'Administratorius',
    'role_admin_sub'      => 'Bylų valdymas',

    'identifier'          => 'El. paštas arba telefonas',
    'identifier_ph'       => 'jusu@email.lt arba +370...',
    'forgot_password'     => 'Pamiršote slaptažodį?',
    'portal_clients_only' => 'Šis portalas skirtas tik klientams.',

    'otp_title'           => 'Patvirtinimas',
    'otp_heading'         => 'Saugumo kodas',
    'otp_subtitle'        => 'Išsiuntėme 6 skaitmenų kodą adresu',
    'otp_enter'           => 'Įveskite el. paštu gautą kodą',
    'otp_verify_btn'      => 'Patvirtinti',
    'otp_resend'          => 'Siųsti kodą iš naujo',
    'otp_resend_in'       => 'Siųsti iš naujo po',
    'otp_back'            => 'Keisti paskyrą',
    'otp_verifying'       => 'Tikrinama…',
    'otp_invalid'         => 'Neteisingas kodas. Liko :remaining bandymas (-ai).',
    'otp_expired'         => 'Šio kodo galiojimas baigėsi. Užsisakykite naują.',
    'otp_too_many'        => 'Per daug bandymų. Bandykite dar kartą po :seconds sek.',
    'otp_resend_limit'    => 'Per daug pakartotinio siuntimo bandymų. Bandykite dar kartą po kelių minučių.',
    'otp_send_failed'     => 'Nepavyko išsiųsti kodo. Bandykite dar kartą.',
    'otp_session_expired' => 'Sesijos galiojimas baigėsi. Prisijunkite iš naujo.',
    'otp_resend_success'  => 'Naujas kodas išsiųstas!',

    // Remembered account
    'change_account' => 'Keisti paskyrą',

    // Account blocked
    'account_blocked'                     => 'Jūsų paskyra buvo užblokuota dėl per didelio skaičiaus neteisingų bandymų. Atblokavimo nuorodos ieškokite savo el. paštu.',
    'account_blocked_notified'            => 'Per daug neteisingų bandymų. Jūsų paskyra užblokuota. Atblokavimo nuoroda išsiųsta jūsų el. paštu.',
    'account_unblocked'                   => 'Jūsų paskyra sėkmingai atblokuota. Dabar galite prisijungti.',
    'unblock_invalid'                     => 'Ši atblokavimo nuoroda negalioja arba jos galiojimas baigėsi. Kreipkitės į pagalbos komandą.',

    'account_blocked_email_subject'       => 'Jūsų ' . site_name() . ' paskyra buvo užblokuota',
    'account_blocked_email_title'         => 'Paskyra laikinai užblokuota',
    'account_blocked_email_intro'         => 'Jūsų paskyra laikinai užblokuota po kelių neteisingų prisijungimo bandymų.',
    'account_blocked_email_reason_title'  => 'Kodėl mano paskyra buvo užblokuota?',
    'account_blocked_email_reason_body'   => 'Prisijungimo metu iš eilės buvo įvesti 4 neteisingi OTP kodai. Saugumo sumetimais prieiga buvo laikinai sustabdyta.',
    'account_blocked_email_btn'           => 'Atblokuoti mano paskyrą',
    'account_blocked_email_fallback'      => 'Jei mygtukas neveikia, nukopijuokite šią nuorodą į naršyklę:',
    'account_blocked_email_notice'        => 'Jei šių bandymų neatlikote patys, nespauskite šios nuorodos ir nedelsdami susisiekite su ' . site_name() . ' pagalbos komanda.',
    'account_blocked_email_footer'        => 'Nuoroda galioja 48 valandas.',

    'otp_email_subject'      => 'Jūsų prisijungimo kodas — ' . site_name(),
    'otp_email_title'        => 'Patvirtinimo kodas',
    'otp_email_intro'        => 'Tai jūsų vienkartinis prisijungimo kodas. Niekada niekam jo neatskleiskite.',
    'otp_email_code_label'   => 'Jūsų kodas',
    'otp_email_expiry'       => 'Šio kodo galiojimas baigiasi po 10 minučių.',
    'otp_email_notice_title' => 'Svarbus saugumo pranešimas',
    'otp_email_notice_body'  => site_name() . ' niekada neprašys šio kodo telefonu ar žinute. Jei šio kodo neužsisakėte, ignoruokite šį el. laišką.',
    'otp_email_footer'       => 'Jei šio kodo neužsisakėte, ignoruokite šį el. laišką.',

    // PWA install banner (login pages)
    'pwa_install_title' => 'Įdiegti programėlę',
    'pwa_install_hint'  => 'Greitas pasiekiamumas · Pranešimai · Veikimas be interneto',
    'pwa_install_btn'   => 'Įdiegti',
    'pwa_ios_title'     => 'Įdiekite ' . site_name() . ' programėlę savo iPhone',
    'pwa_ios_step1'     => 'Palieskite <strong>Bendrinti</strong> naršyklėje Safari',
    'pwa_ios_step2'     => 'Pasirinkite <strong>Į pradžios ekraną</strong>',
    'pwa_ios_step3'     => 'Palieskite <strong>Pridėti</strong> — viskas atlikta!',
    'pwa_close'         => 'Uždaryti',

];
