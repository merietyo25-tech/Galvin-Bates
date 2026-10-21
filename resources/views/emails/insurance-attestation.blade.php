@php
$gender = $loan->client?->gender ?? 'N';

$greetings = [
    'fr' => ['M' => 'Monsieur '.$loan->name.',',  'F' => 'Madame '.$loan->name.',',   'N' => 'Madame, Monsieur '.$loan->name.','],
    'en' => ['M' => 'Dear Mr. '.$loan->name.',',  'F' => 'Dear Ms. '.$loan->name.',', 'N' => 'Dear '.$loan->name.','],
    'es' => ['M' => 'Estimado Sr. '.$loan->name.',', 'F' => 'Estimada Sra. '.$loan->name.',', 'N' => 'Estimado/a '.$loan->name.','],
    'pl' => ['M' => 'Szanowny Panie '.$loan->name.',', 'F' => 'Szanowna Pani '.$loan->name.',', 'N' => 'Szanowny/a Panie/Pani '.$loan->name.','],
    'bg' => ['M' => 'Уважаеми г-н '.$loan->name.',', 'F' => 'Уважаема г-жо '.$loan->name.',', 'N' => 'Уважаеми/а '.$loan->name.','],
    'hu' => ['M' => 'Tisztelt '.$loan->name.'!',     'F' => 'Tisztelt '.$loan->name.'!',      'N' => 'Kedves '.$loan->name.'!'],
    'it' => ['M' => 'Egregio Sig. '.$loan->name.',', 'F' => 'Gentile Sig.ra '.$loan->name.',', 'N' => 'Gentile '.$loan->name.','],
    'de' => ['M' => 'Sehr geehrter Herr '.$loan->name.',', 'F' => 'Sehr geehrte Frau '.$loan->name.',', 'N' => 'Guten Tag '.$loan->name.','],
    'lt' => ['M' => 'Gerbiamas Pone '.$loan->name.',', 'F' => 'Gerbiama Ponia '.$loan->name.',', 'N' => 'Sveiki, '.$loan->name.','],
    'ro' => ['M' => 'Stimate Domnule '.$loan->name.',', 'F' => 'Stimată Doamnă '.$loan->name.',', 'N' => 'Bună ziua, '.$loan->name.','],
    'lv' => ['M' => 'Godātais Kungs '.$loan->name.',', 'F' => 'Godātā Kundze '.$loan->name.',', 'N' => 'Sveiki, '.$loan->name.','],
    'nl' => ['M' => 'Geachte heer '.$loan->name.',', 'F' => 'Geachte mevrouw '.$loan->name.',', 'N' => 'Beste '.$loan->name.','],
];

