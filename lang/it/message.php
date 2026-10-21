<?php

return [
    'success_contact' => 'Messaggio inviato con successo',
    'success_sbscribe' => 'Iscrizione completata con successo',
    'error' => 'Si è verificato un errore durante l\'invio. Per favore riprova più tardi.',
    'success_loan' => 'La tua richiesta di prestito è stata inviata con successo. Ti forniremo una risposta il prima possibile.',
    'error_loan' => 'Si è verificato un errore durante l\'invio della tua richiesta di prestito. Per favore riprova più tardi.',

    // Emails demande de prêt
    'months'               => 'mesi',
    'month_abbr'           => 'mesi',
    'optional'             => 'facoltativo',
    'loan_admin_subject'   => 'Nuova richiesta di prestito',
    'loan_admin_intro'     => 'Un cliente ha appena inviato una richiesta di prestito tramite il sito ' . site_name() . '.',

    'loan_confirm_subject'   => 'La tua richiesta di prestito è in fase di elaborazione',
    'loan_confirm_greeting'  => 'Ciao :name,',
    'loan_confirm_body'      => 'Abbiamo ricevuto la tua richiesta di prestito di :amount :currency su :duration mesi. È attualmente in fase di elaborazione da parte del nostro team.',
    'loan_confirm_footer'    => 'Ti contatteremo il prima possibile. Grazie per la fiducia accordataci.',
    'loan_confirm_signature' => 'Il team ' . site_name(),
    'loan_confirm_noreply'   => 'Questa email è stata inviata da un indirizzo no-reply. Ti preghiamo di non rispondere direttamente a questo messaggio.',
    'no_reply_notice' => 'Questa è un\'email generata automaticamente. Si prega di non rispondere.',

    'loan_conditions_title'  => 'Condizioni di ammissibilità',
    'loan_conditions_text'   => 'Per ottenere un prestito, è necessario avere almeno 18 anni, percepire un reddito mensile stabile e poter rimborsare secondo le condizioni stabilite.',
    'loan_complete_btn'      => 'Completa la mia richiesta',
    'loan_complete_intro'    => 'Per finalizzare la tua pratica, ti preghiamo di cliccare sul pulsante qui sotto per inviarci il tuo indirizzo completo e una copia del tuo documento d\'identità.',

    'docs_subject'   => 'Documenti — Richiesta di prestito',
    'docs_intro'     => 'Il cliente ha inviato i propri documenti per completare la richiesta di prestito.',
    'docs_name'      => 'Nome',
    'docs_email'     => 'Email',
    'docs_address'   => 'Indirizzo',
    'docs_tax_number' => 'Numero fiscale',
    'docs_activity'  => 'Attività svolta',
    'docs_id_photo'  => 'Documento d\'identità',
    'docs_doc_type'  => 'Tipo di documento',
    'docs_recto'     => 'Fronte',
    'docs_verso'     => 'Retro',
    'docs_success'       => 'I tuoi documenti sono stati inviati. Il nostro team li esaminerà il prima possibile.',
    'docs_already_sent'  => 'I tuoi documenti sono già stati inviati o il modulo è scaduto. Se desideri inviare nuovamente i tuoi documenti, ricarica questa pagina.',

    'doc_type_id_card'   => 'Carta d\'identità',
    'doc_type_passport'  => 'Passaporto',
    'doc_type_license'   => 'Patente di guida',
    'doc_type_residence' => 'Permesso di soggiorno',
    'doc_type_other'     => 'Altro documento',

    'docs_confirm_subject'   => 'I tuoi documenti sono stati ricevuti correttamente',
    'docs_confirm_greeting'  => 'Ciao :name,',
    'docs_confirm_body'      => 'Abbiamo ricevuto correttamente i tuoi documenti (indirizzo e documento d\'identità). Il nostro team li esaminerà e ti risponderà entro 24 ore.',
    'docs_confirm_footer'    => 'Ti ringraziamo per la fiducia e restiamo a tua disposizione per qualsiasi domanda.',
    'docs_confirm_signature' => 'Il team ' . site_name(),

    'docs_upload_hint'  => 'Trascina e rilascia oppure clicca per scegliere un file',
    'docs_single_photo' => 'Per questo tipo di documento è sufficiente una sola foto.',
    // Affiche quand le total televerse depasse post_max_size (voir Exceptions/Handler).
    'upload_too_large' => 'I file caricati sono troppo grandi. Comprimili o inviali uno alla volta.',

];