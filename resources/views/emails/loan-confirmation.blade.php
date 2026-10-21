@php
$texts = [
    'fr' => [
        'title'      => 'Demande de prêt reçue',
        'sub'        => site_name(),
        'greeting'   => 'Bonjour '.$data['name'].',',
        'body'       => 'Nous avons bien reçu votre demande de prêt d\'un montant de <strong>'.number_format($data['amount'], 0, ',', ' ').' '.($data['currency'] ?? 'EUR').'</strong> sur <strong>'.$data['darly'].' mois</strong>. Elle est actuellement en cours de traitement par notre équipe.',
        'cond_title' => 'Conditions d\'éligibilité',
        'cond_body'  => 'Pour obtenir un prêt, il faut avoir au moins 18 ans, percevoir un revenu mensuel stable et pouvoir rembourser selon les conditions fixées.',
        'btn_intro'  => 'Pour finaliser votre dossier, veuillez cliquer sur le bouton ci-dessous afin de nous transmettre votre adresse complète et une copie de votre pièce d\'identité.',
        'btn_label'  => 'Compléter ma demande',
        'footer'     => 'Nous vous contacterons dans les plus brefs délais. Merci de nous avoir fait confiance.',
        'noreply'    => 'Cet email a été envoyé depuis une adresse no-reply. Veuillez ne pas répondre directement.',
        'closing'    => 'Cordialement,',
        'team'       => 'L\'équipe ' . site_name(),
    ],
    'en' => [
        'title'      => 'Loan application received',
        'sub'        => site_name(),
        'greeting'   => 'Hello '.$data['name'].',',
        'body'       => 'We have received your loan request for <strong>'.number_format($data['amount'], 0, ',', ' ').' '.($data['currency'] ?? 'EUR').'</strong> over <strong>'.$data['darly'].' months</strong>. It is currently being processed by our team.',
        'cond_title' => 'Eligibility conditions',
        'cond_body'  => 'To obtain a loan, you must be at least 18 years old, have a stable monthly income, and be able to repay according to the set conditions.',
        'btn_intro'  => 'To finalise your application, please click the button below to send us your full address and a copy of your ID.',
        'btn_label'  => 'Complete my application',
        'footer'     => 'We will contact you as soon as possible. Thank you for trusting us.',
        'noreply'    => 'This email was sent from a no-reply address. Please do not reply directly.',
        'closing'    => 'Best regards,',
        'team'       => 'The ' . site_name() . ' team',
    ],
    'es' => [
        'title'      => 'Solicitud de préstamo recibida',
        'sub'        => site_name(),
        'greeting'   => 'Hola '.$data['name'].',',
        'body'       => 'Hemos recibido su solicitud de préstamo por <strong>'.number_format($data['amount'], 0, ',', ' ').' '.($data['currency'] ?? 'EUR').'</strong> a <strong>'.$data['darly'].' meses</strong>. Actualmente está siendo procesada por nuestro equipo.',
        'cond_title' => 'Condiciones de elegibilidad',
        'cond_body'  => 'Para obtener un préstamo, debe tener al menos 18 años, percibir ingresos mensuales estables y poder reembolsar según las condiciones establecidas.',
        'btn_intro'  => 'Para finalizar su solicitud, haga clic en el botón para enviarnos su dirección completa y una copia de su documento de identidad.',
        'btn_label'  => 'Completar mi solicitud',
        'footer'     => 'Nos pondremos en contacto con usted lo antes posible. Gracias por su confianza.',
        'noreply'    => 'Este email fue enviado desde una dirección de no respuesta. No responda directamente.',
        'closing'    => 'Atentamente,',
        'team'       => 'El equipo ' . site_name(),
    ],
    'pl' => [
        'title'      => 'Wniosek o pożyczkę otrzymany',
        'sub'        => site_name(),
        'greeting'   => 'Witaj '.$data['name'].',',
        'body'       => 'Otrzymaliśmy Twój wniosek o pożyczkę na kwotę <strong>'.number_format($data['amount'], 0, ',', ' ').' '.($data['currency'] ?? 'EUR').'</strong> na <strong>'.$data['darly'].' miesięcy</strong>. Jest on aktualnie przetwarzany przez nasz zespół.',
        'cond_title' => 'Warunki kwalifikowalności',
        'cond_body'  => 'Aby uzyskać pożyczkę, należy mieć co najmniej 18 lat, osiągać stałe miesięczne dochody i móc spłacać zgodnie z ustalonymi warunkami.',
        'btn_intro'  => 'Aby sfinalizować wniosek, kliknij poniższy przycisk, aby przesłać swój pełny adres i kopię dokumentu tożsamości.',
        'btn_label'  => 'Uzupełnij mój wniosek',
        'footer'     => 'Skontaktujemy się z Tobą jak najszybciej. Dziękujemy za zaufanie.',
        'noreply'    => 'Ten email został wysłany z adresu no-reply. Prosimy nie odpowiadać bezpośrednio.',
        'closing'    => 'Z poważaniem,',
        'team'       => 'Zespół ' . site_name(),
    ],
    'bg' => [
        'title'      => 'Заявка за заем получена',
        'sub'        => site_name(),
        'greeting'   => 'Здравейте '.$data['name'].',',
        'body'       => 'Получихме вашата заявка за заем в размер на <strong>'.number_format($data['amount'], 0, ',', ' ').' '.($data['currency'] ?? 'EUR').'</strong> за срок от <strong>'.$data['darly'].' месеца</strong>. В момента тя се обработва от нашия екип.',
        'cond_title' => 'Условия за допустимост',
        'cond_body'  => 'За да получите заем, трябва да сте на поне 18 години, да получавате стабилен месечен доход и да можете да изплащате според определените условия.',
        'btn_intro'  => 'За да финализирате досието си, моля натиснете бутона по-долу, за да ни предоставите пълния си адрес и копие от документ за самоличност.',
        'btn_label'  => 'Завърши заявката ми',
        'footer'     => 'Ще се свържем с вас възможно най-скоро. Благодарим ви за доверието.',
        'noreply'    => 'Този имейл беше изпратен от адрес без отговор (no-reply). Моля, не отговаряйте директно.',
        'closing'    => 'С уважение,',
        'team'       => 'Екипът на ' . site_name(),
    ],
    'hu' => [
        'title'      => 'Kölcsönkérelem beérkezett',
        'sub'        => site_name(),
        'greeting'   => 'Üdvözöljük '.$data['name'].',',
        'body'       => 'Megkaptuk <strong>'.number_format($data['amount'], 0, ',', ' ').' '.($data['currency'] ?? 'EUR').'</strong> összegű, <strong>'.$data['darly'].' hónapos</strong> futamidejű kölcsönkérelmét. Jelenleg csapatunk dolgozza fel.',
        'cond_title' => 'Jogosultsági feltételek',
        'cond_body'  => 'Kölcsön igényléséhez legalább 18 évesnek kell lennie, stabil havi jövedelemmel kell rendelkeznie, és képesnek kell lennie a meghatározott feltételek szerinti törlesztésre.',
        'btn_intro'  => 'Az ügye véglegesítéséhez kérjük, kattintson az alábbi gombra, hogy megadja teljes címét és személyazonosító okmányának másolatát.',
        'btn_label'  => 'Kérelmem befejezése',
        'footer'     => 'A lehető leghamarabb felvesszük Önnel a kapcsolatot. Köszönjük bizalmát.',
        'noreply'    => 'Ezt az e-mailt egy no-reply címről küldtük. Kérjük, ne válaszoljon közvetlenül.',
        'closing'    => 'Tisztelettel,',
        'team'       => 'A ' . site_name() . ' csapata',
    ],
    'it' => [
        'title'      => 'Richiesta di prestito ricevuta',
        'sub'        => site_name(),
        'greeting'   => 'Ciao '.$data['name'].',',
        'body'       => 'Abbiamo ricevuto la tua richiesta di prestito di <strong>'.number_format($data['amount'], 0, ',', ' ').' '.($data['currency'] ?? 'EUR').'</strong> su <strong>'.$data['darly'].' mesi</strong>. È attualmente in fase di elaborazione da parte del nostro team.',
        'cond_title' => 'Condizioni di ammissibilità',
        'cond_body'  => 'Per ottenere un prestito, è necessario avere almeno 18 anni, percepire un reddito mensile stabile e poter rimborsare secondo le condizioni stabilite.',
        'btn_intro'  => 'Per finalizzare la tua pratica, ti preghiamo di cliccare sul pulsante qui sotto per inviarci il tuo indirizzo completo e una copia del tuo documento d\'identità.',
        'btn_label'  => 'Completa la mia richiesta',
        'footer'     => 'Ti contatteremo il prima possibile. Grazie per la fiducia accordataci.',
        'noreply'    => 'Questa email è stata inviata da un indirizzo no-reply. Ti preghiamo di non rispondere direttamente.',
        'closing'    => 'Cordiali saluti,',
        'team'       => 'Il team ' . site_name(),
    ],
    'de' => [
        'title'      => 'Kreditanfrage eingegangen',
        'sub'        => site_name(),
        'greeting'   => 'Guten Tag '.$data['name'].',',
        'body'       => 'Wir haben Ihre Kreditanfrage über <strong>'.number_format($data['amount'], 0, ',', ' ').' '.($data['currency'] ?? 'EUR').'</strong> für eine Laufzeit von <strong>'.$data['darly'].' Monaten</strong> erhalten. Sie wird derzeit von unserem Team bearbeitet.',
        'cond_title' => 'Voraussetzungen',
        'cond_body'  => 'Um einen Kredit zu erhalten, müssen Sie mindestens 18 Jahre alt sein, über ein stabiles monatliches Einkommen verfügen und in der Lage sein, gemäß den festgelegten Bedingungen zurückzuzahlen.',
        'btn_intro'  => 'Um Ihren Antrag abzuschließen, klicken Sie bitte auf die Schaltfläche unten, um uns Ihre vollständige Adresse und eine Kopie Ihres Ausweisdokuments zu übermitteln.',
        'btn_label'  => 'Meine Anfrage vervollständigen',
        'footer'     => 'Wir werden uns so schnell wie möglich bei Ihnen melden. Vielen Dank für Ihr Vertrauen.',
        'noreply'    => 'Diese E-Mail wurde von einer no-reply-Adresse gesendet. Bitte antworten Sie nicht direkt auf diese Nachricht.',
        'closing'    => 'Mit freundlichen Grüßen,',
        'team'       => 'Das ' . site_name() . '-Team',
    ],
    'lt' => [
        'title'      => 'Paskolos paraiška gauta',
        'sub'        => site_name(),
        'greeting'   => 'Sveiki, '.$data['name'].',',
        'body'       => 'Gavome jūsų paskolos paraišką <strong>'.number_format($data['amount'], 0, ',', ' ').' '.($data['currency'] ?? 'EUR').'</strong> sumai <strong>'.$data['darly'].' mėnesių</strong> laikotarpiui. Šiuo metu ją nagrinėja mūsų komanda.',
        'cond_title' => 'Reikalavimai',
        'cond_body'  => 'Norint gauti paskolą, būtina būti bent 18 metų amžiaus, turėti stabilias mėnesines pajamas ir galėti grąžinti paskolą pagal nustatytas sąlygas.',
        'btn_intro'  => 'Norėdami užbaigti savo bylą, spustelėkite žemiau esantį mygtuką ir pateikite mums pilną adresą bei asmens tapatybės dokumento kopiją.',
        'btn_label'  => 'Užbaigti paraišką',
        'footer'     => 'Susisieksime su jumis kuo greičiau. Dėkojame, kad pasitikite mumis.',
        'noreply'    => 'Šis el. laiškas išsiųstas iš no-reply adreso. Prašome tiesiogiai neatsakyti į šį pranešimą.',
        'closing'    => 'Pagarbiai,',
        'team'       => site_name() . ' komanda',
    ],
    'ro' => [
        'title'      => 'Cerere de împrumut primită',
        'sub'        => site_name(),
        'greeting'   => 'Bună ziua, '.$data['name'].',',
        'body'       => 'Am primit cererea dumneavoastră de împrumut în valoare de <strong>'.number_format($data['amount'], 0, ',', ' ').' '.($data['currency'] ?? 'EUR').'</strong> pe o perioadă de <strong>'.$data['darly'].' luni</strong>. Aceasta este în prezent în curs de procesare de către echipa noastră.',
        'cond_title' => 'Condiții de eligibilitate',
        'cond_body'  => 'Pentru a obține un împrumut, trebuie să aveți cel puțin 18 ani, să realizați un venit lunar stabil și să puteți rambursa conform condițiilor stabilite.',
        'btn_intro'  => 'Pentru a finaliza dosarul dumneavoastră, vă rugăm să faceți clic pe butonul de mai jos pentru a ne transmite adresa dumneavoastră completă și o copie a actului de identitate.',
        'btn_label'  => 'Completează cererea mea',
        'footer'     => 'Vă vom contacta în cel mai scurt timp. Vă mulțumim pentru încrederea acordată.',
        'noreply'    => 'Acest e-mail a fost trimis de la o adresă no-reply. Vă rugăm să nu răspundeți direct la acest mesaj.',
        'closing'    => 'Cu stimă,',
        'team'       => 'Echipa ' . site_name(),
    ],
    'lv' => [
        'title'      => 'Aizdevuma pieteikums saņemts',
        'sub'        => site_name(),
        'greeting'   => 'Sveiki, '.$data['name'].',',
        'body'       => 'Mēs esam saņēmuši jūsu aizdevuma pieteikumu par summu <strong>'.number_format($data['amount'], 0, ',', ' ').' '.($data['currency'] ?? 'EUR').'</strong> uz <strong>'.$data['darly'].' mēnešiem</strong>. To pašlaik izskata mūsu komanda.',
        'cond_title' => 'Atbilstības nosacījumi',
        'cond_body'  => 'Lai saņemtu aizdevumu, jums jābūt vismaz 18 gadus vecam, jāsaņem stabili ikmēneša ienākumi un jāspēj atmaksāt aizdevumu saskaņā ar noteiktajiem nosacījumiem.',
        'btn_intro'  => 'Lai pabeigtu jūsu pieteikuma noformēšanu, lūdzu, noklikšķiniet uz zemāk esošās pogas, lai nosūtītu mums savu pilno adresi un personu apliecinoša dokumenta kopiju.',
        'btn_label'  => 'Papildināt manu pieteikumu',
        'footer'     => 'Mēs ar jums sazināsimies pēc iespējas ātrāk. Paldies par uzticēšanos.',
        'noreply'    => 'Šis e-pasts ir nosūtīts no adreses, uz kuru netiek pieņemtas atbildes. Lūdzu, neatbildiet tieši uz šo ziņojumu.',
        'closing'    => 'Ar cieņu,',
        'team'       => site_name() . ' komanda',
    ],
    'nl' => [
        'title'      => 'Leningaanvraag ontvangen',
        'sub'        => site_name(),
        'greeting'   => 'Hallo '.$data['name'].',',
        'body'       => 'Wij hebben uw leningaanvraag van <strong>'.number_format($data['amount'], 0, ',', ' ').' '.($data['currency'] ?? 'EUR').'</strong> over <strong>'.$data['darly'].' maanden</strong> in goede orde ontvangen. Deze wordt momenteel door ons team verwerkt.',
        'cond_title' => 'Toelatingsvoorwaarden',
        'cond_body'  => 'Om een lening te verkrijgen, moet u minstens 18 jaar oud zijn, over een stabiel maandinkomen beschikken en in staat zijn terug te betalen volgens de vastgestelde voorwaarden.',
        'btn_intro'  => 'Om uw dossier af te ronden, klikt u op onderstaande knop om ons uw volledige adres en een kopie van uw identiteitsbewijs te bezorgen.',
        'btn_label'  => 'Mijn aanvraag voltooien',
        'footer'     => 'Wij nemen zo spoedig mogelijk contact met u op. Bedankt voor uw vertrouwen.',
        'noreply'    => 'Deze e-mail is verzonden vanaf een no-reply-adres. Gelieve niet rechtstreeks te antwoorden.',
        'closing'    => 'Met vriendelijke groet,',
        'team'       => 'Het ' . site_name() . ' Team',
    ],
    'pt' => [
        'title'      => 'Pedido de empréstimo recebido',
        'sub'        => site_name(),
        'greeting'   => 'Olá '.$data['name'].',',
        'body'       => 'Recebemos o seu pedido de empréstimo no montante de <strong>'.number_format($data['amount'], 0, ',', ' ').' '.($data['currency'] ?? 'EUR').'</strong> em <strong>'.$data['darly'].' meses</strong>. Está atualmente a ser processado pela nossa equipa.',
        'cond_title' => 'Condições de elegibilidade',
        'cond_body'  => 'Para obter um empréstimo, é necessário ter pelo menos 18 anos, auferir um rendimento mensal estável e poder reembolsar de acordo com as condições estabelecidas.',
        'btn_intro'  => 'Para finalizar o seu processo, clique no botão abaixo para nos enviar a sua morada completa e uma cópia do seu documento de identificação.',
        'btn_label'  => 'Completar o meu pedido',
        'footer'     => 'Entraremos em contacto consigo o mais brevemente possível. Obrigado pela sua confiança.',
        'noreply'    => 'Este email foi enviado a partir de um endereço no-reply. Não responda diretamente.',
        'closing'    => 'Atenciosamente,',
        'team'       => 'A equipa ' . site_name(),
    ],
    'hr' => [
        'title'      => 'Zahtjev za kredit primljen',
        'sub'        => site_name(),
        'greeting'   => 'Pozdrav '.$data['name'].',',
        'body'       => 'Zaprimili smo vaš zahtjev za kredit u iznosu od <strong>'.number_format($data['amount'], 0, ',', ' ').' '.($data['currency'] ?? 'EUR').'</strong> na <strong>'.$data['darly'].' mjeseci</strong>. Trenutno ga obrađuje naš tim.',
        'cond_title' => 'Uvjeti prihvatljivosti',
        'cond_body'  => 'Za dobivanje kredita potrebno je imati najmanje 18 godina, stabilan mjesečni prihod i mogućnost otplate prema utvrđenim uvjetima.',
        'btn_intro'  => 'Za dovršetak vašeg zahtjeva kliknite na gumb ispod kako biste nam poslali svoju punu adresu i presliku osobne iskaznice.',
        'btn_label'  => 'Dovrši moj zahtjev',
        'footer'     => 'Kontaktirat ćemo vas u najkraćem mogućem roku. Hvala vam na povjerenju.',
        'noreply'    => 'Ova e-poruka poslana je s adrese na koju se ne odgovara (no-reply). Molimo ne odgovarajte izravno.',
        'closing'    => 'S poštovanjem,',
        'team'       => 'Tim ' . site_name(),
    ],
];
$t = $texts[$lang] ?? $texts['fr'];
@endphp

<x-email-layout
    :title="$t['title']"
    :subtitle="$t['sub']"
    accent="teal"
    :footerNote="$t['noreply']"
>

  <p class="greeting">{{ $t['greeting'] }}</p>

  <p class="body-text">{!! $t['body'] !!}</p>

  <div class="alert alert-info">
    <strong>{{ $t['cond_title'] }}</strong>
    <p>{{ $t['cond_body'] }}</p>
  </div>

  <p class="body-text">{{ $t['btn_intro'] }}</p>

  <div class="btn-wrap">
    <a href="{{ $data['complete_url'] }}" class="btn">{{ $t['btn_label'] }}</a>
  </div>

  <p class="body-text">{{ $t['footer'] }}</p>

  <p class="closing">
    {{ $t['closing'] }}<br>
    <strong>{{ $t['team'] }}</strong>
  </p>

</x-email-layout>