$texts = [
    'fr' => [
        'title'    => 'Attestation d\'assurance emprunteur — N°'.$loan->reference,
        'sub'      => 'Assurance CG-A340G',
        'greeting' => $greetings['fr'][$gender],
        'intro'    => 'Veuillez trouver ci-joint votre <strong>attestation d\'assurance emprunteur</strong> (référence <strong>'.$loan->reference.'</strong>) établie par ' . site_name() . ' dans le cadre de votre dossier de financement.',
        'summary'  => 'RÉCAPITULATIF DE VOTRE ASSURANCE',
        'lbl_ref'  => 'Référence dossier',
        'lbl_montant'  => 'Montant assuré',
        'lbl_duree'    => 'Durée',
        'lbl_months'   => 'mois',
        'lbl_frais'    => 'Frais d\'assurance',
        'lbl_fin'      => 'Date de fin d\'assurance',
        'attach_note'  => 'Votre attestation d\'assurance CG-A340G est jointe à cet email au format PDF.',
        'contact'      => 'Pour toute question relative à votre assurance, n\'hésitez pas à contacter votre conseiller.',
        'closing'      => 'Cordialement,',
        'team'         => 'L\'équipe ' . site_name(),
    ],
    'en' => [
        'title'    => 'Borrower insurance certificate — N°'.$loan->reference,
        'sub'      => 'Insurance CG-A340G',
        'greeting' => $greetings['en'][$gender],
        'intro'    => 'Please find attached your <strong>borrower insurance certificate</strong> (reference <strong>'.$loan->reference.'</strong>) issued by ' . site_name() . ' in connection with your financing application.',
        'summary'  => 'YOUR INSURANCE SUMMARY',
        'lbl_ref'  => 'Dossier reference',
        'lbl_montant'  => 'Insured amount',
        'lbl_duree'    => 'Duration',
        'lbl_months'   => 'months',
        'lbl_frais'    => 'Insurance fees',
        'lbl_fin'      => 'Insurance end date',
        'attach_note'  => 'Your CG-A340G insurance certificate is attached to this email in PDF format.',
        'contact'      => 'For any questions regarding your insurance, please do not hesitate to contact your advisor.',
        'closing'      => 'Best regards,',
        'team'         => 'The ' . site_name() . ' Team',
    ],
    'es' => [
        'title'    => 'Certificado de seguro de prestatario — N°'.$loan->reference,
        'sub'      => 'Seguro CG-A340G',
        'greeting' => $greetings['es'][$gender],
        'intro'    => 'Encontrará adjunto su <strong>certificado de seguro de prestatario</strong> (referencia <strong>'.$loan->reference.'</strong>) emitido por ' . site_name() . ' en el marco de su solicitud de financiación.',
        'summary'  => 'RESUMEN DE SU SEGURO',
        'lbl_ref'  => 'Referencia del expediente',
        'lbl_montant'  => 'Importe asegurado',
        'lbl_duree'    => 'Duración',
        'lbl_months'   => 'meses',
        'lbl_frais'    => 'Gastos de seguro',
        'lbl_fin'      => 'Fecha de vencimiento del seguro',
        'attach_note'  => 'Su certificado de seguro CG-A340G se adjunta a este correo en formato PDF.',
        'contact'      => 'Para cualquier pregunta relativa a su seguro, no dude en ponerse en contacto con su asesor.',
        'closing'      => 'Atentamente,',
        'team'         => 'El equipo ' . site_name(),
    ],
    'pl' => [
        'title'    => 'Zaświadczenie ubezpieczenia kredytobiorcy — nr '.$loan->reference,
        'sub'      => 'Ubezpieczenie CG-A340G',
        'greeting' => $greetings['pl'][$gender],
        'intro'    => 'W załączeniu przesyłamy <strong>zaświadczenie ubezpieczenia kredytobiorcy</strong> (numer referencyjny <strong>'.$loan->reference.'</strong>) wystawione przez ' . site_name() . ' w ramach Państwa wniosku kredytowego.',
        'summary'  => 'PODSUMOWANIE UBEZPIECZENIA',
        'lbl_ref'  => 'Numer referencyjny',
        'lbl_montant'  => 'Kwota ubezpieczona',
        'lbl_duree'    => 'Okres',
        'lbl_months'   => 'miesięcy',
        'lbl_frais'    => 'Składka ubezpieczeniowa',
        'lbl_fin'      => 'Data końca ubezpieczenia',
        'attach_note'  => 'Zaświadczenie ubezpieczenia CG-A340G jest załączone do tej wiadomości w formacie PDF.',
        'contact'      => 'W razie pytań dotyczących ubezpieczenia prosimy o kontakt z doradcą.',
        'closing'      => 'Z poważaniem,',
        'team'         => 'Zespół ' . site_name(),
    ],
    'bg' => [
        'title'    => 'Удостоверение за застраховка на кредитополучателя — №'.$loan->reference,
        'sub'      => 'Застраховка CG-A340G',
        'greeting' => $greetings['bg'][$gender],
        'intro'    => 'Моля, намерете приложено вашето <strong>удостоверение за застраховка на кредитополучателя</strong> (референция <strong>'.$loan->reference.'</strong>), издадено от ' . site_name() . ' във връзка с вашето досие за финансиране.',
        'summary'  => 'ОБОБЩЕНИЕ НА ВАШАТА ЗАСТРАХОВКА',
        'lbl_ref'  => 'Референция на досието',
        'lbl_montant'  => 'Застрахована сума',
        'lbl_duree'    => 'Срок',
        'lbl_months'   => 'месеца',
        'lbl_frais'    => 'Застрахователна такса',
        'lbl_fin'      => 'Дата на изтичане на застраховката',
        'attach_note'  => 'Вашето удостоверение за застраховка CG-A340G е приложено към този имейл във формат PDF.',
        'contact'      => 'За всякакви въпроси относно вашата застраховка, не се колебайте да се свържете с вашия консултант.',
        'closing'      => 'С уважение,',
        'team'         => 'Екипът на ' . site_name(),
    ],
    'hu' => [
        'title'    => 'Adósvédelmi biztosítási igazolás — sz. '.$loan->reference,
        'sub'      => 'CG-A340G biztosítás',
        'greeting' => $greetings['hu'][$gender],
        'intro'    => 'Mellékelten megtalálja <strong>adósvédelmi biztosítási igazolását</strong> (hivatkozási szám: <strong>'.$loan->reference.'</strong>), amelyet a ' . site_name() . ' állított ki finanszírozási ügye keretében.',
        'summary'  => 'BIZTOSÍTÁSÁNAK ÖSSZEFOGLALÓJA',
        'lbl_ref'  => 'Ügy referenciaszáma',
        'lbl_montant'  => 'Biztosított összeg',
        'lbl_duree'    => 'Futamidő',
        'lbl_months'   => 'hónap',
        'lbl_frais'    => 'Biztosítási díj',
        'lbl_fin'      => 'Biztosítás lejárati dátuma',
        'attach_note'  => 'CG-A340G biztosítási igazolása PDF formátumban csatolva található ehhez az e-mailhez.',
        'contact'      => 'Biztosításával kapcsolatos bármilyen kérdés esetén forduljon bizalommal tanácsadójához.',
        'closing'      => 'Tisztelettel,',
        'team'         => 'A ' . site_name() . ' csapata',
    ],
    'it' => [
        'title'    => 'Attestato di assicurazione del mutuatario — N°'.$loan->reference,
        'sub'      => 'Assicurazione CG-A340G',
        'greeting' => $greetings['it'][$gender],
        'intro'    => 'In allegato trovi il tuo <strong>attestato di assicurazione del mutuatario</strong> (riferimento <strong>'.$loan->reference.'</strong>) rilasciato da ' . site_name() . ' nell\'ambito della tua pratica di finanziamento.',
        'summary'  => 'RIEPILOGO DELLA TUA ASSICURAZIONE',
        'lbl_ref'  => 'Riferimento pratica',
        'lbl_montant'  => 'Importo assicurato',
        'lbl_duree'    => 'Durata',
        'lbl_months'   => 'mesi',
        'lbl_frais'    => 'Spese assicurative',
        'lbl_fin'      => 'Data di scadenza dell\'assicurazione',
        'attach_note'  => 'Il tuo attestato di assicurazione CG-A340G è allegato a questa email in formato PDF.',
        'contact'      => 'Per qualsiasi domanda relativa alla tua assicurazione, non esitare a contattare il tuo consulente.',
        'closing'      => 'Cordiali saluti,',
        'team'         => 'Il team ' . site_name(),
    ],
    'de' => [
        'title'    => 'Restschuldversicherungsbescheinigung — Nr. '.$loan->reference,
        'sub'      => 'Versicherung CG-A340G',
        'greeting' => $greetings['de'][$gender],
        'intro'    => 'Anbei finden Sie Ihre <strong>Restschuldversicherungsbescheinigung</strong> (Referenz <strong>'.$loan->reference.'</strong>), die von ' . site_name() . ' im Rahmen Ihrer Finanzierungsakte ausgestellt wurde.',
        'summary'  => 'ZUSAMMENFASSUNG IHRER VERSICHERUNG',
        'lbl_ref'  => 'Aktenreferenz',
        'lbl_montant'  => 'Versicherte Summe',
        'lbl_duree'    => 'Laufzeit',
        'lbl_months'   => 'Monate',
        'lbl_frais'    => 'Versicherungsgebühr',
        'lbl_fin'      => 'Ende der Versicherung',
        'attach_note'  => 'Ihre CG-A340G-Versicherungsbescheinigung ist dieser E-Mail im PDF-Format beigefügt.',
        'contact'      => 'Bei Fragen zu Ihrer Versicherung wenden Sie sich bitte jederzeit an Ihren Berater.',
        'closing'      => 'Mit freundlichen Grüßen,',
        'team'         => 'Das ' . site_name() . '-Team',
    ],
    'lt' => [
        'title'    => 'Skolininko draudimo pažymėjimas — Nr. '.$loan->reference,
        'sub'      => 'Draudimas CG-A340G',
        'greeting' => $greetings['lt'][$gender],
        'intro'    => 'Pridedame jūsų <strong>skolininko draudimo pažymėjimą</strong> (nuoroda <strong>'.$loan->reference.'</strong>), kurį išdavė ' . site_name() . ' jūsų finansavimo bylos rėmuose.',
        'summary'  => 'JŪSŲ DRAUDIMO SANTRAUKA',
        'lbl_ref'  => 'Bylos numeris',
        'lbl_montant'  => 'Apdrausta suma',
        'lbl_duree'    => 'Trukmė',
        'lbl_months'   => 'mėn.',
        'lbl_frais'    => 'Draudimo mokestis',
        'lbl_fin'      => 'Draudimo pabaigos data',
        'attach_note'  => 'Jūsų CG-A340G draudimo pažymėjimas pridedamas prie šio el. laiško PDF formatu.',
        'contact'      => 'Iškilus bet kokiems klausimams dėl jūsų draudimo, nedvejodami susisiekite su savo konsultantu.',
        'closing'      => 'Pagarbiai,',
        'team'         => site_name() . ' komanda',
    ],
    'ro' => [
        'title'    => 'Certificat de asigurare a împrumutatului — nr. '.$loan->reference,
        'sub'      => 'Asigurare CG-A340G',
        'greeting' => $greetings['ro'][$gender],
        'intro'    => 'Veți găsi atașat <strong>certificatul dumneavoastră de asigurare a împrumutatului</strong> (referință <strong>'.$loan->reference.'</strong>) emis de ' . site_name() . ' în cadrul dosarului dumneavoastră de finanțare.',
        'summary'  => 'REZUMATUL ASIGURĂRII DUMNEAVOASTRĂ',
        'lbl_ref'  => 'Referință dosar',
        'lbl_montant'  => 'Sumă asigurată',
        'lbl_duree'    => 'Durată',
        'lbl_months'   => 'luni',
        'lbl_frais'    => 'Taxă de asigurare',
        'lbl_fin'      => 'Data de expirare a asigurării',
        'attach_note'  => 'Certificatul dumneavoastră de asigurare CG-A340G este atașat acestui e-mail în format PDF.',
        'contact'      => 'Pentru orice întrebare privind asigurarea dumneavoastră, nu ezitați să contactați consilierul dumneavoastră.',
        'closing'      => 'Cu stimă,',
        'team'         => 'Echipa ' . site_name(),
    ],
    'lv' => [
        'title'    => 'Aizņēmēja apdrošināšanas apliecība — Nr. '.$loan->reference,
        'sub'      => 'Apdrošināšana CG-A340G',
        'greeting' => $greetings['lv'][$gender],
        'intro'    => 'Pielikumā atradīsiet savu <strong>aizņēmēja apdrošināšanas apliecību</strong> (atsauce <strong>'.$loan->reference.'</strong>), ko izsniedza ' . site_name() . ' jūsu finansējuma lietas ietvaros.',
        'summary'  => 'JŪSU APDROŠINĀŠANAS KOPSAVILKUMS',
        'lbl_ref'  => 'Lietas atsauce',
        'lbl_montant'  => 'Apdrošinātā summa',
        'lbl_duree'    => 'Termiņš',
        'lbl_months'   => 'mēneši',
        'lbl_frais'    => 'Apdrošināšanas maksa',
        'lbl_fin'      => 'Apdrošināšanas beigu datums',
        'attach_note'  => 'Jūsu CG-A340G apdrošināšanas apliecība ir pievienota šim e-pastam PDF formātā.',
        'contact'      => 'Ja jums ir kādi jautājumi par savu apdrošināšanu, nevilcinieties sazināties ar savu konsultantu.',
        'closing'      => 'Ar cieņu,',
        'team'         => site_name() . ' komanda',
    ],
    'nl' => [
        'title'    => 'Verzekeringsattest kredietnemer — Nr. '.$loan->reference,
        'sub'      => 'Verzekering CG-A340G',
        'greeting' => $greetings['nl'][$gender],
        'intro'    => 'Bijgevoegd vindt u uw <strong>verzekeringsattest kredietnemer</strong> (referentie <strong>'.$loan->reference.'</strong>), afgegeven door ' . site_name() . ' in het kader van uw financieringsdossier.',
        'summary'  => 'OVERZICHT VAN UW VERZEKERING',
        'lbl_ref'  => 'Dossierreferentie',
        'lbl_montant'  => 'Verzekerd bedrag',
        'lbl_duree'    => 'Looptijd',
        'lbl_months'   => 'maanden',
        'lbl_frais'    => 'Verzekeringskosten',
        'lbl_fin'      => 'Einddatum verzekering',
        'attach_note'  => 'Uw verzekeringsattest CG-A340G is als PDF-bijlage bij deze e-mail gevoegd.',
        'contact'      => 'Voor vragen over uw verzekering kunt u gerust contact opnemen met uw adviseur.',
        'closing'      => 'Met vriendelijke groet,',
        'team'         => 'Het ' . site_name() . ' Team',
    ],
];

