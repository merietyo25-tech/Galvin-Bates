<?php

return [
    'success_contact' => 'bericht succesvol verzonden',
    'success_sbscribe' => 'Abonnement succesvol voltooid',
    'error' => 'Er is een fout opgetreden tijdens het verzenden. Probeer het later opnieuw.',
    'success_loan' => 'Uw leningaanvraag is succesvol verzonden. Wij geven u zo spoedig mogelijk een antwoord.',
    'error_loan' => 'Er is een fout opgetreden bij het verzenden van uw leningaanvraag. Probeer het later opnieuw.',

    // Emails demande de prêt
    'months'               => 'maanden',
    'month_abbr'           => 'mnd',
    'optional'             => 'optioneel',
    'loan_admin_subject'   => 'Nieuwe leningaanvraag',
    'loan_admin_intro'     => 'Een klant heeft zojuist een leningaanvraag ingediend via de website van ' . site_name() . '.',

    'loan_confirm_subject'   => 'Uw leningaanvraag wordt verwerkt',
    'loan_confirm_greeting'  => 'Beste :name,',
    'loan_confirm_body'      => 'Wij hebben uw leningaanvraag van :amount :currency over :duration maanden in goede orde ontvangen. Deze wordt momenteel door ons team verwerkt.',
    'loan_confirm_footer'    => 'Wij nemen zo spoedig mogelijk contact met u op. Hartelijk dank voor uw vertrouwen.',
    'loan_confirm_signature' => 'Het team van ' . site_name(),
    'loan_confirm_noreply'   => 'Deze e-mail is verzonden vanaf een no-reply-adres. Reageer niet rechtstreeks op dit bericht.',
    'no_reply_notice' => 'Dit is een automatisch gegenereerde e-mail. Gelieve hier niet op te reageren.',

    'loan_conditions_title'  => 'Toelatingsvoorwaarden',
    'loan_conditions_text'   => 'Om een lening te verkrijgen, moet u minstens 18 jaar oud zijn, een stabiel maandinkomen hebben en in staat zijn terug te betalen volgens de vastgestelde voorwaarden.',
    'loan_complete_btn'      => 'Mijn aanvraag aanvullen',
    'loan_complete_intro'    => 'Om uw dossier af te ronden, klikt u op onderstaande knop om ons uw volledige adres en een kopie van uw identiteitsbewijs te bezorgen.',

    'docs_subject'   => 'Documenten — Leningaanvraag',
    'docs_intro'     => 'De klant heeft zijn documenten verzonden om zijn leningaanvraag te vervolledigen.',
    'docs_name'      => 'Naam',
    'docs_email'     => 'E-mail',
    'docs_address'   => 'Adres',
    'docs_tax_number' => 'Fiscaal nummer',
    'docs_activity'  => 'Uitgeoefende activiteit',
    'docs_id_photo'  => 'Identiteitsbewijs / Document',
    'docs_doc_type'  => 'Documenttype',
    'docs_recto'     => 'Voorzijde (voorkant)',
    'docs_verso'     => 'Achterzijde (achterkant)',
    'docs_success'       => 'Uw documenten zijn verzonden. Ons team zal ze zo spoedig mogelijk beoordelen.',
    'docs_already_sent'  => 'Uw documenten zijn al verzonden of het formulier is verlopen. Als u uw documenten opnieuw wilt versturen, herlaad dan deze pagina.',

    'doc_type_id_card'   => 'Identiteitsbewijs',
    'doc_type_passport'  => 'Paspoort',
    'doc_type_license'   => 'Rijbewijs',
    'doc_type_residence' => 'Verblijfsvergunning',
    'doc_type_other'     => 'Ander document',

    'docs_confirm_subject'   => 'Uw documenten zijn in goede orde ontvangen',
    'docs_confirm_greeting'  => 'Beste :name,',
    'docs_confirm_body'      => 'Wij hebben uw documenten (adres en identiteitsbewijs) in goede orde ontvangen. Ons team zal ze beoordelen en u binnen 24 uur een terugkoppeling geven.',
    'docs_confirm_footer'    => 'Wij danken u voor uw vertrouwen en staan tot uw beschikking voor eventuele vragen.',
    'docs_confirm_signature' => 'Het team van ' . site_name(),

    'docs_upload_hint'  => 'Sleep en zet neer, of klik om een bestand te kiezen',
    'docs_single_photo' => 'Voor dit type document volstaat één foto.',
    // Affiche quand le total televerse depasse post_max_size (voir Exceptions/Handler).
    'upload_too_large' => 'De geüploade bestanden zijn te groot. Comprimeer ze of stuur ze één voor één.',

];