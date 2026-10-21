@php
$texts = [
    'fr' => ['title'=>'Nouveau message support','sub'=>'Support ' . site_name(),'intro'=>'vous a envoyé un message via le support ' . site_name() . '.','lbl_date'=>'Reçu le','btn'=>'Répondre au client','closing'=>'Cordialement,','team'=>"L'équipe " . site_name()],
    'en' => ['title'=>'New support message','sub'=>site_name() . ' Support','intro'=>'sent you a message via ' . site_name() . ' support.','lbl_date'=>'Received on','btn'=>'Reply to client','closing'=>'Best regards,','team'=>'The ' . site_name() . ' team'],
    'es' => ['title'=>'Nuevo mensaje de soporte','sub'=>'Soporte ' . site_name(),'intro'=>'le ha enviado un mensaje a través del soporte de ' . site_name() . '.','lbl_date'=>'Recibido el','btn'=>'Responder al cliente','closing'=>'Atentamente,','team'=>'El equipo ' . site_name()],
    'pl' => ['title'=>'Nowa wiadomość wsparcia','sub'=>'Wsparcie ' . site_name(),'intro'=>'wysłał(a) Ci wiadomość przez wsparcie ' . site_name() . '.','lbl_date'=>'Otrzymano','btn'=>'Odpowiedz klientowi','closing'=>'Z poważaniem,','team'=>'Zespół ' . site_name()],
    'bg' => ['title'=>'Ново съобщение за поддръжка','sub'=>'Поддръжка ' . site_name(),'intro'=>'ви изпрати съобщение чрез поддръжката на ' . site_name() . '.','lbl_date'=>'Получено на','btn'=>'Отговори на клиента','closing'=>'С уважение,','team'=>'Екипът на ' . site_name()],
    'hu' => ['title'=>'Új ügyfélszolgálati üzenet','sub'=>site_name() . ' ügyfélszolgálat','intro'=>'üzenetet küldött Önnek a ' . site_name() . ' ügyfélszolgálaton keresztül.','lbl_date'=>'Beérkezett','btn'=>'Válasz az ügyfélnek','closing'=>'Tisztelettel,','team'=>'A ' . site_name() . ' csapata'],
    'it' => ['title'=>'Nuovo messaggio di assistenza','sub'=>'Assistenza ' . site_name(),'intro'=>'ti ha inviato un messaggio tramite l\'assistenza ' . site_name() . '.','lbl_date'=>'Ricevuto il','btn'=>'Rispondi al cliente','closing'=>'Cordiali saluti,','team'=>'Il team ' . site_name()],
    'de' => ['title'=>'Neue Support-Nachricht','sub'=>site_name() . ' Support','intro'=>'hat Ihnen über den ' . site_name() . ' Support eine Nachricht gesendet.','lbl_date'=>'Empfangen am','btn'=>'Kunde antworten','closing'=>'Mit freundlichen Grüßen,','team'=>'Das ' . site_name() . '-Team'],
    'lt' => ['title'=>'Naujas pagalbos pranešimas','sub'=>site_name() . ' pagalba','intro'=>'jums atsiuntė žinutę per ' . site_name() . ' pagalbos tarnybą.','lbl_date'=>'Gauta','btn'=>'Atsakyti klientui','closing'=>'Pagarbiai,','team'=>site_name() . ' komanda'],
    'ro' => ['title'=>'Mesaj nou de suport','sub'=>'Suport ' . site_name(),'intro'=>'v-a trimis un mesaj prin suportul ' . site_name() . '.','lbl_date'=>'Primit la','btn'=>'Răspunde clientului','closing'=>'Cu stimă,','team'=>'Echipa ' . site_name()],
    'lv' => ['title'=>'Jauns atbalsta ziņojums','sub'=>site_name() . ' atbalsts','intro'=>'jums nosūtīja ziņojumu, izmantojot ' . site_name() . ' atbalstu.','lbl_date'=>'Saņemts','btn'=>'Atbildēt klientam','closing'=>'Ar cieņu,','team'=>site_name() . ' komanda'],
    'nl' => ['title'=>'Nieuw supportbericht','sub'=>site_name() . ' Support','intro'=>'heeft u een bericht gestuurd via de ' . site_name() . '-support.','lbl_date'=>'Ontvangen op','btn'=>'Klant beantwoorden','closing'=>'Met vriendelijke groet,','team'=>'Het team van ' . site_name()],
    'pt' => ['title'=>'Nova mensagem de suporte','sub'=>'Suporte ' . site_name(),'intro'=>'enviou-lhe uma mensagem através do suporte ' . site_name() . '.','lbl_date'=>'Recebido em','btn'=>'Responder ao cliente','closing'=>'Atenciosamente,','team'=>'A equipa ' . site_name()],
    'hr' => ['title'=>'Nova poruka podrške','sub'=>'Podrška ' . site_name(),'intro'=>'poslao/la vam je poruku putem podrške ' . site_name() . '.','lbl_date'=>'Primljeno dana','btn'=>'Odgovori klijentu','closing'=>'S poštovanjem,','team'=>'Tim ' . site_name()],
];
$t = $texts[$locale ?? 'fr'] ?? $texts['fr'];
@endphp
<x-email-layout
    :title="$t['title']"
    :subtitle="$t['sub']"
    accent="teal"
    :locale="$locale"
>

  <p class="greeting">
    <strong>{{ $client->name }}</strong> {{ $t['intro'] }}
  </p>

  <div class="panel">
    <div class="panel-row" style="flex-direction:column;align-items:flex-start;gap:4px">
      <span class="panel-val" style="text-align:left;font-weight:400">{{ $message->body }}</span>
    </div>
  </div>

  <div class="btn-wrap">
    <a href="{{ url('/admin/support/' . $client->id) }}" class="btn">{{ $t['btn'] }}</a>
  </div>

  <p class="body-text">{{ $t['lbl_date'] }} {{ $message->created_at->format('d/m/Y H:i') }}</p>

  <p class="closing">
    {{ $t['closing'] }}<br>
    <strong>{{ $t['team'] }}</strong>
  </p>

</x-email-layout>
