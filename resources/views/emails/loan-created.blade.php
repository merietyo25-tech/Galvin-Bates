@component('mail::message')

@php
$texts = [
    'fr' => [
        'greeting'     => 'Madame / Monsieur ' . $loan->name . ',',
        'intro'        => 'Nous avons bien enregistré votre dossier de financement auprès de **' . site_name() . '**. Vous trouverez ci-joint votre contrat de prêt ainsi que le tableau d\'amortissement détaillant vos remboursements.',
        'summary'      => 'RÉSUMÉ DE VOTRE FINANCEMENT',
        'ref'          => 'Référence dossier',
        'amount'       => 'Montant accordé',
        'duration'     => 'Durée',
        'months'       => 'mois',
        'monthly'      => 'Mensualité',
        'rate'         => 'Taux d\'intérêt',
        'fees'         => 'Frais administratifs',
        'start'        => 'Première échéance',
        'docs_title'   => 'DOCUMENTS JOINTS',
        'doc_contract' => '📄 **Contrat_{{ ref }}.pdf** — Votre contrat de prêt à lire attentivement',
        'doc_amort'    => '📊 **Tableau_Amortissement_{{ ref }}.pdf** — Échéancier mensuel complet',
        'next_title'   => 'PROCHAINES ÉTAPES',
        'next_1'       => '1. Lisez attentivement le contrat joint.',
        'next_2'       => '2. Signez-le et renvoyez-le à notre équipe par email.',
        'next_3'       => '3. Une fois reçu, les coordonnées bancaires vous seront communiquées pour le versement des fonds.',
        'closing'      => 'Nous restons à votre disposition pour toute question.',
        'team'         => 'L\'équipe ' . site_name(),
    ],
    'pl' => [
        'greeting'     => 'Szanowny/a ' . $loan->name . ',',
        'intro'        => 'Zarejestrowaliśmy Państwa wniosek o finansowanie w **' . site_name() . '**. W załączeniu przesyłamy umowę pożyczki oraz harmonogram spłat.',
        'summary'      => 'PODSUMOWANIE FINANSOWANIA',
        'ref'          => 'Numer referencyjny',
        'amount'       => 'Przyznana kwota',
        'duration'     => 'Okres',
        'months'       => 'miesięcy',
        'monthly'      => 'Miesięczna rata',
        'rate'         => 'Stopa procentowa',
        'fees'         => 'Opłaty administracyjne',
        'start'        => 'Pierwsza rata',
        'docs_title'   => 'ZAŁĄCZONE DOKUMENTY',
        'doc_contract' => '📄 **Umowa_{{ ref }}.pdf** — Umowa pożyczki do dokładnego przeczytania',
        'doc_amort'    => '📊 **Harmonogram_{{ ref }}.pdf** — Pełny miesięczny harmonogram spłat',
        'next_title'   => 'KOLEJNE KROKI',
        'next_1'       => '1. Prosimy o dokładne zapoznanie się z załączoną umową.',
        'next_2'       => '2. Proszę ją podpisać i odesłać do naszego zespołu.',
        'next_3'       => '3. Po otrzymaniu podpisanej umowy przekażemy dane bankowe do wypłaty środków.',
        'closing'      => 'Pozostajemy do Państwa dyspozycji w razie jakichkolwiek pytań.',
        'team'         => 'Zespół ' . site_name(),
    ],
    'en' => [
        'greeting'     => 'Dear ' . $loan->name . ',',
        'intro'        => 'Your financing file has been registered with **' . site_name() . '**. Please find attached your loan agreement and the amortization schedule detailing your monthly repayments.',
        'summary'      => 'YOUR FINANCING SUMMARY',
        'ref'          => 'File reference',
        'amount'       => 'Amount granted',
        'duration'     => 'Duration',
        'months'       => 'months',
        'monthly'      => 'Monthly payment',
        'rate'         => 'Interest rate',
        'fees'         => 'Administrative fees',
        'start'        => 'First payment date',
        'docs_title'   => 'ATTACHED DOCUMENTS',
        'doc_contract' => '📄 **Contract_{{ ref }}.pdf** — Your loan agreement, please read carefully',
        'doc_amort'    => '📊 **AmortizationSchedule_{{ ref }}.pdf** — Complete monthly payment schedule',
        'next_title'   => 'NEXT STEPS',
        'next_1'       => '1. Read the attached contract carefully.',
        'next_2'       => '2. Sign it and return it to our team by email.',
        'next_3'       => '3. Once received, our team will send you the bank details for fund transfer.',
        'closing'      => 'We remain at your disposal for any questions.',
        'team'         => 'The ' . site_name() . ' team',
    ],
    'es' => [
        'greeting'     => 'Estimado/a ' . $loan->name . ',',
        'intro'        => 'Hemos registrado su expediente de financiación en **' . site_name() . '**. Adjuntamos su contrato de préstamo y el cuadro de amortización con el detalle de sus pagos mensuales.',
        'summary'      => 'RESUMEN DE SU FINANCIAMIENTO',
        'ref'          => 'Referencia del expediente',
        'amount'       => 'Importe concedido',
        'duration'     => 'Duración',
        'months'       => 'meses',
        'monthly'      => 'Cuota mensual',
        'rate'         => 'Tipo de interés',
        'fees'         => 'Gastos administrativos',
        'start'        => 'Primera cuota',
        'docs_title'   => 'DOCUMENTOS ADJUNTOS',
        'doc_contract' => '📄 **Contrato_{{ ref }}.pdf** — Su contrato de préstamo, léalo detenidamente',
        'doc_amort'    => '📊 **CuadroAmortizacion_{{ ref }}.pdf** — Calendario mensual completo de pagos',
        'next_title'   => 'PRÓXIMOS PASOS',
        'next_1'       => '1. Lea detenidamente el contrato adjunto.',
        'next_2'       => '2. Fírmelo y envíelo a nuestro equipo por correo electrónico.',
        'next_3'       => '3. Una vez recibido, le comunicaremos los datos bancarios para la transferencia de fondos.',
        'closing'      => 'Quedamos a su disposición para cualquier consulta.',
        'team'         => 'El equipo ' . site_name(),
    ],
    'bg' => [
        'greeting'     => 'Уважаеми/а ' . $loan->name . ',',
        'intro'        => 'Успешно регистрирахме вашето досие за финансиране в **' . site_name() . '**. Ще намерите приложени вашия договор за заем, както и погасителния план, детайлизиращ вашите вноски.',
        'summary'      => 'ОБОБЩЕНИЕ НА ВАШЕТО ФИНАНСИРАНЕ',
        'ref'          => 'Референция на досието',
        'amount'       => 'Отпусната сума',
        'duration'     => 'Срок',
        'months'       => 'месеца',
        'monthly'      => 'Месечна вноска',
        'rate'         => 'Лихвен процент',
        'fees'         => 'Административни такси',
        'start'        => 'Първа вноска',
        'docs_title'   => 'ПРИЛОЖЕНИ ДОКУМЕНТИ',
        'doc_contract' => '📄 **Договор_{{ ref }}.pdf** — Вашият договор за заем за внимателно прочитане',
        'doc_amort'    => '📊 **Погасителен_план_{{ ref }}.pdf** — Пълен месечен погасителен план',
        'next_title'   => 'СЛЕДВАЩИ СТЪПКИ',
        'next_1'       => '1. Прочетете внимателно приложения договор.',
        'next_2'       => '2. Подпишете го и го изпратете обратно на нашия екип по имейл.',
        'next_3'       => '3. След получаването му ще ви изпратим банковите данни за превода на средствата.',
        'closing'      => 'Оставаме на разположение за всякакви въпроси.',
        'team'         => 'Екипът на ' . site_name(),
    ],
    'hu' => [
        'greeting'     => 'Tisztelt ' . $loan->name . '!',
        'intro'        => 'Finanszírozási ügyét sikeresen rögzítettük a **' . site_name() . '**-nál. Mellékelten megtalálja kölcsönszerződését, valamint a havi törlesztéseit részletező törlesztési ütemtervet.',
        'summary'      => 'FINANSZÍROZÁSÁNAK ÖSSZEFOGLALÓJA',
        'ref'          => 'Ügy referenciaszáma',
        'amount'       => 'Jóváhagyott összeg',
        'duration'     => 'Futamidő',
        'months'       => 'hónap',
        'monthly'      => 'Havi törlesztőrészlet',
        'rate'         => 'Kamatláb',
        'fees'         => 'Adminisztrációs díjak',
        'start'        => 'Első törlesztés dátuma',
        'docs_title'   => 'CSATOLT DOKUMENTUMOK',
        'doc_contract' => '📄 **Szerzodes_{{ ref }}.pdf** — Kölcsönszerződése, kérjük, figyelmesen olvassa el',
        'doc_amort'    => '📊 **Torlesztesi_utemterv_{{ ref }}.pdf** — Teljes havi törlesztési ütemterv',
        'next_title'   => 'KÖVETKEZŐ LÉPÉSEK',
        'next_1'       => '1. Olvassa el figyelmesen a mellékelt szerződést.',
        'next_2'       => '2. Írja alá, és küldje vissza csapatunknak e-mailben.',
        'next_3'       => '3. A kézhezvétel után csapatunk elküldi Önnek a banki adatokat az összeg átutalásához.',
        'closing'      => 'Bármilyen kérdés esetén állunk rendelkezésére.',
        'team'         => 'A ' . site_name() . ' csapata',
    ],
    'it' => [
        'greeting'     => 'Gentile ' . $loan->name . ',',
        'intro'        => 'Abbiamo registrato con successo la tua pratica di finanziamento presso **' . site_name() . '**. In allegato trovi il tuo contratto di prestito e il piano di ammortamento con il dettaglio dei tuoi rimborsi mensili.',
        'summary'      => 'RIEPILOGO DEL TUO FINANZIAMENTO',
        'ref'          => 'Riferimento pratica',
        'amount'       => 'Importo concesso',
        'duration'     => 'Durata',
        'months'       => 'mesi',
        'monthly'      => 'Rata mensile',
        'rate'         => 'Tasso d\'interesse',
        'fees'         => 'Spese amministrative',
        'start'        => 'Data della prima rata',
        'docs_title'   => 'DOCUMENTI ALLEGATI',
        'doc_contract' => '📄 **Contratto_{{ ref }}.pdf** — Il tuo contratto di prestito, da leggere attentamente',
        'doc_amort'    => '📊 **PianoAmmortamento_{{ ref }}.pdf** — Piano mensile completo dei rimborsi',
        'next_title'   => 'PROSSIMI PASSI',
        'next_1'       => '1. Leggi attentamente il contratto allegato.',
        'next_2'       => '2. Firmalo e restituiscilo al nostro team via email.',
        'next_3'       => '3. Una volta ricevuto, il nostro team ti invierà i dati bancari per il bonifico dei fondi.',
        'closing'      => 'Restiamo a tua disposizione per qualsiasi domanda.',
        'team'         => 'Il team ' . site_name(),
    ],
    'de' => [
        'greeting'     => 'Sehr geehrte Damen und Herren ' . $loan->name . ',',
        'intro'        => 'Wir haben Ihre Finanzierungsakte bei **' . site_name() . '** erfasst. Anbei finden Sie Ihren Kreditvertrag sowie den Tilgungsplan mit den Einzelheiten zu Ihren Rückzahlungen.',
        'summary'      => 'ZUSAMMENFASSUNG IHRER FINANZIERUNG',
        'ref'          => 'Aktenreferenz',
        'amount'       => 'Genehmigter Betrag',
        'duration'     => 'Laufzeit',
        'months'       => 'Monate',
        'monthly'      => 'Monatliche Rate',
        'rate'         => 'Zinssatz',
        'fees'         => 'Verwaltungsgebühren',
        'start'        => 'Erste Fälligkeit',
        'docs_title'   => 'ANHÄNGE',
        'doc_contract' => '📄 **Vertrag_{{ ref }}.pdf** — Ihr Kreditvertrag, bitte aufmerksam lesen',
        'doc_amort'    => '📊 **Tilgungsplan_{{ ref }}.pdf** — Vollständiger monatlicher Tilgungsplan',
        'next_title'   => 'NÄCHSTE SCHRITTE',
        'next_1'       => '1. Lesen Sie den beigefügten Vertrag aufmerksam durch.',
        'next_2'       => '2. Unterschreiben Sie ihn und senden Sie ihn per E-Mail an unser Team zurück.',
        'next_3'       => '3. Nach Erhalt teilen wir Ihnen die Bankverbindung für die Auszahlung mit.',
        'closing'      => 'Wir stehen Ihnen für Fragen jederzeit zur Verfügung.',
        'team'         => 'Das ' . site_name() . '-Team',
    ],
    'lt' => [
        'greeting'     => 'Gerbiamas (-a) ' . $loan->name . ',',
        'intro'        => 'Jūsų finansavimo byla sėkmingai užregistruota **' . site_name() . '**. Pridedame jūsų paskolos sutartį bei mokėjimų grafiką, kuriame nurodyti jūsų mėnesiniai mokėjimai.',
        'summary'      => 'JŪSŲ FINANSAVIMO SANTRAUKA',
        'ref'          => 'Bylos numeris',
        'amount'       => 'Patvirtinta suma',
        'duration'     => 'Trukmė',
        'months'       => 'mėn.',
        'monthly'      => 'Mėnesinė įmoka',
        'rate'         => 'Palūkanų norma',
        'fees'         => 'Administraciniai mokesčiai',
        'start'        => 'Pirmoji įmoka',
        'docs_title'   => 'PRIDEDAMI DOKUMENTAI',
        'doc_contract' => '📄 **Sutartis_{{ ref }}.pdf** — Jūsų paskolos sutartis, prašome atidžiai perskaityti',
        'doc_amort'    => '📊 **Mokejimu_grafikas_{{ ref }}.pdf** — Pilnas mėnesinis mokėjimų grafikas',
        'next_title'   => 'KITI ŽINGSNIAI',
        'next_1'       => '1. Atidžiai perskaitykite pridedamą sutartį.',
        'next_2'       => '2. Pasirašykite ją ir grąžinkite mūsų komandai el. paštu.',
        'next_3'       => '3. Gavus sutartį, jums bus atsiųsti banko duomenys lėšų pervedimui.',
        'closing'      => 'Esame pasirengę atsakyti į bet kokius jūsų klausimus.',
        'team'         => site_name() . ' komanda',
    ],
    'ro' => [
        'greeting'     => 'Stimate/Stimată ' . $loan->name . ',',
        'intro'        => 'Am înregistrat cu succes dosarul dumneavoastră de finanțare la **' . site_name() . '**. Veți găsi atașat contractul de împrumut, precum și graficul de rambursare cu detalierea plăților dumneavoastră.',
        'summary'      => 'REZUMATUL FINANȚĂRII DUMNEAVOASTRĂ',
        'ref'          => 'Referință dosar',
        'amount'       => 'Sumă acordată',
        'duration'     => 'Durată',
        'months'       => 'luni',
        'monthly'      => 'Rată lunară',
        'rate'         => 'Rată a dobânzii',
        'fees'         => 'Taxe administrative',
        'start'        => 'Prima scadență',
        'docs_title'   => 'DOCUMENTE ATAȘATE',
        'doc_contract' => '📄 **Contract_{{ ref }}.pdf** — Contractul dumneavoastră de împrumut, vă rugăm să îl citiți cu atenție',
        'doc_amort'    => '📊 **Grafic_Rambursare_{{ ref }}.pdf** — Grafic lunar complet de rambursare',
        'next_title'   => 'PAȘII URMĂTORI',
        'next_1'       => '1. Citiți cu atenție contractul atașat.',
        'next_2'       => '2. Semnați-l și trimiteți-l înapoi echipei noastre prin e-mail.',
        'next_3'       => '3. După primire, vă vom comunica datele bancare pentru virarea fondurilor.',
        'closing'      => 'Rămânem la dispoziția dumneavoastră pentru orice întrebare.',
        'team'         => 'Echipa ' . site_name(),
    ],
    'lv' => [
        'greeting'     => 'Godātais/Godātā ' . $loan->name . ',',
        'intro'        => 'Mēs esam veiksmīgi reģistrējuši jūsu finansējuma lietu **' . site_name() . '**. Pielikumā atradīsiet savu aizdevuma līgumu, kā arī atmaksas grafiku ar jūsu ikmēneša maksājumu detaļām.',
        'summary'      => 'JŪSU FINANSĒJUMA KOPSAVILKUMS',
        'ref'          => 'Lietas atsauce',
        'amount'       => 'Piešķirtā summa',
        'duration'     => 'Termiņš',
        'months'       => 'mēneši',
        'monthly'      => 'Ikmēneša maksājums',
        'rate'         => 'Procentu likme',
        'fees'         => 'Administratīvās izmaksas',
        'start'        => 'Pirmais maksājuma termiņš',
        'docs_title'   => 'PIEVIENOTIE DOKUMENTI',
        'doc_contract' => '📄 **Ligums_{{ ref }}.pdf** — Jūsu aizdevuma līgums, lūdzu, izlasiet to uzmanīgi',
        'doc_amort'    => '📊 **Atmaksas_grafiks_{{ ref }}.pdf** — Pilns ikmēneša atmaksas grafiks',
        'next_title'   => 'NĀKAMIE SOĻI',
        'next_1'       => '1. Uzmanīgi izlasiet pievienoto līgumu.',
        'next_2'       => '2. Parakstiet to un nosūtiet atpakaļ mūsu komandai pa e-pastu.',
        'next_3'       => '3. Pēc saņemšanas mēs jums nosūtīsim bankas rekvizītus līdzekļu pārskaitīšanai.',
        'closing'      => 'Esam jūsu rīcībā, ja rodas kādi jautājumi.',
        'team'         => site_name() . ' komanda',
    ],
    'nl' => [
        'greeting'     => 'Geachte heer/mevrouw ' . $loan->name . ',',
        'intro'        => 'Wij hebben uw financieringsdossier bij **' . site_name() . '** succesvol geregistreerd. Bijgevoegd vindt u uw leningsovereenkomst en het aflossingsschema met de details van uw maandelijkse terugbetalingen.',
        'summary'      => 'SAMENVATTING VAN UW FINANCIERING',
        'ref'          => 'Dossierreferentie',
        'amount'       => 'Toegekend bedrag',
        'duration'     => 'Looptijd',
        'months'       => 'maanden',
        'monthly'      => 'Maandelijkse aflossing',
        'rate'         => 'Rentevoet',
        'fees'         => 'Administratiekosten',
        'start'        => 'Eerste vervaldatum',
        'docs_title'   => 'BIJGEVOEGDE DOCUMENTEN',
        'doc_contract' => '📄 **Contract_{{ ref }}.pdf** — Uw leningsovereenkomst, aandachtig te lezen',
        'doc_amort'    => '📊 **Aflossingsschema_{{ ref }}.pdf** — Volledig maandelijks aflossingsschema',
        'next_title'   => 'VOLGENDE STAPPEN',
        'next_1'       => '1. Lees het bijgevoegde contract aandachtig door.',
        'next_2'       => '2. Onderteken het en stuur het per e-mail terug naar ons team.',
        'next_3'       => '3. Zodra wij het ontvangen hebben, ontvangt u de bankgegevens voor de uitbetaling van de fondsen.',
        'closing'      => 'Wij staan u graag ter beschikking voor al uw vragen.',
        'team'         => 'Het ' . site_name() . ' Team',
    ],
];
$t   = $texts[$locale] ?? $texts['fr'];
$ref = $loan->reference;
@endphp