$t = $texts[$locale] ?? $texts['fr'];
@endphp

<x-email-layout
    :title="$t['title']"
    :subtitle="$t['sub']"
    accent="green"
    :locale="$locale"
>

  <p class="greeting">{{ $t['greeting'] }}</p>

  <p class="body-text">{!! $t['intro'] !!}</p>

  <div class="panel">
    <div class="panel-row">
      <span class="panel-lbl">{{ $t['lbl_ref'] }}</span>
      <span class="panel-val">{{ $loan->reference }}</span>
    </div>
    <div class="panel-row">
      <span class="panel-lbl">{{ $t['lbl_montant'] }}</span>
      <span class="panel-val accent">{{ number_format($loan->amount, 2, ',', ' ') }} {{ $loan->currency }}</span>
    </div>
    <div class="panel-row">
      <span class="panel-lbl">{{ $t['lbl_duree'] }}</span>
      <span class="panel-val">{{ $loan->darly }} {{ $t['lbl_months'] }}</span>
    </div>
    @if($loan->frais_assurance)
    <div class="panel-row">
      <span class="panel-lbl">{{ $t['lbl_frais'] }}</span>
      <span class="panel-val">{{ number_format($loan->frais_assurance, 2, ',', ' ') }} {{ $loan->currency }}</span>
    </div>
    @endif
    @if($loan->date_fin_assurance)
    <div class="panel-row">
      <span class="panel-lbl">{{ $t['lbl_fin'] }}</span>
      <span class="panel-val">{{ $loan->date_fin_assurance->format('d/m/Y') }}</span>
    </div>
    @endif
  </div>

  <div class="alert alert-info">
    <p>{!! $t['attach_note'] !!}</p>
  </div>

  <p class="body-text">{{ $t['contact'] }}</p>

  <p class="closing">
    {{ $t['closing'] }}<br>
    <strong>{{ $t['team'] }}</strong>
  </p>

</x-email-layout>
