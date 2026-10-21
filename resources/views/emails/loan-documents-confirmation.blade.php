@php
$docTypes = [
    'fr' => ['passport'=>'Passeport','id_card'=>'Carte d\'identité','residence_permit'=>'Titre de séjour','driving_license'=>'Permis de conduire'],
    'en' => ['passport'=>'Passport','id_card'=>'Identity card','residence_permit'=>'Residence permit','driving_license'=>'Driving license'],
    'es' => ['passport'=>'Pasaporte','id_card'=>'Documento de identidad','residence_permit'=>'Permiso de residencia','driving_license'=>'Permiso de conducir'],
    'pl' => ['passport'=>'Paszport','id_card'=>'Dowód osobisty','residence_permit'=>'Zezwolenie na pobyt','driving_license'=>'Prawo jazdy'],
    'bg' => ['passport'=>'Паспорт','id_card'=>'Лична карта','residence_permit'=>'Разрешение за пребиваване','driving_license'=>'Шофьорска книжка'],
    'hu' => ['passport'=>'Útlevél','id_card'=>'Személyi igazolvány','residence_permit'=>'Tartózkodási engedély','driving_license'=>'Vezetői engedély'],
    'it' => ['passport'=>'Passaporto','id_card'=>'Carta d\'identità','residence_permit'=>'Permesso di soggiorno','driving_license'=>'Patente di guida'],
    'de' => ['passport'=>'Reisepass','id_card'=>'Personalausweis','residence_permit'=>'Aufenthaltstitel','driving_license'=>'Führerschein'],
    'lt' => ['passport'=>'Pasas','id_card'=>'Asmens tapatybės kortelė','residence_permit'=>'Leidimas gyventi','driving_license'=>'Vairuotojo pažymėjimas'],
    'ro' => ['passport'=>'Pașaport','id_card'=>'Act de identitate','residence_permit'=>'Permis de ședere','driving_license'=>'Permis de conducere'],
    'lv' => ['passport'=>'Pase','id_card'=>'Personu apliecinošs dokuments','residence_permit'=>'Uzturēšanās atļauja','driving_license'=>'Vadītāja apliecība'],
    'nl' => ['passport'=>'Paspoort','id_card'=>'Identiteitskaart','residence_permit'=>'Verblijfsvergunning','driving_license'=>'Rijbewijs'],
    'pt' => ['passport'=>'Passaporte','id_card'=>'Cartão de cidadão','residence_permit'=>'Título de residência','driving_license'=>'Carta de condução'],
    'hr' => ['passport'=>'Putovnica','id_card'=>'Osobna iskaznica','residence_permit'=>'Dozvola boravka','driving_license'=>'Vozačka dozvola'],
];
$texts = [
    'fr' => [
        'title'     => 'Documents reçus',
        'sub'       => site_name(),
        'greeting'  => 'Bonjour '.$data['name'].',',
        'body'      => 'Nous avons bien reçu vos documents (adresse et pièce d\'identité). Notre équipe les examinera et vous donnera un retour dans les <strong>24 heures</strong>.',
        'lbl_name'  => 'Nom',
        'lbl_doc'   => 'Type de document',
        'lbl_addr'  => 'Adresse',
        'footer'    => 'Nous vous remercions de votre confiance et restons à votre disposition pour toute question.',
        'noreply'   => 'Cet email a été envoyé depuis une adresse no-reply. Veuillez ne pas répondre directement.',
        'closing'   => 'Cordialement,',
        'team'      => 'L\'équipe ' . site_name(),
    ],
    'en' => [
        'title'     => 'Documents received',
        'sub'       => site_name(),
        'greeting'  => 'Hello '.$data['name'].',',
        'body'      => 'We have received your documents (address and identity document). Our team will review them and get back to you within <strong>24 hours</strong>.',
        'lbl_name'  => 'Name',
        'lbl_doc'   => 'Document type',
        'lbl_addr'  => 'Address',
        'footer'    => 'Thank you for your trust. We remain available for any questions.',
        'noreply'   => 'This email was sent from a no-reply address. Please do not reply directly.',
        'closing'   => 'Best regards,',
        'team'      => 'The ' . site_name() . ' team',
    ],
    'es' => [
        'title'     => 'Documentos recibidos',
        'sub'       => site_name(),
        'greeting'  => 'Hola '.$data['name'].',',
        'body'      => 'Hemos recibido sus documentos (dirección y documento de identidad). Nuestro equipo los revisará y le dará una respuesta en <strong>24 horas</strong>.',
        'lbl_name'  => 'Nombre',
        'lbl_doc'   => 'Tipo de documento',
        'lbl_addr'  => 'Dirección',
        'footer'    => 'Gracias por su confianza. Quedamos a su disposición para cualquier pregunta.',
        'noreply'   => 'Este email fue enviado desde una dirección de no respuesta. No responda directamente.',
        'closing'   => 'Atentamente,',
        'team'      => 'El equipo ' . site_name(),
    ],
    'pl' => [
        'title'     => 'Dokumenty odebrane',
        'sub'       => site_name(),
        'greeting'  => 'Witaj '.$data['name'].',',
        'body'      => 'Otrzymaliśmy Twoje dokumenty (adres i dokument tożsamości). Nasz zespół je przejrzy i skontaktuje się z Tobą w ciągu <strong>24 godzin</strong>.',
        'lbl_name'  => 'Imię i nazwisko',
        'lbl_doc'   => 'Typ dokumentu',
        'lbl_addr'  => 'Adres',
        'footer'    => 'Dziękujemy za zaufanie. Jesteśmy do Twojej dyspozycji w razie pytań.',
        'noreply'   => 'Ten email został wysłany z adresu no-reply. Prosimy nie odpowiadać bezpośrednio.',
        'closing'   => 'Z poważaniem,',
        'team'      => 'Zespół ' . site_name(),
    ],
    'bg' => [
        'title'     => 'Документи получени',
        'sub'       => site_name(),
        'greeting'  => 'Здравейте '.$data['name'].',',
        'body'      => 'Получихме вашите документи (адрес и документ за самоличност). Нашият екип ще ги разгледа и ще ви отговори в рамките на <strong>24 часа</strong>.',
        'lbl_name'  => 'Име',
        'lbl_doc'   => 'Вид документ',
        'lbl_addr'  => 'Адрес',
        'footer'    => 'Благодарим ви за доверието. Оставаме на разположение за всякакви въпроси.',
        'noreply'   => 'Този имейл беше изпратен от адрес без отговор (no-reply). Моля, не отговаряйте директно.',
        'closing'   => 'С уважение,',
        'team'      => 'Екипът на ' . site_name(),
    ],
    'hu' => [
        'title'     => 'Dokumentumok beérkeztek',
        'sub'       => site_name(),
        'greeting'  => 'Üdvözöljük '.$data['name'].',',
        'body'      => 'Megkaptuk dokumentumait (cím és személyazonosító okmány). Csapatunk megvizsgálja azokat, és <strong>24 órán belül</strong> visszajelzést ad.',
        'lbl_name'  => 'Név',
        'lbl_doc'   => 'Dokumentum típusa',
        'lbl_addr'  => 'Cím',
        'footer'    => 'Köszönjük bizalmát. Bármilyen kérdés esetén állunk rendelkezésére.',
        'noreply'   => 'Ezt az e-mailt egy no-reply címről küldtük. Kérjük, ne válaszoljon közvetlenül.',
        'closing'   => 'Tisztelettel,',
        'team'      => 'A ' . site_name() . ' csapata',
    ],
    'it' => [
        'title'     => 'Documenti ricevuti',
        'sub'       => site_name(),
        'greeting'  => 'Ciao '.$data['name'].',',
        'body'      => 'Abbiamo ricevuto correttamente i tuoi documenti (indirizzo e documento d\'identità). Il nostro team li esaminerà e ti risponderà entro <strong>24 ore</strong>.',
        'lbl_name'  => 'Nome',
        'lbl_doc'   => 'Tipo di documento',
        'lbl_addr'  => 'Indirizzo',
        'footer'    => 'Ti ringraziamo per la fiducia. Restiamo a tua disposizione per qualsiasi domanda.',
        'noreply'   => 'Questa email è stata inviata da un indirizzo no-reply. Ti preghiamo di non rispondere direttamente.',
        'closing'   => 'Cordiali saluti,',
        'team'      => 'Il team ' . site_name(),
    ],
    'de' => [
        'title'     => 'Dokumente eingegangen',
        'sub'       => site_name(),
        'greeting'  => 'Guten Tag '.$data['name'].',',
        'body'      => 'Wir haben Ihre Unterlagen (Adresse und Ausweisdokument) erhalten. Unser Team wird sie prüfen und sich innerhalb von <strong>24 Stunden</strong> bei Ihnen melden.',
        'lbl_name'  => 'Name',
        'lbl_doc'   => 'Dokumenttyp',
        'lbl_addr'  => 'Adresse',
        'footer'    => 'Wir danken Ihnen für Ihr Vertrauen und stehen für Fragen jederzeit zur Verfügung.',
        'noreply'   => 'Diese E-Mail wurde von einer no-reply-Adresse gesendet. Bitte antworten Sie nicht direkt auf diese Nachricht.',
        'closing'   => 'Mit freundlichen Grüßen,',
        'team'      => 'Das ' . site_name() . '-Team',
    ],
    'lt' => [
        'title'     => 'Dokumentai gauti',
        'sub'       => site_name(),
        'greeting'  => 'Sveiki, '.$data['name'].',',
        'body'      => 'Gavome jūsų dokumentus (adresą ir asmens tapatybės dokumentą). Mūsų komanda juos peržiūrės ir susisieks su jumis per <strong>24 valandas</strong>.',
        'lbl_name'  => 'Vardas ir pavardė',
        'lbl_doc'   => 'Dokumento tipas',
        'lbl_addr'  => 'Adresas',
        'footer'    => 'Dėkojame už pasitikėjimą ir esame pasirengę atsakyti į bet kokius klausimus.',
        'noreply'   => 'Šis el. laiškas išsiųstas iš no-reply adreso. Prašome tiesiogiai neatsakyti į šį pranešimą.',
        'closing'   => 'Pagarbiai,',
        'team'      => site_name() . ' komanda',
    ],
    'ro' => [
        'title'     => 'Documente primite',
        'sub'       => site_name(),
        'greeting'  => 'Bună ziua, '.$data['name'].',',
        'body'      => 'Am primit documentele dumneavoastră (adresă și act de identitate). Echipa noastră le va analiza și vă va oferi un răspuns în <strong>24 de ore</strong>.',
        'lbl_name'  => 'Nume',
        'lbl_doc'   => 'Tip document',
        'lbl_addr'  => 'Adresă',
        'footer'    => 'Vă mulțumim pentru încredere și rămânem la dispoziția dumneavoastră pentru orice întrebare.',
        'noreply'   => 'Acest e-mail a fost trimis de la o adresă no-reply. Vă rugăm să nu răspundeți direct la acest mesaj.',
        'closing'   => 'Cu stimă,',
        'team'      => 'Echipa ' . site_name(),
    ],
    'lv' => [
        'title'     => 'Dokumenti saņemti',
        'sub'       => site_name(),
        'greeting'  => 'Sveiki, '.$data['name'].',',
        'body'      => 'Mēs esam saņēmuši jūsu dokumentus (adresi un personu apliecinošu dokumentu). Mūsu komanda tos izskatīs un sniegs atbildi <strong>24 stundu</strong> laikā.',
        'lbl_name'  => 'Vārds',
        'lbl_doc'   => 'Dokumenta veids',
        'lbl_addr'  => 'Adrese',
        'footer'    => 'Paldies par jūsu uzticēšanos. Mēs esam pieejami, ja jums rodas kādi jautājumi.',
        'noreply'   => 'Šis e-pasts ir nosūtīts no adreses, uz kuru netiek pieņemtas atbildes. Lūdzu, neatbildiet tieši uz šo ziņojumu.',
        'closing'   => 'Ar cieņu,',
        'team'      => site_name() . ' komanda',
    ],
    'nl' => [
        'title'     => 'Documenten ontvangen',
        'sub'       => site_name(),
        'greeting'  => 'Hallo '.$data['name'].',',
        'body'      => 'We hebben uw documenten (adres en identiteitsbewijs) in goede orde ontvangen. Ons team zal deze beoordelen en binnen <strong>24 uur</strong> bij u terugkomen.',
        'lbl_name'  => 'Naam',
        'lbl_doc'   => 'Documenttype',
        'lbl_addr'  => 'Adres',
        'footer'    => 'Hartelijk dank voor uw vertrouwen. Wij staan u graag ter beschikking voor eventuele vragen.',
        'noreply'   => 'Deze e-mail is verzonden vanaf een no-reply-adres. Gelieve hier niet rechtstreeks op te antwoorden.',
        'closing'   => 'Met vriendelijke groet,',
        'team'      => 'Het team van ' . site_name(),
    ],
    'pt' => [
        'title'     => 'Documentos recebidos',
        'sub'       => site_name(),
        'greeting'  => 'Olá '.$data['name'].',',
        'body'      => 'Recebemos os seus documentos (morada e documento de identificação). A nossa equipa irá analisá-los e responder-lhe no prazo de <strong>24 horas</strong>.',
        'lbl_name'  => 'Nome',
        'lbl_doc'   => 'Tipo de documento',
        'lbl_addr'  => 'Morada',
        'footer'    => 'Agradecemos a sua confiança e permanecemos à sua disposição para qualquer questão.',
        'noreply'   => 'Este email foi enviado a partir de um endereço no-reply. Não responda diretamente.',
        'closing'   => 'Atenciosamente,',
        'team'      => 'A equipa ' . site_name(),
    ],
    'hr' => [
        'title'     => 'Dokumenti primljeni',
        'sub'       => site_name(),
        'greeting'  => 'Pozdrav '.$data['name'].',',
        'body'      => 'Uspješno smo primili vaše dokumente (adresu i osobni dokument). Naš tim će ih pregledati i javiti vam se u roku od <strong>24 sata</strong>.',
        'lbl_name'  => 'Ime',
        'lbl_doc'   => 'Vrsta dokumenta',
        'lbl_addr'  => 'Adresa',
        'footer'    => 'Zahvaljujemo na povjerenju i ostajemo na raspolaganju za sva pitanja.',
        'noreply'   => 'Ova e-poruka poslana je s adrese na koju se ne odgovara (no-reply). Molimo ne odgovarajte izravno.',
        'closing'   => 'S poštovanjem,',
        'team'      => 'Tim ' . site_name(),
    ],
];
$t       = $texts[$lang] ?? $texts['fr'];
$docType = $docTypes[$lang][$data['doc_type'] ?? ''] ?? ($data['doc_type'] ?? '—');
@endphp

<x-email-layout
    :title="$t['title']"
    :subtitle="$t['sub']"
    accent="green"
    :footerNote="$t['noreply']"
>

  <p class="greeting">{{ $t['greeting'] }}</p>

  <p class="body-text">{!! $t['body'] !!}</p>

  <div class="panel">
    <div class="panel-row">
      <span class="panel-lbl">{{ $t['lbl_name'] }}</span>
      <span class="panel-val">{{ $data['name'] }}</span>
    </div>
    <div class="panel-row">
      <span class="panel-lbl">{{ $t['lbl_doc'] }}</span>
      <span class="panel-val">{{ $docType }}</span>
    </div>
    <div class="panel-row">
      <span class="panel-lbl">{{ $t['lbl_addr'] }}</span>
      <span class="panel-val" style="white-space:pre-line">{{ $data['address'] }}</span>
    </div>
  </div>

  <p class="body-text">{{ $t['footer'] }}</p>

  <p class="closing">
    {{ $t['closing'] }}<br>
    <strong>{{ $t['team'] }}</strong>
  </p>

</x-email-layout>
