@php
// Textes fixes de l'e-mail de notification, dans la langue du client
$texts = [
    'fr' => ['hello'=>'Bonjour','sub'=>'Votre espace client','amount'=>'Montant','date'=>'Date','credit'=>'Un dépôt a été effectué sur votre compte. Le montant est déjà disponible sur votre solde.','debit'=>'Un débit a été enregistré sur votre compte.','note'=>'Motif','btn'=>'Ouvrir mon espace client','closing'=>'Cordialement,','team'=>"L'équipe " . site_name()],
    'en' => ['hello'=>'Hello','sub'=>'Your client space','amount'=>'Amount','date'=>'Date','credit'=>'A deposit has been made to your account. The amount is already available in your balance.','debit'=>'A debit has been recorded on your account.','note'=>'Reason','btn'=>'Open my client space','closing'=>'Best regards,','team'=>'The ' . site_name() . ' team'],
    'es' => ['hello'=>'Hola','sub'=>'Su espacio de cliente','amount'=>'Importe','date'=>'Fecha','credit'=>'Se ha realizado un depósito en su cuenta. El importe ya está disponible en su saldo.','debit'=>'Se ha registrado un cargo en su cuenta.','note'=>'Motivo','btn'=>'Abrir mi espacio de cliente','closing'=>'Atentamente,','team'=>'El equipo ' . site_name()],
    'pl' => ['hello'=>'Dzień dobry','sub'=>'Twój obszar klienta','amount'=>'Kwota','date'=>'Data','credit'=>'Na Twoje konto wpłynęła wpłata. Kwota jest już dostępna na Twoim saldzie.','debit'=>'Na Twoim koncie zarejestrowano obciążenie.','note'=>'Tytuł','btn'=>'Otwórz mój obszar klienta','closing'=>'Z poważaniem,','team'=>'Zespół ' . site_name()],
    'bg' => ['hello'=>'Здравейте','sub'=>'Вашето клиентско пространство','amount'=>'Сума','date'=>'Дата','credit'=>'По вашата сметка беше направен депозит. Сумата вече е налична във вашия баланс.','debit'=>'По вашата сметка беше регистрирано дебитиране.','note'=>'Основание','btn'=>'Отвори клиентското ми пространство','closing'=>'С уважение,','team'=>'Екипът на ' . site_name()],
    'hu' => ['hello'=>'Jó napot','sub'=>'Ügyfélfiókja','amount'=>'Összeg','date'=>'Dátum','credit'=>'Befizetés érkezett a számlájára. Az összeg már elérhető az egyenlegén.','debit'=>'Terhelést könyveltünk a számláján.','note'=>'Közlemény','btn'=>'Ügyfélfiókom megnyitása','closing'=>'Tisztelettel,','team'=>'A ' . site_name() . ' csapata'],
    'it' => ['hello'=>'Buongiorno','sub'=>'Il tuo spazio cliente','amount'=>'Importo','date'=>'Data','credit'=>'È stato effettuato un deposito sul tuo conto. L\'importo è già disponibile sul tuo saldo.','debit'=>'È stato registrato un addebito sul tuo conto.','note'=>'Causale','btn'=>'Apri il mio spazio cliente','closing'=>'Cordiali saluti,','team'=>'Il team ' . site_name()],
    'de' => ['hello'=>'Guten Tag','sub'=>'Ihr Kundenbereich','amount'=>'Betrag','date'=>'Datum','credit'=>'Auf Ihr Konto wurde eine Einzahlung vorgenommen. Der Betrag steht Ihnen bereits zur Verfügung.','debit'=>'Auf Ihrem Konto wurde eine Belastung verbucht.','note'=>'Verwendungszweck','btn'=>'Meinen Kundenbereich öffnen','closing'=>'Mit freundlichen Grüßen,','team'=>'Das ' . site_name() . '-Team'],
    'lt' => ['hello'=>'Laba diena','sub'=>'Jūsų kliento sritis','amount'=>'Suma','date'=>'Data','credit'=>'Į jūsų sąskaitą įnešta įmoka. Suma jau prieinama jūsų likutyje.','debit'=>'Jūsų sąskaitoje užregistruotas nurašymas.','note'=>'Paskirtis','btn'=>'Atidaryti mano kliento sritį','closing'=>'Pagarbiai,','team'=>site_name() . ' komanda'],
    'ro' => ['hello'=>'Bună ziua','sub'=>'Spațiul dumneavoastră de client','amount'=>'Sumă','date'=>'Data','credit'=>'A fost efectuat un depozit în contul dumneavoastră. Suma este deja disponibilă în sold.','debit'=>'A fost înregistrat un debit în contul dumneavoastră.','note'=>'Motiv','btn'=>'Deschide spațiul meu de client','closing'=>'Cu stimă,','team'=>'Echipa ' . site_name()],
    'lv' => ['hello'=>'Labdien','sub'=>'Jūsu klienta zona','amount'=>'Summa','date'=>'Datums','credit'=>'Jūsu kontā ir veikta iemaksa. Summa jau ir pieejama jūsu atlikumā.','debit'=>'Jūsu kontā ir reģistrēts norakstījums.','note'=>'Mērķis','btn'=>'Atvērt manu klienta zonu','closing'=>'Ar cieņu,','team'=>site_name() . ' komanda'],
    'nl' => ['hello'=>'Goedendag','sub'=>'Uw klantomgeving','amount'=>'Bedrag','date'=>'Datum','credit'=>'Er is een storting op uw rekening gedaan. Het bedrag is al beschikbaar in uw saldo.','debit'=>'Er is een afschrijving op uw rekening geboekt.','note'=>'Omschrijving','btn'=>'Mijn klantomgeving openen','closing'=>'Met vriendelijke groet,','team'=>'Het team van ' . site_name()],
    'pt' => ['hello'=>'Olá','sub'=>'O seu espaço de cliente','amount'=>'Montante','date'=>'Data','credit'=>'Foi efetuado um depósito na sua conta. O montante já está disponível no seu saldo.','debit'=>'Foi registado um débito na sua conta.','note'=>'Motivo','btn'=>'Abrir o meu espaço de cliente','closing'=>'Atenciosamente,','team'=>'A equipa ' . site_name()],
    'hr' => ['hello'=>'Dobar dan','sub'=>'Vaš klijentski prostor','amount'=>'Iznos','date'=>'Datum','credit'=>'Na Vaš račun izvršena je uplata. Iznos je već dostupan na Vašem stanju.','debit'=>'Na Vašem računu evidentirano je terećenje.','note'=>'Opis','btn'=>'Otvori moj klijentski prostor','closing'=>'S poštovanjem,','team'=>'Tim ' . site_name()],
    'ca' => ['hello'=>'Hola','sub'=>'El vostre espai de client','amount'=>'Import','date'=>'Data','credit'=>'S\'ha fet un ingrés al vostre compte. L\'import ja està disponible al vostre saldo.','debit'=>'S\'ha registrat un càrrec al vostre compte.','note'=>'Concepte','btn'=>'Obrir el meu espai de client','closing'=>'Atentament,','team'=>"L'equip de " . site_name()],
    'sk' => ['hello'=>'Dobrý deň','sub'=>'Váš klientsky priestor','amount'=>'Suma','date'=>'Dátum','credit'=>'Na váš účet bol pripísaný vklad. Suma je už k dispozícii na vašom zostatku.','debit'=>'Na vašom účte bolo zaznamenané odpísanie.','note'=>'Účel','btn'=>'Otvoriť môj klientsky priestor','closing'=>'S pozdravom,','team'=>'Tím ' . site_name()],
    'sl' => ['hello'=>'Pozdravljeni','sub'=>'Vaš odjemalski prostor','amount'=>'Znesek','date'=>'Datum','credit'=>'Na vaš račun je bil izveden polog. Znesek je že na voljo v vašem stanju.','debit'=>'Na vašem računu je bila evidentirana bremenitev.','note'=>'Namen','btn'=>'Odpri moj odjemalski prostor','closing'=>'Lep pozdrav,','team'=>'Ekipa ' . site_name()],
    'mt' => ['hello'=>'Bonġu','sub'=>'L-ispazju tiegħek bħala klijent','amount'=>'Ammont','date'=>'Data','credit'=>'Sar depożitu fil-kont tiegħek. L-ammont diġà disponibbli fil-bilanċ tiegħek.','debit'=>'Ġie rreġistrat debitu fil-kont tiegħek.','note'=>'Raġuni','btn'=>'Iftaħ l-ispazju tiegħi','closing'=>'Bir-rispett,','team'=>'It-tim ta’ ' . site_name()],
];
$t = $texts[$locale] ?? $texts['en'];