# {{ $t['greeting'] }}

{{ $t['intro'] }}

---

**{{ $t['summary'] }}**

| | |
|---|---|
| **{{ $t['ref'] }}** | {{ $loan->reference }} |
| **{{ $t['amount'] }}** | {{ number_format($loan->amount, 2, ',', ' ') }} {{ $loan->currency }} |
| **{{ $t['duration'] }}** | {{ $loan->darly }} {{ $t['months'] }} |
| **{{ $t['monthly'] }}** | {{ number_format($loan->monthly_payment, 2, ',', ' ') }} {{ $loan->currency }} |
| **{{ $t['rate'] }}** | {{ $loan->interest_rate }} % |
@if($loan->admin_fees)
| **{{ $t['fees'] }}** | {{ number_format($loan->admin_fees, 2, ',', ' ') }} {{ $loan->currency }} |
@endif
@if($loan->start_date)
| **{{ $t['start'] }}** | {{ $loan->start_date->format('d/m/Y') }} |
@endif

---

**{{ $t['docs_title'] }}**

{!! str_replace('{{ ref }}', $ref, $t['doc_contract']) !!}

{!! str_replace('{{ ref }}', $ref, $t['doc_amort']) !!}

---

> **{{ $t['next_title'] }}**
>
> {{ $t['next_1'] }}
>
> {{ $t['next_2'] }}
>
> {{ $t['next_3'] }}

{{ $t['closing'] }}

**{{ $t['team'] }}**

@endcomponent
