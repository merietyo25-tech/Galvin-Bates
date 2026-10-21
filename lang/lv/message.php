<?php

return [
    'success_contact' => 'Ziņojums veiksmīgi nosūtīts',
    'success_sbscribe' => 'Abonēšana veiksmīgi pabeigta',
    'error' => 'Nosūtot radās kļūda. Lūdzu, mēģiniet vēlreiz vēlāk.',
    'success_loan' => 'Jūsu aizdevuma pieteikums ir veiksmīgi nosūtīts. Mēs sniegsim atbildi pēc iespējas ātrāk.',
    'error_loan' => 'Nosūtot jūsu aizdevuma pieteikumu, radās kļūda. Lūdzu, mēģiniet vēlreiz vēlāk.',

    // Emails demande de prêt
    'months'               => 'mēneši',
    'month_abbr'           => 'mēn.',
    'optional'             => 'neobligāti',
    'loan_admin_subject'   => 'Jauns aizdevuma pieteikums',
    'loan_admin_intro'     => 'Klients tikko iesniedza aizdevuma pieteikumu ' . site_name() . ' vietnē.',

    'loan_confirm_subject'   => 'Jūsu aizdevuma pieteikums tiek izskatīts',
    'loan_confirm_greeting'  => 'Sveiki, :name,',
    'loan_confirm_body'      => 'Mēs esam saņēmuši jūsu aizdevuma pieteikumu par summu :amount :currency uz :duration mēnešiem. To pašlaik izskata mūsu komanda.',
    'loan_confirm_footer'    => 'Mēs ar jums sazināsimies pēc iespējas ātrāk. Paldies par uzticēšanos.',
    'loan_confirm_signature' => site_name() . ' komanda',
    'loan_confirm_noreply'   => 'Šis e-pasts ir nosūtīts no adreses, uz kuru netiek pieņemtas atbildes. Lūdzu, neatbildiet tieši uz šo ziņojumu.',
    'no_reply_notice' => 'Šī ir automātiski ģenerēta vēstule. Lūdzu, uz to neatbildiet.',

    'loan_conditions_title'  => 'Atbilstības nosacījumi',
    'loan_conditions_text'   => 'Lai saņemtu aizdevumu, jums jābūt vismaz 18 gadus vecam, jāsaņem stabili ikmēneša ienākumi un jāspēj atmaksāt aizdevumu saskaņā ar noteiktajiem nosacījumiem.',
    'loan_complete_btn'      => 'Papildināt manu pieteikumu',
    'loan_complete_intro'    => 'Lai pabeigtu jūsu pieteikuma noformēšanu, lūdzu, noklikšķiniet uz zemāk esošās pogas, lai nosūtītu mums savu pilno adresi un personu apliecinoša dokumenta kopiju.',

    'docs_subject'   => 'Dokumenti — aizdevuma pieteikums',
    'docs_intro'     => 'Klients ir iesniedzis savus dokumentus, lai pabeigtu aizdevuma pieteikumu.',
    'docs_name'      => 'Vārds',
    'docs_email'     => 'E-pasts',
    'docs_address'   => 'Adrese',
    'docs_tax_number' => 'Nodokļu maksātāja numurs',
    'docs_activity'  => 'Veiktā darbība',
    'docs_id_photo'  => 'Personu apliecinošs dokuments / Dokuments',
    'docs_doc_type'  => 'Dokumenta veids',
    'docs_recto'     => 'Priekšpuse',
    'docs_verso'     => 'Aizmugure',
    'docs_success'       => 'Jūsu dokumenti ir nosūtīti. Mūsu komanda tos izskatīs pēc iespējas ātrāk.',
    'docs_already_sent'  => 'Jūsu dokumenti jau ir nosūtīti vai veidlapas derīguma termiņš ir beidzies. Ja vēlaties nosūtīt dokumentus atkārtoti, lūdzu, atsvaidziniet šo lapu.',

    'doc_type_id_card'   => 'Personu apliecinošs dokuments',
    'doc_type_passport'  => 'Pase',
    'doc_type_license'   => 'Vadītāja apliecība',
    'doc_type_residence' => 'Uzturēšanās atļauja',
    'doc_type_other'     => 'Cits dokuments',

    'docs_confirm_subject'   => 'Jūsu dokumenti ir saņemti',
    'docs_confirm_greeting'  => 'Sveiki, :name,',
    'docs_confirm_body'      => 'Mēs esam saņēmuši jūsu dokumentus (adresi un personu apliecinošu dokumentu). Mūsu komanda tos izskatīs un sniegs atbildi 24 stundu laikā.',
    'docs_confirm_footer'    => 'Paldies par jūsu uzticēšanos. Mēs esam pieejami, ja jums rodas kādi jautājumi.',
    'docs_confirm_signature' => site_name() . ' komanda',

    'docs_upload_hint'  => 'Velciet un nometiet vai noklikšķiniet, lai izvēlētos failu',
    'docs_single_photo' => 'Šim dokumenta veidam pietiek ar vienu fotogrāfiju.',
    // Affiche quand le total televerse depasse post_max_size (voir Exceptions/Handler).
    'upload_too_large' => 'Augšupielādētie faili ir pārāk lieli. Saspiediet tos vai sūtiet pa vienam.',

];