// Couleur selon le type : vert pour un dépôt, orange pour un débit, bleu sinon
$accent = match ($type) { 'credit' => 'green', 'debit' => 'orange', default => 'teal' };
@endphp
<x-email-layout
    :title="$title"
    :subtitle="$t['sub']"
    :accent="$accent"
    :locale="$locale"
>

  <p class="greeting">{{ $t['hello'] }} {{ $client->name }},</p>

  @if($type === 'credit' || $type === 'debit')
  <p class="body-text">{{ $t[$type] }}</p>
  @if($note)<p class="body-text"><strong>{{ $t['note'] }} :</strong> {{ $note }}</p>@endif
  @else
  <p class="body-text">{{ $body }}</p>
  @endif

  @if($amount !== null)
  <div class="panel">
    <div class="panel-row">
      <span class="panel-lbl">{{ $t['amount'] }}</span>
      <span class="panel-val accent">{{ number_format($amount, 2, ',', ' ') }} {{ $currency }}</span>
    </div>
    <div class="panel-row">
      <span class="panel-lbl">{{ $t['date'] }}</span>
      <span class="panel-val">{{ now()->format('d/m/Y H:i') }}</span>
    </div>
  </div>
  @endif

  <div class="btn-wrap">
    <a href="{{ route('client.app.notifications') }}" class="btn">{{ $t['btn'] }}</a>
  </div>

  <p class="closing">
    {{ $t['closing'] }}<br>
    <strong>{{ $t['team'] }}</strong>
  </p>

</x-email-layout>
