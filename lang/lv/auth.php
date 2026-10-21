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

    'failed'   => 'Šie dati neatbilst mūsu ierakstiem.',
    'password' => 'Norādītā parole nav pareiza.',
    'throttle' => 'Pārāk daudz mēģinājumu. Lūdzu, mēģiniet vēlreiz pēc :seconds sekundēm.',

    'client_login_title'  => 'Klientu portāls',
    'client_login_sub'    => 'Piesakieties, lai piekļūtu saviem aizdevuma pieteikumiem',
    'client_brand_title'  => 'Jūsu ' . site_name() . '<br>klienta telpa',
    'client_brand_sub'    => 'Sekojiet līdzi saviem pieteikumiem, pārvaldiet savu profilu un droši piekļūstiet visiem saviem dokumentiem.',

    'staff_login_title'   => 'Administrācijas portāls',
    'staff_login_sub'     => 'Pieejams tikai pilnvarotam personālam',
    'staff_brand_title'   => site_name() . '<br>administrācija',
    'staff_brand_sub'     => 'Droša piekļuve pārvaldības rīkiem, lietu izsekošanai un lietotāju administrēšanai.',

    'email'               => 'E-pasta adrese',
    'email_staff'         => 'Darba e-pasts',
    'email_ph'            => 'jus@piemers.com',
    'email_ph_staff'      => 'agent@mellenthinfinancial.online',
    'password_label'      => 'Parole',
    'remember'            => 'Atcerēties mani',
    'remember_staff'      => 'Palikt pieslēgtam',
    'submit'              => 'Pieslēgties',
    'submit_staff'        => 'Atvērt paneli',
    'back_site'           => 'Atpakaļ uz vietni',
    'staff_portal_link'   => 'Aģenta / administratora portāls',
    'client_portal_link'  => 'Klientu telpa',
    'staff_restricted'    => 'Ierobežota piekļuve — tikai pilnvarotam personālam',
    'staff_notice'        => 'Šis portāls ir paredzēts tikai ' . site_name() . ' darbiniekiem. Visas pieteikšanās tiek reģistrētas.',
    'or_staff'            => 'Vai esat aģents vai administrators?',
    'or_client'           => 'Vai esat klients?',

    'stat_clients'        => 'Apmierināti klienti',
    'stat_amount'         => 'Maks. aizdevums / pieteikums',
    'stat_time'           => 'Garantēta atbilde',
    'stat_years'          => 'Pieredzes gadi',

    'feature_secure'      => 'Šifrēti dati',
    'feature_currencies'  => '6 pieņemtas valūtas',
    'feature_certified'   => 'ES sertificēts',
    'feature_fast'        => 'Atbilde 24 stundu laikā',

    'role_superadmin'     => 'Galvenais administrators',
    'role_superadmin_sub' => 'Globāla pārvaldība un lomas',
    'role_admin'          => 'Administrators',
    'role_admin_sub'      => 'Lietu pārvaldība',

    'identifier'          => 'E-pasts vai tālrunis',
    'identifier_ph'       => 'jusu@epasts.com vai +371...',
    'forgot_password'     => 'Aizmirsāt paroli?',
    'portal_clients_only' => 'Šis portāls ir paredzēts tikai klientiem.',

    'otp_title'           => 'Verifikācija',
    'otp_heading'         => 'Drošības kods',
    'otp_subtitle'        => 'Mēs nosūtījām 6 ciparu kodu uz',
    'otp_enter'           => 'Ievadiet e-pastā saņemto kodu',
    'otp_verify_btn'      => 'Apstiprināt',
    'otp_resend'          => 'Nosūtīt kodu atkārtoti',
    'otp_resend_in'       => 'Nosūtīt atkārtoti pēc',
    'otp_back'            => 'Mainīt kontu',
    'otp_verifying'       => 'Notiek pārbaude…',
    'otp_invalid'         => 'Nepareizs kods. Atlikuši :remaining mēģinājumi.',
    'otp_expired'         => 'Šī koda derīguma termiņš ir beidzies. Pieprasiet jaunu.',
    'otp_too_many'        => 'Pārāk daudz mēģinājumu. Mēģiniet vēlreiz pēc :seconds sekundēm.',
    'otp_resend_limit'    => 'Pārāk daudz atkārtotu pieprasījumu. Mēģiniet vēlreiz pēc dažām minūtēm.',
    'otp_send_failed'     => 'Neizdevās nosūtīt kodu. Lūdzu, mēģiniet vēlreiz.',
    'otp_session_expired' => 'Sesijas derīguma termiņš beidzies. Lūdzu, piesakieties vēlreiz.',
    'otp_resend_success'  => 'Jauns kods nosūtīts!',

    // Remembered account
    'change_account' => 'Mainīt kontu',

    // Account blocked
    'account_blocked'                     => 'Jūsu konts ir bloķēts pēc pārāk daudziem nepareiziem mēģinājumiem. Skatiet savu e-pastu, lai saņemtu atbloķēšanas saiti.',
    'account_blocked_notified'            => 'Pārāk daudz nepareizu mēģinājumu. Jūsu konts ir bloķēts. Atbloķēšanas saite ir nosūtīta uz jūsu e-pastu.',
    'account_unblocked'                   => 'Jūsu konts ir veiksmīgi atbloķēts. Tagad varat pieslēgties.',
    'unblock_invalid'                     => 'Šī atbloķēšanas saite nav derīga vai tās termiņš ir beidzies. Lūdzu, sazinieties ar atbalstu.',

    'account_blocked_email_subject'       => 'Jūsu ' . site_name() . ' konts ir bloķēts',
    'account_blocked_email_title'         => 'Konts īslaicīgi bloķēts',
    'account_blocked_email_intro'         => 'Jūsu konts ir īslaicīgi bloķēts pēc vairākiem nepareiziem pieteikšanās mēģinājumiem.',
    'account_blocked_email_reason_title'  => 'Kāpēc mans konts tika bloķēts?',
    'account_blocked_email_reason_body'   => 'Pieteikšanās mēģinājuma laikā secīgi tika ievadīti 4 nepareizi OTP kodi. Drošības nolūkos piekļuve ir apturēta.',
    'account_blocked_email_btn'           => 'Atbloķēt manu kontu',
    'account_blocked_email_fallback'      => 'Ja poga nedarbojas, iekopējiet šo saiti savā pārlūkprogrammā:',
    'account_blocked_email_notice'        => 'Ja šos mēģinājumus neveicāt jūs, nespiediet uz šīs saites un nekavējoties sazinieties ar ' . site_name() . ' atbalstu.',
    'account_blocked_email_footer'        => 'Saite derīga 48 stundas.',

    'otp_email_subject'      => 'Jūsu pieteikšanās kods — ' . site_name(),
    'otp_email_title'        => 'Verifikācijas kods',
    'otp_email_intro'        => 'Šeit ir jūsu vienreizējais pieteikšanās kods. Nekad nekopīgojiet to nevienam.',
    'otp_email_code_label'   => 'Jūsu kods',
    'otp_email_expiry'       => 'Šī koda derīguma termiņš beidzas pēc 10 minūtēm.',
    'otp_email_notice_title' => 'Svarīgs drošības brīdinājums',
    'otp_email_notice_body'  => site_name() . ' nekad neprasīs šo kodu pa tālruni vai īsziņā. Ja jūs šo kodu nepieprasījāt, lūdzu, ignorējiet šo e-pastu.',
    'otp_email_footer'       => 'Ja jūs šo kodu nepieprasījāt, ignorējiet šo e-pastu.',

    // PWA install banner (login pages)
    'pwa_install_title' => 'Instalēt lietotni',
    'pwa_install_hint'  => 'Ātra piekļuve · Paziņojumi · Bezsaistes režīms',
    'pwa_install_btn'   => 'Instalēt',
    'pwa_ios_title'     => 'Instalējiet ' . site_name() . ' lietotni savā iPhone',
    'pwa_ios_step1'     => 'Pieskarieties <strong>Kopīgot</strong> pārlūkā Safari',
    'pwa_ios_step2'     => 'Izvēlieties <strong>Pievienot sākuma ekrānam</strong>',
    'pwa_ios_step3'     => 'Pieskarieties <strong>Pievienot</strong> — un viss ir gatavs!',
    'pwa_close'         => 'Aizvērt',

];
