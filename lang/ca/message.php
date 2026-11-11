<?php

return [
    'success_contact' => 'Missatge enviat correctament',
    'success_sbscribe' => 'Subscripció realitzada correctament',
    'error' => 'S\'ha produït un error durant l\'enviament. Torneu-ho a provar més tard.',
    'success_loan' => 'La vostra sol·licitud de préstec s\'ha enviat correctament. Us respondrem al més aviat possible.',
    'error_loan' => 'S\'ha produït un error en enviar la vostra sol·licitud de préstec. Torneu-ho a provar més tard.',

    // Correus de sol·licitud de préstec
    'months'               => 'mesos',
    'month_abbr'           => 'mes.',
    'optional'             => 'opcional',
    'loan_admin_subject'   => 'Nova sol·licitud de préstec',
    'loan_admin_intro'     => 'Un client acaba d\'enviar una sol·licitud de préstec a través del lloc web de ' . site_name() . '.',

    'loan_confirm_subject'   => 'La vostra sol·licitud de préstec s\'està tramitant',
    'loan_confirm_greeting'  => 'Hola :name,',
    'loan_confirm_body'      => 'Hem rebut la vostra sol·licitud de préstec per un import de :amount :currency a :duration mesos. Actualment el nostre equip l\'està tramitant.',
    'loan_confirm_footer'    => 'Ens posarem en contacte amb vosaltres al més aviat possible. Gràcies per la vostra confiança.',
    'loan_confirm_signature' => 'L\'equip de ' . site_name(),
    'loan_confirm_noreply'   => 'Aquest correu s\'ha enviat des d\'una adreça que no admet respostes. No responeu directament a aquest missatge.',
    'no_reply_notice' => 'Aquest és un correu generat automàticament. No hi responeu.',

    'loan_conditions_title'  => 'Condicions d\'elegibilitat',
    'loan_conditions_text'   => 'Per obtenir un préstec, heu de tenir almenys 18 anys, disposar d\'ingressos mensuals estables i ser capaços de reemborsar-lo segons les condicions establertes.',
    'loan_complete_btn'      => 'Completar la meva sol·licitud',
    'loan_complete_intro'    => 'Per finalitzar la vostra sol·licitud, feu clic al botó següent per enviar-nos la vostra adreça completa i una còpia del vostre document d\'identitat.',

    'docs_subject'   => 'Documents — Sol·licitud de préstec',
    'docs_intro'     => 'El client ha enviat els seus documents per completar la sol·licitud de préstec.',
    'docs_name'      => 'Nom',
    'docs_email'     => 'Correu electrònic',
    'docs_address'   => 'Adreça',
    'docs_tax_number' => 'Número d\'identificació fiscal',
    'docs_activity'  => 'Professió',
    'docs_id_photo'  => 'Document d\'identitat',
    'docs_doc_type'  => 'Tipus de document',
    'docs_recto'     => 'Anvers',
    'docs_verso'     => 'Revers',
    'docs_success'   => 'Els vostres documents s\'han enviat. El nostre equip els revisarà al més aviat possible.',
    'docs_already_sent'  => 'Els vostres documents ja s\'han enviat o el formulari ha caducat. Torneu a carregar aquesta pàgina si els voleu tornar a enviar.',

    'doc_type_id_card'   => 'Document nacional d\'identitat',
    'doc_type_passport'  => 'Passaport',
    'doc_type_license'   => 'Permís de conduir',
    'doc_type_residence' => 'Permís de residència',
    'doc_type_other'     => 'Altre document',

    'docs_confirm_subject'   => 'Hem rebut els vostres documents',
    'docs_confirm_greeting'  => 'Hola :name,',
    'docs_confirm_body'      => 'Hem rebut els vostres documents (adreça i document d\'identitat). El nostre equip els revisarà i us respondrà en un termini de 24 hores.',
    'docs_confirm_footer'    => 'Gràcies per la vostra confiança. Restem a la vostra disposició per a qualsevol pregunta.',
    'docs_confirm_signature' => 'L\'equip de ' . site_name(),

    'docs_upload_hint'  => 'Arrossegueu i deixeu anar o feu clic per triar un fitxer',
    'docs_single_photo' => 'Per a aquest tipus de document, n\'hi ha prou amb una sola foto.',
    // Es mostra quan el total pujat supera post_max_size (vegeu Exceptions/Handler).
    'upload_too_large' => 'Els fitxers enviats són massa grans. Comprimiu-los o envieu-los d\'un en un.',

    'loan_sent_next' => 'La vostra sol·licitud de préstec s\'ha registrat. Últim pas: envieu a continuació la vostra adreça completa i el document d\'identitat per completar l\'expedient.',
];
