<?php

return [
    'success_contact' => 'üzenet sikeresen elküldve',
    'success_sbscribe' => 'Az előfizetés sikeresen befejeződött',
    'error' => 'Hiba történt a küldés során. Kérjük, próbálja újra később.',
    'success_loan' => 'A kölcsönkérelmét sikeresen elküldtük. A lehető leghamarabb választ adunk.',
    'error_loan' => 'Hiba történt a kölcsönkérelme elküldése közben. Kérjük, próbálja újra később.',

    // Emails demande de prêt
    'months'               => 'hónap',
    'month_abbr'           => 'hó',
    'optional'             => 'opcionális',
    'loan_admin_subject'   => 'Új kölcsönkérelem',
    'loan_admin_intro'     => 'Egy ügyfél kölcsönkérelmet nyújtott be a ' . site_name() . ' weboldalán keresztül.',

    'loan_confirm_subject'   => 'Kölcsönkérelme feldolgozás alatt áll',
    'loan_confirm_greeting'  => 'Üdvözöljük, :name,',
    'loan_confirm_body'      => 'Megkaptuk :amount :currency összegű, :duration hónapos futamidejű kölcsönkérelmét. Jelenleg csapatunk dolgozza fel.',
    'loan_confirm_footer'    => 'A lehető leghamarabb felvesszük Önnel a kapcsolatot. Köszönjük bizalmát.',
    'loan_confirm_signature' => 'A ' . site_name() . ' csapata',
    'loan_confirm_noreply'   => 'Ezt az e-mailt egy no-reply címről küldtük. Kérjük, ne válaszoljon közvetlenül erre az üzenetre.',
    'no_reply_notice' => 'Ez egy automatikusan generált e-mail. Kérjük, ne válaszoljon rá.',

    'loan_conditions_title'  => 'Jogosultsági feltételek',
    'loan_conditions_text'   => 'Kölcsön igényléséhez legalább 18 évesnek kell lennie, stabil havi jövedelemmel kell rendelkeznie, és képesnek kell lennie a meghatározott feltételek szerinti törlesztésre.',
    'loan_complete_btn'      => 'Kérelmem befejezése',
    'loan_complete_intro'    => 'Az ügye véglegesítéséhez kérjük, kattintson az alábbi gombra, hogy megadja teljes címét és személyazonosító okmányának másolatát.',

    'docs_subject'   => 'Dokumentumok — Kölcsönkérelem',
    'docs_intro'     => 'Az ügyfél elküldte dokumentumait kölcsönkérelme kiegészítéséhez.',
    'docs_name'      => 'Név',
    'docs_email'     => 'E-mail',
    'docs_address'   => 'Cím',
    'docs_tax_number' => 'Adószám',
    'docs_activity'  => 'Foglalkozás',
    'docs_id_photo'  => 'Személyazonosító okmány / dokumentum',
    'docs_doc_type'  => 'Dokumentum típusa',
    'docs_recto'     => 'Előlap',
    'docs_verso'     => 'Hátlap',
    'docs_success'       => 'Dokumentumait elküldtük. Csapatunk a lehető leghamarabb megvizsgálja azokat.',
    'docs_already_sent'  => 'Dokumentumait már elküldte, vagy az űrlap lejárt. Ha újra el szeretné küldeni dokumentumait, kérjük, töltse újra ezt az oldalt.',

    'doc_type_id_card'   => 'Személyi igazolvány',
    'doc_type_passport'  => 'Útlevél',
    'doc_type_license'   => 'Vezetői engedély',
    'doc_type_residence' => 'Tartózkodási engedély',
    'doc_type_other'     => 'Egyéb dokumentum',

    'docs_confirm_subject'   => 'Dokumentumait sikeresen megkaptuk',
    'docs_confirm_greeting'  => 'Üdvözöljük, :name,',
    'docs_confirm_body'      => 'Megkaptuk dokumentumait (cím és személyazonosító okmány). Csapatunk megvizsgálja azokat, és 24 órán belül visszajelzést ad.',
    'docs_confirm_footer'    => 'Köszönjük bizalmát, és bármilyen kérdés esetén állunk rendelkezésére.',
    'docs_confirm_signature' => 'A ' . site_name() . ' csapata',

    'docs_upload_hint'  => 'Húzza ide, vagy kattintson a fájl kiválasztásához',
    'docs_single_photo' => 'Ehhez a dokumentumtípushoz egyetlen fénykép is elegendő.',
    // Affiche quand le total televerse depasse post_max_size (voir Exceptions/Handler).
    'upload_too_large' => 'A feltöltött fájlok túl nagyok. Tömörítse őket, vagy küldje el egyenként.',

];