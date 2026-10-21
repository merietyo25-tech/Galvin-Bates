@php
$ref = $loan->reference;
$amount = number_format((float) $loan->amount, 2, ',', ' ') . ' ' . $loan->currency;

$texts = [
    'fr' => ['title'=>'Demande refusée','sub'=>'Information concernant votre dossier','greeting'=>'Bonjour','intro'=>"Nous sommes au regret de vous informer que votre demande de financement n'a pas pu être <strong>acceptée</strong>.",'lbl_ref'=>'Référence','lbl_amount'=>'Montant demandé','lbl_reason'=>'Motif du refus','body'=>'Pour toute question ou pour soumettre une nouvelle demande, contactez votre conseiller.','btn_details'=>'Voir les prochaines étapes','closing'=>'Cordialement,','team'=>"L'équipe " . site_name()],
    'en' => ['title'=>'Request declined','sub'=>'Information about your file','greeting'=>'Hello','intro'=>'We regret to inform you that your financing request could not be <strong>approved</strong>.','lbl_ref'=>'Reference','lbl_amount'=>'Requested amount','lbl_reason'=>'Reason for refusal','body'=>'For any questions or to submit a new request, please contact your advisor.','btn_details'=>'View next steps','closing'=>'Best regards,','team'=>'The ' . site_name() . ' team'],
    'pl' => ['title'=>'Wniosek odrzucony','sub'=>'Informacja dotycząca Twojego wniosku','greeting'=>'Witaj','intro'=>'Z przykrością informujemy, że Twój wniosek o finansowanie nie mógł zostać <strong>zaakceptowany</strong>.','lbl_ref'=>'Referencja','lbl_amount'=>'Wnioskowana kwota','lbl_reason'=>'Powód odrzucenia','body'=>'W razie pytań lub aby złożyć nowy wniosek, skontaktuj się ze swoim doradcą.','btn_details'=>'Zobacz kolejne kroki','closing'=>'Z poważaniem,','team'=>'Zespół ' . site_name()],
    'es' => ['title'=>'Solicitud rechazada','sub'=>'Información sobre su expediente','greeting'=>'Hola','intro'=>'Lamentamos informarle que su solicitud de financiación no pudo ser <strong>aprobada</strong>.','lbl_ref'=>'Referencia','lbl_amount'=>'Importe solicitado','lbl_reason'=>'Motivo del rechazo','body'=>'Para cualquier consulta o para presentar una nueva solicitud, contacte a su asesor.','btn_details'=>'Ver los próximos pasos','closing'=>'Atentamente,','team'=>'El equipo ' . site_name()],
    'bg' => ['title'=>'Заявката е отхвърлена','sub'=>'Информация относно вашето досие','greeting'=>'Здравейте','intro'=>'Съжаляваме да ви уведомим, че вашата заявка за финансиране не можа да бъде <strong>одобрена</strong>.','lbl_ref'=>'Референция','lbl_amount'=>'Заявена сума','lbl_reason'=>'Причина за отказа','body'=>'При въпроси или за да подадете нова заявка, свържете се с вашия консултант.','btn_details'=>'Вижте следващите стъпки','closing'=>'С уважение,','team'=>'Екипът на ' . site_name()],
    'hu' => ['title'=>'Kérelem elutasítva','sub'=>'Tájékoztatás ügyéről','greeting'=>'Üdvözöljük','intro'=>'Sajnálattal tájékoztatjuk, hogy finanszírozási kérelmét nem tudtuk <strong>jóváhagyni</strong>.','lbl_ref'=>'Ügyszám','lbl_amount'=>'Igényelt összeg','lbl_reason'=>'Az elutasítás oka','body'=>'Bármilyen kérdés esetén, vagy új kérelem benyújtásához forduljon tanácsadójához.','btn_details'=>'Következő lépések megtekintése','closing'=>'Tisztelettel,','team'=>'A ' . site_name() . ' csapata'],
    'it' => ['title'=>'Richiesta respinta','sub'=>'Informazioni sulla tua pratica','greeting'=>'Ciao','intro'=>'Siamo spiacenti di informarti che la tua richiesta di finanziamento non ha potuto essere <strong>approvata</strong>.','lbl_ref'=>'Riferimento','lbl_amount'=>'Importo richiesto','lbl_reason'=>'Motivo del rifiuto','body'=>'Per qualsiasi domanda o per presentare una nuova richiesta, contatta il tuo consulente.','btn_details'=>'Vedi i prossimi passi','closing'=>'Cordiali saluti,','team'=>'Il team ' . site_name()],
    'de' => ['title'=>'Antrag abgelehnt','sub'=>'Information zu Ihrer Akte','greeting'=>'Guten Tag','intro'=>'Wir müssen Ihnen leider mitteilen, dass Ihr Finanzierungsantrag nicht <strong>genehmigt</strong> werden konnte.','lbl_ref'=>'Referenz','lbl_amount'=>'Beantragter Betrag','lbl_reason'=>'Ablehnungsgrund','body'=>'Bei Fragen oder zur Einreichung eines neuen Antrags wenden Sie sich bitte an Ihren Berater.','btn_details'=>'Nächste Schritte ansehen','closing'=>'Mit freundlichen Grüßen,','team'=>'Das ' . site_name() . ' Team'],
    'lt' => ['title'=>'Paraiška atmesta','sub'=>'Informacija apie jūsų bylą','greeting'=>'Sveiki','intro'=>'Su apgailestavimu pranešame, kad jūsų finansavimo paraiška negalėjo būti <strong>patvirtinta</strong>.','lbl_ref'=>'Numeris','lbl_amount'=>'Prašoma suma','lbl_reason'=>'Atmetimo priežastis','body'=>'Iškilus klausimams arba norėdami pateikti naują paraišką, susisiekite su savo konsultantu.','btn_details'=>'Peržiūrėti tolimesnius žingsnius','closing'=>'Pagarbiai,','team'=>site_name() . ' komanda'],
    'ro' => ['title'=>'Cerere respinsă','sub'=>'Informații despre dosarul dumneavoastră','greeting'=>'Bună ziua','intro'=>'Regretăm să vă informăm că cererea dumneavoastră de finanțare nu a putut fi <strong>aprobată</strong>.','lbl_ref'=>'Referință','lbl_amount'=>'Sumă solicitată','lbl_reason'=>'Motivul refuzului','body'=>'Pentru orice întrebare sau pentru a depune o nouă cerere, contactați consilierul dumneavoastră.','btn_details'=>'Vezi următorii pași','closing'=>'Cu stimă,','team'=>'Echipa ' . site_name()],
    'lv' => ['title'=>'Pieteikums noraidīts','sub'=>'Informācija par jūsu lietu','greeting'=>'Sveiki','intro'=>'Mums ir žēl jums paziņot, ka jūsu finansējuma pieteikums nevarēja tikt <strong>apstiprināts</strong>.','lbl_ref'=>'Atsauce','lbl_amount'=>'Pieprasītā summa','lbl_reason'=>'Atteikuma iemesls','body'=>'Ja jums ir kādi jautājumi vai vēlaties iesniegt jaunu pieteikumu, sazinieties ar savu konsultantu.','btn_details'=>'Skatīt nākamos soļus','closing'=>'Ar cieņu,','team'=>site_name() . ' komanda'],
    'nl' => ['title'=>'Aanvraag afgewezen','sub'=>'Informatie over uw dossier','greeting'=>'Hallo','intro'=>'Wij moeten u helaas meedelen dat uw financieringsaanvraag niet kon worden <strong>goedgekeurd</strong>.','lbl_ref'=>'Referentie','lbl_amount'=>'Aangevraagd bedrag','lbl_reason'=>'Reden van afwijzing','body'=>'Voor vragen of om een nieuwe aanvraag in te dienen, neemt u contact op met uw adviseur.','btn_details'=>'Bekijk volgende stappen','closing'=>'Met vriendelijke groet,','team'=>'Het ' . site_name() . ' Team'],
    'pt' => ['title'=>'Pedido recusado','sub'=>'Informação sobre o seu processo','greeting'=>'Olá','intro'=>'Lamentamos informar que o seu pedido de financiamento não pôde ser <strong>aprovado</strong>.','lbl_ref'=>'Referência','lbl_amount'=>'Montante solicitado','lbl_reason'=>'Motivo da recusa','body'=>'Para qualquer questão ou para submeter um novo pedido, contacte o seu consultor.','btn_details'=>'Ver próximos passos','closing'=>'Atenciosamente,','team'=>'A equipa ' . site_name()],
];

$t = $texts[$locale] ?? $texts['fr'];
@endphp

<x-email-layout
    :title="$t['title']"
    :subtitle="$t['sub']"
    accent="red"
    :locale="$locale"
>

  <p class="greeting">
    {{ $t['greeting'] }} {{ $loan->name }},
  </p>

  <p class="body-text">{!! $t['intro'] !!}</p>

  <div class="panel">
    <div class="panel-row">
      <span class="panel-lbl">{{ $t['lbl_ref'] }}</span>
      <span class="panel-val">{{ $ref }}</span>
    </div>
    <div class="panel-row">
      <span class="panel-lbl">{{ $t['lbl_amount'] }}</span>
      <span class="panel-val">{{ $amount }}</span>
    </div>
  </div>

  <div class="alert alert-danger">
    <strong>{{ $t['lbl_reason'] }}</strong>
    <p>{{ $reason }}</p>
  </div>

  <p class="body-text">{{ $t['body'] }}</p>

  <div class="btn-wrap">
    <a href="{{ $outcomeUrl }}" class="btn">{{ $t['btn_details'] }}</a>
  </div>

  <p class="closing">
    {{ $t['closing'] }}<br>
    <strong>{{ $t['team'] }}</strong>
  </p>

</x-email-layout>
