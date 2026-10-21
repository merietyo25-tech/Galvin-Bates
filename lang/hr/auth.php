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

    'failed'   => 'Ovi podaci ne odgovaraju nijednom računu.',
    'password' => 'Uneseni podaci nisu točni.',
    'throttle' => 'Previše pokušaja. Pokušajte ponovno za :seconds sekundi.',

    'client_login_title'  => 'Klijentski prostor',
    'client_login_sub'    => 'Prijavite se za pristup svojim dosjeima',
    'client_brand_title'  => 'Vaš<br>klijentski prostor ' . site_name(),
    'client_brand_sub'    => 'Pratite svoje zahtjeve, upravljajte svojim profilom i pristupite svim svojim dokumentima na siguran način.',

    'staff_login_title'   => 'Administrativni portal',
    'staff_login_sub'     => 'Isključivo za ovlašteno osoblje',
    'staff_brand_title'   => 'Administracija<br>' . site_name(),
    'staff_brand_sub'     => 'Siguran pristup alatima za upravljanje, praćenje dosjea i administraciju korisnika.',

    'email'               => 'E-mail adresa',
    'email_staff'         => 'Poslovni e-mail',
    'email_ph'            => 'vi@primjer.com',
    'email_ph_staff'      => 'agent@mellenthinfinancial.online',
    'password_label'      => 'Lozinka',
    'remember'            => 'Zapamti me',
    'remember_staff'      => 'Ostani prijavljen',
    'submit'              => 'Prijava',
    'submit_staff'        => 'Pristupi nadzornoj ploči',
    'back_site'           => 'Povratak na web',
    'staff_portal_link'   => 'Portal za agente / administratore',
    'client_portal_link'  => 'Klijentski prostor',
    'staff_restricted'    => 'Ograničen pristup — Ovlašteno osoblje',
    'staff_notice'        => 'Ovaj portal namijenjen je isključivo agentima ' . site_name() . '. Sve prijave se bilježe.',
    'or_staff'            => 'Vi ste agent ili administrator?',
    'or_client'           => 'Vi ste klijent?',

    'stat_clients'        => 'Zadovoljni klijenti',
    'stat_amount'         => 'Maks. kredit / dosje',
    'stat_time'           => 'Zajamčeni odgovor',
    'stat_years'          => 'Godina iskustva',

    'feature_secure'      => 'Šifrirani podaci',
    'feature_currencies'  => '6 prihvaćenih valuta',
    'feature_certified'   => 'Europska licenca',
    'feature_fast'        => 'Odgovor u roku 48h',

    'role_superadmin'     => 'Super administrator',
    'role_superadmin_sub' => 'Globalno upravljanje i uloge',
    'role_admin'          => 'Administrator',
    'role_admin_sub'      => 'Upravljanje dosjeima',

    // Identifier (email or phone)
    'identifier'          => 'E-mail ili telefon',
    'identifier_ph'       => 'vas@email.com ili +33...',
    'forgot_password'     => 'Zaboravili ste lozinku?',
    'portal_clients_only' => 'Ovaj portal namijenjen je isključivo klijentima.',

    // OTP page
    'otp_title'           => 'Provjera',
    'otp_heading'         => 'Sigurnosni kod',
    'otp_subtitle'        => 'Poslali smo 6-znamenkasti kod na',
    'otp_enter'           => 'Unesite kod primljen e-poštom',
    'otp_verify_btn'      => 'Provjeri',
    'otp_resend'          => 'Ponovno pošalji kod',
    'otp_resend_in'       => 'Ponovno pošalji za',
    'otp_back'            => 'Promijeni račun',
    'otp_verifying'       => 'Provjera u tijeku…',
    'otp_invalid'         => 'Netočan kod. Preostalo vam je :remaining pokušaja.',
    'otp_expired'         => 'Kod je istekao. Zatražite novi.',
    'otp_too_many'        => 'Previše pokušaja. Pokušajte ponovno za :seconds sekundi.',
    'otp_resend_limit'    => 'Previše zahtjeva za ponovno slanje. Pokušajte ponovno za nekoliko minuta.',
    'otp_send_failed'     => 'Kod nije moguće poslati. Pokušajte ponovno.',
    'otp_session_expired' => 'Sesija je istekla. Prijavite se ponovno.',
    'otp_resend_success'  => 'Novi kod poslan!',

    // Compte mémorisé
    'change_account' => 'Promijeni račun',

    // Compte bloqué
    'account_blocked'                     => 'Vaš račun je blokiran zbog previše netočnih pokušaja. Provjerite svoj e-mail za poveznicu za deblokadu.',
    'account_blocked_notified'            => 'Previše netočnih pokušaja. Vaš račun je blokiran. Poveznica za deblokadu poslana vam je e-poštom.',
    'account_unblocked'                   => 'Vaš račun je uspješno deblokiran. Sada se možete prijaviti.',
    'unblock_invalid'                     => 'Ova poveznica za deblokadu nije važeća ili je istekla. Kontaktirajte podršku.',

    'account_blocked_email_subject'       => 'Vaš račun ' . site_name() . ' je blokiran',
    'account_blocked_email_title'         => 'Račun privremeno blokiran',
    'account_blocked_email_intro'         => 'Vaš račun je privremeno blokiran zbog nekoliko netočnih pokušaja prijave.',
    'account_blocked_email_reason_title'  => 'Zašto je blokiran?',
    'account_blocked_email_reason_body'   => '4 netočna OTP koda unesena su uzastopno prilikom pokušaja prijave na vaš račun. Iz sigurnosnih razloga pristup je obustavljen.',
    'account_blocked_email_btn'           => 'Deblokiraj moj račun',
    'account_blocked_email_fallback'      => 'Ako gumb ne radi, kopirajte ovu poveznicu u svoj preglednik:',
    'account_blocked_email_notice'        => 'Ako niste vi izvršili ove pokušaje, ne klikajte na ovu poveznicu i odmah kontaktirajte podršku ' . site_name() . '.',
    'account_blocked_email_footer'        => 'Poveznica vrijedi 48 sati.',

    // OTP email
    'otp_email_subject'      => 'Vaš kod za prijavu — ' . site_name(),
    'otp_email_title'        => 'Kod za provjeru',
    'otp_email_intro'        => 'Evo vašeg jednokratnog koda za prijavu. Ne dijelite ga ni s kim.',
    'otp_email_code_label'   => 'Vaš kod',
    'otp_email_expiry'       => 'Ovaj kod istječe za 10 minuta.',
    'otp_email_notice_title' => 'Važna sigurnosna napomena',
    'otp_email_notice_body'  => site_name() . ' nikada neće od vas tražiti ovaj kod putem telefona ili poruke. Ako niste zatražili ovaj kod, zanemarite ovaj e-mail.',
    'otp_email_footer'       => 'Ako niste zatražili ovaj kod, zanemarite ovaj e-mail.',

    // Bannière d'installation PWA (pages de connexion)
    'pwa_install_title' => 'Instaliraj aplikaciju',
    'pwa_install_hint'  => 'Brzi pristup · Obavijesti · Rad bez interneta',
    'pwa_install_btn'   => 'Instaliraj',
    'pwa_ios_title'     => 'Instalirajte aplikaciju ' . site_name() . ' na svoj iPhone',
    'pwa_ios_step1'     => 'Dodirnite <strong>Podijeli</strong> u Safariju',
    'pwa_ios_step2'     => 'Odaberite <strong>Na početni zaslon</strong>',
    'pwa_ios_step3'     => 'Dodirnite <strong>Dodaj</strong> — gotovo je!',
    'pwa_close'         => 'Zatvori',

];
