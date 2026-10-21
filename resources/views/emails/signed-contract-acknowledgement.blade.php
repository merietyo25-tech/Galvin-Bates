@php
$texts = [
    'fr' => [
        'title'   => 'Contrat N°'.$loan->reference.' reçu',
        'sub'     => 'Accusé de réception',
        'greeting'=> 'Madame / Monsieur '.$loan->name.',',
        'intro'   => 'Nous accusons bonne réception de votre contrat de prêt signé (Référence : <strong>'.$loan->reference.'</strong>).',
        'next'    => 'Notre équipe de gestion va procéder au traitement final de votre dossier. Les coordonnées du compte et les modalités de versement vous seront communiquées sous <strong>24 à 48 heures</strong>.',
        'closing' => 'Cordialement,',
        'team'    => "L'équipe " . site_name(),
    ],
    'en' => [
        'title'   => 'Contract N°'.$loan->reference.' received',
        'sub'     => 'Acknowledgement of receipt',
        'greeting'=> 'Dear '.$loan->name.',',
        'intro'   => 'We confirm receipt of your signed loan contract (Reference: <strong>'.$loan->reference.'</strong>).',
        'next'    => 'Our management team will proceed with the final processing of your file. Payment account details will be communicated within <strong>24 to 48 hours</strong>.',
        'closing' => 'Yours sincerely,',
        'team'    => 'The ' . site_name() . ' team',
    ],
    'es' => [
        'title'   => 'Contrato N°'.$loan->reference.' recibido',
        'sub'     => 'Acuse de recibo',
        'greeting'=> 'Estimado/a '.$loan->name.',',
        'intro'   => 'Confirmamos la recepción de su contrato de préstamo firmado (Referencia: <strong>'.$loan->reference.'</strong>).',
        'next'    => 'Nuestro equipo de gestión procederá al tratamiento final de su expediente. Los datos de la cuenta de pago le serán comunicados en <strong>24 a 48 horas</strong>.',
        'closing' => 'Atentamente,',
        'team'    => 'El equipo ' . site_name(),
    ],
    'pl' => [
        'title'   => 'Umowa nr '.$loan->reference.' odebrana',
        'sub'     => 'Potwierdzenie odbioru',
        'greeting'=> 'Szanowny/a '.$loan->name.',',
        'intro'   => 'Potwierdzamy otrzymanie Państwa podpisanej umowy pożyczkowej (Nr referencyjny: <strong>'.$loan->reference.'</strong>).',
        'next'    => 'Nasz zespół przystąpi do ostatecznego rozpatrzenia Państwa wniosku. Dane rachunku bankowego zostaną przekazane w ciągu <strong>24 do 48 godzin</strong>.',
        'closing' => 'Z poważaniem,',
        'team'    => 'Zespół ' . site_name(),
    ],
    'bg' => [
        'title'   => 'Договор №'.$loan->reference.' получен',
        'sub'     => 'Потвърждение за получаване',
        'greeting'=> 'Уважаеми/а '.$loan->name.',',
        'intro'   => 'Потвърждаваме получаването на вашия подписан договор за заем (Референция: <strong>'.$loan->reference.'</strong>).',
        'next'    => 'Нашият екип за управление ще пристъпи към окончателната обработка на вашето досие. Данните на сметката ще ви бъдат съобщени в рамките на <strong>24 до 48 часа</strong>.',
        'closing' => 'С уважение,',
        'team'    => 'Екипът на ' . site_name(),
    ],
    'hu' => [
        'title'   => 'A(z) '.$loan->reference.' sz. szerződés beérkezett',
        'sub'     => 'Átvétel visszaigazolása',
        'greeting'=> 'Tisztelt '.$loan->name.'!',
        'intro'   => 'Visszaigazoljuk aláírt kölcsönszerződésének beérkezését (Hivatkozási szám: <strong>'.$loan->reference.'</strong>).',
        'next'    => 'Ügykezelő csapatunk elvégzi ügye végleges feldolgozását. A fizetési számla adatait <strong>24–48 órán belül</strong> közöljük Önnel.',
        'closing' => 'Tisztelettel,',
        'team'    => 'A ' . site_name() . ' csapata',
    ],
    'it' => [
        'title'   => 'Contratto N°'.$loan->reference.' ricevuto',
        'sub'     => 'Conferma di ricezione',
        'greeting'=> 'Gentile '.$loan->name.',',
        'intro'   => 'Confermiamo la ricezione del tuo contratto di prestito firmato (Riferimento: <strong>'.$loan->reference.'</strong>).',
        'next'    => 'Il nostro team di gestione procederà alla lavorazione finale della tua pratica. I dati del conto ti saranno comunicati entro <strong>24-48 ore</strong>.',
        'closing' => 'Cordiali saluti,',
        'team'    => 'Il team ' . site_name(),
    ],
    'de' => [
        'title'   => 'Vertrag Nr. '.$loan->reference.' eingegangen',
        'sub'     => 'Empfangsbestätigung',
        'greeting'=> 'Sehr geehrte Damen und Herren '.$loan->name.',',
        'intro'   => 'Wir bestätigen den Eingang Ihres unterschriebenen Kreditvertrags (Referenz: <strong>'.$loan->reference.'</strong>).',
        'next'    => 'Unser Verwaltungsteam wird nun die endgültige Bearbeitung Ihrer Akte vornehmen. Die Kontodaten werden Ihnen innerhalb von <strong>24 bis 48 Stunden</strong> mitgeteilt.',
        'closing' => 'Mit freundlichen Grüßen,',
        'team'    => 'Das ' . site_name() . '-Team',
    ],
    'lt' => [
        'title'   => 'Sutartis Nr. '.$loan->reference.' gauta',
        'sub'     => 'Gavimo patvirtinimas',
        'greeting'=> 'Gerbiamas (-a) '.$loan->name.',',
        'intro'   => 'Patvirtiname jūsų pasirašytos paskolos sutarties gavimą (Nuoroda: <strong>'.$loan->reference.'</strong>).',
        'next'    => 'Mūsų valdymo komanda atliks galutinį jūsų bylos apdorojimą. Sąskaitos duomenys jums bus pateikti per <strong>24–48 valandas</strong>.',
        'closing' => 'Pagarbiai,',
        'team'    => site_name() . ' komanda',
    ],
    'ro' => [
        'title'   => 'Contractul nr. '.$loan->reference.' primit',
        'sub'     => 'Confirmare de primire',
        'greeting'=> 'Stimate/Stimată '.$loan->name.',',
        'intro'   => 'Confirmăm primirea contractului dumneavoastră de împrumut semnat (Referință: <strong>'.$loan->reference.'</strong>).',
        'next'    => 'Echipa noastră de gestiune va proceda la procesarea finală a dosarului dumneavoastră. Datele contului vă vor fi comunicate în <strong>24 până la 48 de ore</strong>.',
        'closing' => 'Cu stimă,',
        'team'    => 'Echipa ' . site_name(),
    ],
    'lv' => [
        'title'   => 'Līgums Nr. '.$loan->reference.' saņemts',
        'sub'     => 'Saņemšanas apstiprinājums',
        'greeting'=> 'Godātais/Godātā '.$loan->name.',',
        'intro'   => 'Apstiprinām jūsu parakstītā aizdevuma līguma saņemšanu (Atsauce: <strong>'.$loan->reference.'</strong>).',
        'next'    => 'Mūsu pārvaldības komanda veiks jūsu lietas galīgo apstrādi. Konta dati jums tiks paziņoti <strong>24 līdz 48 stundu</strong> laikā.',
        'closing' => 'Ar cieņu,',
        'team'    => site_name() . ' komanda',
    ],
    'nl' => [
        'title'   => 'Contract nr. '.$loan->reference.' ontvangen',
        'sub'     => 'Ontvangstbevestiging',
        'greeting'=> 'Geachte heer/mevrouw '.$loan->name.',',
        'intro'   => 'Wij bevestigen de ontvangst van uw ondertekende leningsovereenkomst (Referentie: <strong>'.$loan->reference.'</strong>).',
        'next'    => 'Ons beheerteam zal overgaan tot de definitieve verwerking van uw dossier. De gegevens van de betaalrekening worden u binnen <strong>24 tot 48 uur</strong> meegedeeld.',
        'closing' => 'Met vriendelijke groet,',
        'team'    => 'Het team van ' . site_name(),
    ],
    'pt' => [
        'title'   => 'Contrato N.º'.$loan->reference.' recebido',
        'sub'     => 'Confirmação de receção',
        'greeting'=> 'Exmo./Exma. '.$loan->name.',',
        'intro'   => 'Confirmamos a receção do seu contrato de empréstimo assinado (Referência: <strong>'.$loan->reference.'</strong>).',
        'next'    => 'A nossa equipa de gestão irá proceder ao tratamento final do seu processo. Os dados da conta e as modalidades de pagamento ser-lhe-ão comunicados no prazo de <strong>24 a 48 horas</strong>.',
        'closing' => 'Atenciosamente,',
        'team'    => 'A equipa ' . site_name(),
    ],
    'hr' => [
        'title'   => 'Ugovor br. '.$loan->reference.' primljen',
        'sub'     => 'Potvrda primitka',
        'greeting'=> 'Poštovani/Poštovana '.$loan->name.',',
        'intro'   => 'Potvrđujemo primitak vašeg potpisanog ugovora o kreditu (Referenca: <strong>'.$loan->reference.'</strong>).',
        'next'    => 'Naš tim za upravljanje pristupit će konačnoj obradi vašeg dosjea. Podaci o računu bit će vam dostavljeni u roku od <strong>24 do 48 sati</strong>.',
        'closing' => 'S poštovanjem,',
        'team'    => 'Tim ' . site_name(),
    ],
];
$t = $texts[$locale] ?? $texts['fr'];
@endphp

<x-email-layout
    :title="$t['title']"
    :subtitle="$t['sub']"
    accent="teal"
    :locale="$locale"
>

  <p class="greeting">{{ $t['greeting'] }}</p>

  <p class="body-text">{!! $t['intro'] !!}</p>

  <div class="alert alert-info">
    <p>{!! $t['next'] !!}</p>
  </div>

  <p class="closing">
    {{ $t['closing'] }}<br>
    <strong>{{ $t['team'] }}</strong>
  </p>

</x-email-layout>
