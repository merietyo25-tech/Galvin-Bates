@php
$ref     = $loan->reference;
$amount  = number_format((float) $loan->amount, 2, ',', ' ');
$currency = $loan->currency ?? \App\Models\Currency::default();
$name    = $loan->client?->name ?? $loan->name;

$texts = [
    'credited' => [
        'fr' => ['title'=>'Dossier finalisé','sub'=>'Fonds crédités','greeting'=>'Bonjour '.$name.',','intro'=>'Nous vous confirmons que votre dossier de financement (Référence : <strong>'.$ref.'</strong>) a été <strong>finalisé</strong>.','detail'=>'Le montant de <strong>'.$amount.' '.$currency.'</strong> a été crédité sur votre compte.','closing'=>'Cordialement,','team'=>"L'équipe " . site_name()],
        'en' => ['title'=>'File finalized','sub'=>'Funds credited','greeting'=>'Hello '.$name.',','intro'=>'We confirm that your financing file (Reference: <strong>'.$ref.'</strong>) has been <strong>finalized</strong>.','detail'=>'The amount of <strong>'.$amount.' '.$currency.'</strong> has been credited to your account.','closing'=>'Best regards,','team'=>'The ' . site_name() . ' team'],
        'es' => ['title'=>'Expediente finalizado','sub'=>'Fondos abonados','greeting'=>'Hola '.$name.',','intro'=>'Le confirmamos que su expediente de financiación (Referencia: <strong>'.$ref.'</strong>) ha sido <strong>finalizado</strong>.','detail'=>'El importe de <strong>'.$amount.' '.$currency.'</strong> ha sido abonado en su cuenta.','closing'=>'Atentamente,','team'=>'El equipo ' . site_name()],
        'pl' => ['title'=>'Wniosek sfinalizowany','sub'=>'Środki zaksięgowane','greeting'=>'Witaj '.$name.',','intro'=>'Potwierdzamy, że Twój wniosek o finansowanie (Nr referencyjny: <strong>'.$ref.'</strong>) został <strong>sfinalizowany</strong>.','detail'=>'Kwota <strong>'.$amount.' '.$currency.'</strong> została zaksięgowana na Twoim koncie.','closing'=>'Z poważaniem,','team'=>'Zespół ' . site_name()],
        'bg' => ['title'=>'Досие финализирано','sub'=>'Средствата са преведени','greeting'=>'Здравейте '.$name.',','intro'=>'Потвърждаваме, че вашето досие за финансиране (Референция: <strong>'.$ref.'</strong>) беше <strong>финализирано</strong>.','detail'=>'Сумата от <strong>'.$amount.' '.$currency.'</strong> беше преведена по вашата сметка.','closing'=>'С уважение,','team'=>'Екипът на ' . site_name()],
        'hu' => ['title'=>'Ügy véglegesítve','sub'=>'Összeg jóváírva','greeting'=>'Üdvözöljük '.$name.',','intro'=>'Megerősítjük, hogy finanszírozási ügye (Hivatkozási szám: <strong>'.$ref.'</strong>) <strong>véglegesítésre</strong> került.','detail'=>'A(z) <strong>'.$amount.' '.$currency.'</strong> összeg jóváírásra került számláján.','closing'=>'Tisztelettel,','team'=>'A ' . site_name() . ' csapata'],
        'it' => ['title'=>'Pratica finalizzata','sub'=>'Fondi accreditati','greeting'=>'Ciao '.$name.',','intro'=>'Ti confermiamo che la tua pratica di finanziamento (Riferimento: <strong>'.$ref.'</strong>) è stata <strong>finalizzata</strong>.','detail'=>'L\'importo di <strong>'.$amount.' '.$currency.'</strong> è stato accreditato sul tuo conto.','closing'=>'Cordiali saluti,','team'=>'Il team ' . site_name()],
        'de' => ['title'=>'Akte abgeschlossen','sub'=>'Betrag gutgeschrieben','greeting'=>'Guten Tag '.$name.',','intro'=>'Wir bestätigen Ihnen, dass Ihre Finanzierungsakte (Referenz: <strong>'.$ref.'</strong>) <strong>abgeschlossen</strong> wurde.','detail'=>'Der Betrag von <strong>'.$amount.' '.$currency.'</strong> wurde Ihrem Konto gutgeschrieben.','closing'=>'Mit freundlichen Grüßen,','team'=>'Das ' . site_name() . '-Team'],
        'lt' => ['title'=>'Byla užbaigta','sub'=>'Lėšos pervestos','greeting'=>'Sveiki, '.$name.',','intro'=>'Patvirtiname, kad jūsų finansavimo byla (Nuoroda: <strong>'.$ref.'</strong>) buvo <strong>užbaigta</strong>.','detail'=>'Suma <strong>'.$amount.' '.$currency.'</strong> buvo pervesta į jūsų sąskaitą.','closing'=>'Pagarbiai,','team'=>site_name() . ' komanda'],
        'ro' => ['title'=>'Dosar finalizat','sub'=>'Fonduri creditate','greeting'=>'Bună ziua, '.$name.',','intro'=>'Vă confirmăm că dosarul dumneavoastră de finanțare (Referință: <strong>'.$ref.'</strong>) a fost <strong>finalizat</strong>.','detail'=>'Suma de <strong>'.$amount.' '.$currency.'</strong> a fost creditată în contul dumneavoastră.','closing'=>'Cu stimă,','team'=>'Echipa ' . site_name()],
        'lv' => ['title'=>'Lieta pabeigta','sub'=>'Līdzekļi ieskaitīti','greeting'=>'Sveiki, '.$name.',','intro'=>'Apstiprinām, ka jūsu finansējuma lieta (Atsauce: <strong>'.$ref.'</strong>) ir <strong>pabeigta</strong>.','detail'=>'Summa <strong>'.$amount.' '.$currency.'</strong> ir ieskaitīta jūsu kontā.','closing'=>'Ar cieņu,','team'=>site_name() . ' komanda'],
        'nl' => ['title'=>'Dossier afgerond','sub'=>'Bedrag gestort','greeting'=>'Hallo '.$name.',','intro'=>'Wij bevestigen dat uw financieringsdossier (Referentie: <strong>'.$ref.'</strong>) is <strong>afgerond</strong>.','detail'=>'Het bedrag van <strong>'.$amount.' '.$currency.'</strong> is op uw rekening gestort.','closing'=>'Met vriendelijke groet,','team'=>'Het team van ' . site_name()],
        'pt' => ['title'=>'Processo finalizado','sub'=>'Fundos creditados','greeting'=>'Olá '.$name.',','intro'=>'Confirmamos que o seu processo de financiamento (Referência: <strong>'.$ref.'</strong>) foi <strong>finalizado</strong>.','detail'=>'O montante de <strong>'.$amount.' '.$currency.'</strong> foi creditado na sua conta.','closing'=>'Atenciosamente,','team'=>'A equipa ' . site_name()],
        'hr' => ['title'=>'Dosje završen','sub'=>'Sredstva odobrena','greeting'=>'Pozdrav '.$name.',','intro'=>'Potvrđujemo da je vaš dosje financiranja (Referenca: <strong>'.$ref.'</strong>) <strong>završen</strong>.','detail'=>'Iznos od <strong>'.$amount.' '.$currency.'</strong> odobren je na vašem računu.','closing'=>'S poštovanjem,','team'=>'Tim ' . site_name()],
    ],
    'not_credited' => [
        'fr' => ['title'=>'Dossier finalisé','sub'=>site_name(),'greeting'=>'Bonjour '.$name.',','intro'=>'Nous vous confirmons que votre dossier de financement (Référence : <strong>'.$ref.'</strong>) a été <strong>finalisé</strong>.','detail'=>'Notre équipe reste à votre disposition pour toute question concernant la suite de votre dossier.','closing'=>'Cordialement,','team'=>"L'équipe " . site_name()],
        'en' => ['title'=>'File finalized','sub'=>site_name(),'greeting'=>'Hello '.$name.',','intro'=>'We confirm that your financing file (Reference: <strong>'.$ref.'</strong>) has been <strong>finalized</strong>.','detail'=>'Our team remains available for any questions regarding the next steps of your file.','closing'=>'Best regards,','team'=>'The ' . site_name() . ' team'],
        'es' => ['title'=>'Expediente finalizado','sub'=>site_name(),'greeting'=>'Hola '.$name.',','intro'=>'Le confirmamos que su expediente de financiación (Referencia: <strong>'.$ref.'</strong>) ha sido <strong>finalizado</strong>.','detail'=>'Nuestro equipo queda a su disposición para cualquier pregunta sobre el seguimiento de su expediente.','closing'=>'Atentamente,','team'=>'El equipo ' . site_name()],
        'pl' => ['title'=>'Wniosek sfinalizowany','sub'=>site_name(),'greeting'=>'Witaj '.$name.',','intro'=>'Potwierdzamy, że Twój wniosek o finansowanie (Nr referencyjny: <strong>'.$ref.'</strong>) został <strong>sfinalizowany</strong>.','detail'=>'Nasz zespół pozostaje do Twojej dyspozycji w razie pytań dotyczących dalszych kroków.','closing'=>'Z poważaniem,','team'=>'Zespół ' . site_name()],
        'bg' => ['title'=>'Досие финализирано','sub'=>site_name(),'greeting'=>'Здравейте '.$name.',','intro'=>'Потвърждаваме, че вашето досие за финансиране (Референция: <strong>'.$ref.'</strong>) беше <strong>финализирано</strong>.','detail'=>'Нашият екип остава на разположение за всякакви въпроси относно следващите стъпки по досието ви.','closing'=>'С уважение,','team'=>'Екипът на ' . site_name()],
        'hu' => ['title'=>'Ügy véglegesítve','sub'=>site_name(),'greeting'=>'Üdvözöljük '.$name.',','intro'=>'Megerősítjük, hogy finanszírozási ügye (Hivatkozási szám: <strong>'.$ref.'</strong>) <strong>véglegesítésre</strong> került.','detail'=>'Csapatunk továbbra is rendelkezésére áll ügye további lépéseivel kapcsolatos kérdéseiben.','closing'=>'Tisztelettel,','team'=>'A ' . site_name() . ' csapata'],
        'it' => ['title'=>'Pratica finalizzata','sub'=>site_name(),'greeting'=>'Ciao '.$name.',','intro'=>'Ti confermiamo che la tua pratica di finanziamento (Riferimento: <strong>'.$ref.'</strong>) è stata <strong>finalizzata</strong>.','detail'=>'Il nostro team resta a tua disposizione per qualsiasi domanda relativa al seguito della tua pratica.','closing'=>'Cordiali saluti,','team'=>'Il team ' . site_name()],
        'de' => ['title'=>'Akte abgeschlossen','sub'=>site_name(),'greeting'=>'Guten Tag '.$name.',','intro'=>'Wir bestätigen Ihnen, dass Ihre Finanzierungsakte (Referenz: <strong>'.$ref.'</strong>) <strong>abgeschlossen</strong> wurde.','detail'=>'Unser Team steht Ihnen für alle Fragen zu den weiteren Schritten Ihrer Akte gerne zur Verfügung.','closing'=>'Mit freundlichen Grüßen,','team'=>'Das ' . site_name() . '-Team'],
        'lt' => ['title'=>'Byla užbaigta','sub'=>site_name(),'greeting'=>'Sveiki, '.$name.',','intro'=>'Patvirtiname, kad jūsų finansavimo byla (Nuoroda: <strong>'.$ref.'</strong>) buvo <strong>užbaigta</strong>.','detail'=>'Mūsų komanda pasirengusi atsakyti į bet kokius klausimus dėl tolesnių jūsų bylos veiksmų.','closing'=>'Pagarbiai,','team'=>site_name() . ' komanda'],
        'ro' => ['title'=>'Dosar finalizat','sub'=>site_name(),'greeting'=>'Bună ziua, '.$name.',','intro'=>'Vă confirmăm că dosarul dumneavoastră de finanțare (Referință: <strong>'.$ref.'</strong>) a fost <strong>finalizat</strong>.','detail'=>'Echipa noastră rămâne la dispoziția dumneavoastră pentru orice întrebare privind continuarea dosarului.','closing'=>'Cu stimă,','team'=>'Echipa ' . site_name()],
        'lv' => ['title'=>'Lieta pabeigta','sub'=>site_name(),'greeting'=>'Sveiki, '.$name.',','intro'=>'Apstiprinām, ka jūsu finansējuma lieta (Atsauce: <strong>'.$ref.'</strong>) ir <strong>pabeigta</strong>.','detail'=>'Mūsu komanda ir pieejama, ja jums rodas kādi jautājumi par jūsu lietas turpmāko virzību.','closing'=>'Ar cieņu,','team'=>site_name() . ' komanda'],
        'nl' => ['title'=>'Dossier afgerond','sub'=>site_name(),'greeting'=>'Hallo '.$name.',','intro'=>'Wij bevestigen dat uw financieringsdossier (Referentie: <strong>'.$ref.'</strong>) is <strong>afgerond</strong>.','detail'=>'Ons team blijft tot uw beschikking voor eventuele vragen over het vervolg van uw dossier.','closing'=>'Met vriendelijke groet,','team'=>'Het team van ' . site_name()],
        'pt' => ['title'=>'Processo finalizado','sub'=>site_name(),'greeting'=>'Olá '.$name.',','intro'=>'Confirmamos que o seu processo de financiamento (Referência: <strong>'.$ref.'</strong>) foi <strong>finalizado</strong>.','detail'=>'A nossa equipa permanece à sua disposição para qualquer questão relativa ao seguimento do seu processo.','closing'=>'Atenciosamente,','team'=>'A equipa ' . site_name()],
        'hr' => ['title'=>'Dosje završen','sub'=>site_name(),'greeting'=>'Pozdrav '.$name.',','intro'=>'Potvrđujemo da je vaš dosje financiranja (Referenca: <strong>'.$ref.'</strong>) <strong>završen</strong>.','detail'=>'Naš tim ostaje na raspolaganju za sva pitanja vezana uz nastavak vašeg dosjea.','closing'=>'S poštovanjem,','team'=>'Tim ' . site_name()],
    ],
];

$key = $credited ? 'credited' : 'not_credited';
$t   = $texts[$key][$locale] ?? $texts[$key]['fr'];
@endphp

<x-email-layout
    :title="$t['title']"
    :subtitle="$t['sub']"
    accent="green"
    :locale="$locale"
>

  <p class="greeting">{{ $t['greeting'] }}</p>

  <p class="body-text">{!! $t['intro'] !!}</p>

  <div class="alert alert-success">
    <p>{!! $t['detail'] !!}</p>
  </div>

  <p class="closing">
    {{ $t['closing'] }}<br>
    <strong>{{ $t['team'] }}</strong>
  </p>

</x-email-layout>
