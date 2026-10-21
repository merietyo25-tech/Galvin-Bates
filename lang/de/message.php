<?php

return [
    'success_contact' => 'Nachricht erfolgreich gesendet',
    'success_sbscribe' => 'Abonnement erfolgreich abgeschlossen',
    'error' => 'Beim Senden ist ein Fehler aufgetreten. Bitte versuchen Sie es später erneut.',
    'success_loan' => 'Ihre Kreditanfrage wurde erfolgreich gesendet. Wir werden Ihnen so schnell wie möglich eine Antwort zukommen lassen.',
    'error_loan' => 'Beim Senden Ihres Kreditantrags ist ein Fehler aufgetreten. Bitte versuchen Sie es später erneut.',

    // E-Mails zur Kreditanfrage
    'months'               => 'Monate',
    'month_abbr'           => 'Mon.',
    'optional'             => 'optional',
    'loan_admin_subject'   => 'Neue Kreditanfrage',
    'loan_admin_intro'     => 'Ein Kunde hat soeben eine Kreditanfrage über die ' . site_name() . '-Website eingereicht.',

    'loan_confirm_subject'   => 'Ihre Kreditanfrage wird bearbeitet',
    'loan_confirm_greeting'  => 'Guten Tag :name,',
    'loan_confirm_body'      => 'Wir haben Ihre Kreditanfrage über :amount :currency für eine Laufzeit von :duration Monaten erhalten. Sie wird derzeit von unserem Team bearbeitet.',
    'loan_confirm_footer'    => 'Wir werden uns so schnell wie möglich bei Ihnen melden. Vielen Dank für Ihr Vertrauen.',
    'loan_confirm_signature' => 'Das ' . site_name() . '-Team',
    'loan_confirm_noreply'   => 'Diese E-Mail wurde von einer no-reply-Adresse gesendet. Bitte antworten Sie nicht direkt auf diese Nachricht.',
    'no_reply_notice' => 'Dies ist eine automatisch generierte E-Mail. Bitte antworten Sie nicht darauf.',

    'loan_conditions_title'  => 'Voraussetzungen',
    'loan_conditions_text'   => 'Um einen Kredit zu erhalten, müssen Sie mindestens 18 Jahre alt sein, über ein stabiles monatliches Einkommen verfügen und in der Lage sein, gemäß den festgelegten Bedingungen zurückzuzahlen.',
    'loan_complete_btn'      => 'Meine Anfrage vervollständigen',
    'loan_complete_intro'    => 'Um Ihren Antrag abzuschließen, klicken Sie bitte auf die Schaltfläche unten, um uns Ihre vollständige Adresse und eine Kopie Ihres Ausweisdokuments zu übermitteln.',

    'docs_subject'   => 'Dokumente — Kreditantrag',
    'docs_intro'     => 'Der Kunde hat seine Dokumente zur Vervollständigung seines Kreditantrags übermittelt.',
    'docs_name'      => 'Name',
    'docs_email'     => 'E-Mail',
    'docs_address'   => 'Adresse',
    'docs_tax_number' => 'Steuernummer',
    'docs_activity'  => 'Ausgeübte Tätigkeit',
    'docs_id_photo'  => 'Ausweisdokument',
    'docs_doc_type'  => 'Dokumenttyp',
    'docs_recto'     => 'Vorderseite',
    'docs_verso'     => 'Rückseite',
    'docs_success'       => 'Ihre Dokumente wurden gesendet. Unser Team wird sie so schnell wie möglich prüfen.',
    'docs_already_sent'  => 'Ihre Dokumente wurden bereits gesendet oder das Formular ist abgelaufen. Wenn Sie Ihre Dokumente erneut senden möchten, laden Sie diese Seite bitte neu.',

    'doc_type_id_card'   => 'Personalausweis',
    'doc_type_passport'  => 'Reisepass',
    'doc_type_license'   => 'Führerschein',
    'doc_type_residence' => 'Aufenthaltstitel',
    'doc_type_other'     => 'Anderes Dokument',

    'docs_confirm_subject'   => 'Ihre Dokumente sind bei uns eingegangen',
    'docs_confirm_greeting'  => 'Guten Tag :name,',
    'docs_confirm_body'      => 'Wir haben Ihre Dokumente (Adresse und Ausweisdokument) erhalten. Unser Team wird sie prüfen und sich innerhalb von 24 Stunden bei Ihnen melden.',
    'docs_confirm_footer'    => 'Wir danken Ihnen für Ihr Vertrauen und stehen für Fragen jederzeit zur Verfügung.',
    'docs_confirm_signature' => 'Das ' . site_name() . '-Team',

    'docs_upload_hint'  => 'Datei per Drag & Drop ablegen oder klicken, um eine Datei auszuwählen',
    'docs_single_photo' => 'Für diese Art von Dokument genügt ein einziges Foto.',
    // Affiche quand le total televerse depasse post_max_size (voir Exceptions/Handler).
    'upload_too_large' => 'Die hochgeladenen Dateien sind zu groß. Bitte komprimieren Sie sie oder senden Sie sie einzeln.',

];