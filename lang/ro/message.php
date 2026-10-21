<?php

return [
    'success_contact' => 'mesaj trimis cu succes',
    'success_sbscribe' => 'Abonare finalizată cu succes',
    'error' => 'A apărut o eroare la trimitere. Vă rugăm să încercați din nou mai târziu.',
    'success_loan' => 'Cererea dumneavoastră de împrumut a fost trimisă cu succes. Vă vom oferi un răspuns în cel mai scurt timp.',
    'error_loan' => 'A apărut o eroare la trimiterea cererii dumneavoastră de împrumut. Vă rugăm să încercați din nou mai târziu.',

    // Emails demande de prêt
    'months'               => 'luni',
    'month_abbr'           => 'luni',
    'optional'             => 'opțional',
    'loan_admin_subject'   => 'Cerere nouă de împrumut',
    'loan_admin_intro'     => 'Un client tocmai a depus o cerere de împrumut prin intermediul site-ului ' . site_name() . '.',

    'loan_confirm_subject'   => 'Cererea dumneavoastră de împrumut este în curs de procesare',
    'loan_confirm_greeting'  => 'Bună ziua, :name,',
    'loan_confirm_body'      => 'Am primit cererea dumneavoastră de împrumut în valoare de :amount :currency pe o perioadă de :duration luni. Aceasta este în prezent în curs de procesare de către echipa noastră.',
    'loan_confirm_footer'    => 'Vă vom contacta în cel mai scurt timp. Vă mulțumim pentru încrederea acordată.',
    'loan_confirm_signature' => 'Echipa ' . site_name(),
    'loan_confirm_noreply'   => 'Acest e-mail a fost trimis de la o adresă no-reply. Vă rugăm să nu răspundeți direct la acest mesaj.',
    'no_reply_notice' => 'Acesta este un e-mail generat automat. Vă rugăm să nu răspundeți la acest mesaj.',

    'loan_conditions_title'  => 'Condiții de eligibilitate',
    'loan_conditions_text'   => 'Pentru a obține un împrumut, trebuie să aveți cel puțin 18 ani, să realizați un venit lunar stabil și să puteți rambursa conform condițiilor stabilite.',
    'loan_complete_btn'      => 'Completează cererea mea',
    'loan_complete_intro'    => 'Pentru a finaliza dosarul dumneavoastră, vă rugăm să faceți clic pe butonul de mai jos pentru a ne transmite adresa dumneavoastră completă și o copie a actului de identitate.',

    'docs_subject'   => 'Documente — Cerere de împrumut',
    'docs_intro'     => 'Clientul a transmis documentele pentru a completa cererea de împrumut.',
    'docs_name'      => 'Nume',
    'docs_email'     => 'E-mail',
    'docs_address'   => 'Adresă',
    'docs_tax_number' => 'Cod fiscal',
    'docs_activity'  => 'Activitate desfășurată',
    'docs_id_photo'  => 'Act de identitate / Document',
    'docs_doc_type'  => 'Tip document',
    'docs_recto'     => 'Față (recto)',
    'docs_verso'     => 'Verso (spate)',
    'docs_success'       => 'Documentele dumneavoastră au fost trimise. Echipa noastră le va analiza în cel mai scurt timp.',
    'docs_already_sent'  => 'Documentele dumneavoastră au fost deja trimise sau formularul a expirat. Dacă doriți să retrimiteți documentele, vă rugăm să reîncărcați această pagină.',

    'doc_type_id_card'   => 'Act de identitate',
    'doc_type_passport'  => 'Pașaport',
    'doc_type_license'   => 'Permis de conducere',
    'doc_type_residence' => 'Permis de ședere',
    'doc_type_other'     => 'Alt document',

    'docs_confirm_subject'   => 'Documentele dumneavoastră au fost primite',
    'docs_confirm_greeting'  => 'Bună ziua, :name,',
    'docs_confirm_body'      => 'Am primit documentele dumneavoastră (adresă și act de identitate). Echipa noastră le va analiza și vă va oferi un răspuns în 24 de ore.',
    'docs_confirm_footer'    => 'Vă mulțumim pentru încredere și rămânem la dispoziția dumneavoastră pentru orice întrebare.',
    'docs_confirm_signature' => 'Echipa ' . site_name(),

    'docs_upload_hint'  => 'Trageți și plasați sau faceți clic pentru a alege un fișier',
    'docs_single_photo' => 'Pentru acest tip de document, o singură fotografie este suficientă.',
    // Affiche quand le total televerse depasse post_max_size (voir Exceptions/Handler).
    'upload_too_large' => 'Fișierele încărcate sunt prea mari. Comprimați-le sau trimiteți-le pe rând.',

];