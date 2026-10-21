@php
$portal = $portal ?? 'client';
$subs = [
    'fr' => ['client' => 'Espace Client Sécurisé', 'staff' => 'Espace Administrateur Sécurisé'],
    'en' => ['client' => 'Secure Client Area',      'staff' => 'Secure Administrator Area'],
    'es' => ['client' => 'Área de Cliente Segura',  'staff' => 'Área de Administrador Segura'],
    'pl' => ['client' => 'Bezpieczna Strefa Klienta','staff' => 'Bezpieczna Strefa Administratora'],
    'bg' => ['client' => 'Защитена Клиентска Зона', 'staff' => 'Защитена Администраторска Зона'],
    'hu' => ['client' => 'Biztonságos Ügyfélterület', 'staff' => 'Biztonságos Adminisztrátori Terület'],
    'it' => ['client' => 'Area Cliente Sicura',     'staff' => 'Area Amministratore Sicura'],
    'de' => ['client' => 'Sicherer Kundenbereich',  'staff' => 'Sicherer Administratorbereich'],
    'lt' => ['client' => 'Saugi Kliento Sritis',     'staff' => 'Saugi Administratoriaus Sritis'],
    'ro' => ['client' => 'Zonă Client Securizată',   'staff' => 'Zonă Administrator Securizată'],
    'lv' => ['client' => 'Droša Klienta Zona',       'staff' => 'Droša Administratora Zona'],
    'nl' => ['client' => 'Beveiligde Klantomgeving', 'staff' => 'Beveiligde Beheerdersomgeving'],
    'pt' => ['client' => 'Área de Cliente Segura',   'staff' => 'Área de Administrador Segura'],
    'hr' => ['client' => 'Sigurni klijentski prostor', 'staff' => 'Sigurni administratorski prostor'],
];
$texts = [
    'fr' => [
        'title'    => 'Réinitialisation du mot de passe',
        'greeting' => 'Bonjour ' . ($user->name ?? '') . ',',
        'intro'    => 'Vous avez demandé la réinitialisation de votre mot de passe. Cliquez sur le bouton ci-dessous pour en choisir un nouveau.',
        'button'   => 'Réinitialiser le mot de passe',
        'expiry'   => 'Ce lien expire dans ' . $expireMinutes . ' minutes.',
        'ignore'   => 'Si vous n\'êtes pas à l\'origine de cette demande, aucune action n\'est requise — votre mot de passe reste inchangé.',
        'fallback' => 'Si le bouton ne fonctionne pas, copiez ce lien dans votre navigateur :',
        'closing'  => 'Cordialement,',
        'team'     => 'L\'équipe ' . site_name(),
    ],
    'en' => [
        'title'    => 'Password reset',
        'greeting' => 'Hello ' . ($user->name ?? '') . ',',
        'intro'    => 'You requested a password reset. Click the button below to choose a new one.',
        'button'   => 'Reset password',
        'expiry'   => 'This link expires in ' . $expireMinutes . ' minutes.',
        'ignore'   => 'If you did not request this, no further action is required — your password remains unchanged.',
        'fallback' => 'If the button does not work, copy this link into your browser:',
        'closing'  => 'Kind regards,',
        'team'     => 'The ' . site_name() . ' team',
    ],
    'es' => [
        'title'    => 'Restablecimiento de contraseña',
        'greeting' => 'Hola ' . ($user->name ?? '') . ',',
        'intro'    => 'Ha solicitado restablecer su contraseña. Haga clic en el botón de abajo para elegir una nueva.',
        'button'   => 'Restablecer contraseña',
        'expiry'   => 'Este enlace caduca en ' . $expireMinutes . ' minutos.',
        'ignore'   => 'Si no ha sido usted quien lo solicitó, no es necesaria ninguna acción — su contraseña no cambiará.',
        'fallback' => 'Si el botón no funciona, copie este enlace en su navegador:',
        'closing'  => 'Atentamente,',
        'team'     => 'El equipo ' . site_name(),
    ],
    'pl' => [
        'title'    => 'Resetowanie hasła',
        'greeting' => 'Witaj ' . ($user->name ?? '') . ',',
        'intro'    => 'Poprosiłeś/aś o zresetowanie hasła. Kliknij poniższy przycisk, aby ustawić nowe.',
        'button'   => 'Zresetuj hasło',
        'expiry'   => 'Ten link wygasa za ' . $expireMinutes . ' minut.',
        'ignore'   => 'Jeśli to nie Ty złożyłeś/aś tę prośbę, nie musisz nic robić — Twoje hasło pozostanie bez zmian.',
        'fallback' => 'Jeśli przycisk nie działa, skopiuj ten link do przeglądarki:',
        'closing'  => 'Z poważaniem,',
        'team'     => 'Zespół ' . site_name(),
    ],
    'bg' => [
        'title'    => 'Нулиране на паролата',
        'greeting' => 'Здравейте ' . ($user->name ?? '') . ',',
        'intro'    => 'Заявихте нулиране на паролата си. Кликнете върху бутона по-долу, за да изберете нова.',
        'button'   => 'Нулиране на паролата',
        'expiry'   => 'Тази връзка изтича след ' . $expireMinutes . ' минути.',
        'ignore'   => 'Ако не сте вие направили тази заявка, не е необходимо действие — паролата ви остава непроменена.',
        'fallback' => 'Ако бутонът не работи, копирайте тази връзка в браузъра си:',
        'closing'  => 'С уважение,',
        'team'     => 'Екипът на ' . site_name(),
    ],
    'hu' => [
        'title'    => 'Jelszó visszaállítása',
        'greeting' => 'Üdvözöljük ' . ($user->name ?? '') . ',',
        'intro'    => 'Jelszava visszaállítását kérte. Kattintson az alábbi gombra egy új jelszó választásához.',
        'button'   => 'Jelszó visszaállítása',
        'expiry'   => 'Ez a hivatkozás ' . $expireMinutes . ' perc múlva lejár.',
        'ignore'   => 'Ha nem Ön kérte ezt, nincs szükség további teendőre — jelszava változatlan marad.',
        'fallback' => 'Ha a gomb nem működik, másolja be ezt a hivatkozást a böngészőjébe:',
        'closing'  => 'Tisztelettel,',
        'team'     => 'A ' . site_name() . ' csapata',
    ],
    'it' => [
        'title'    => 'Reimposta password',
        'greeting' => 'Ciao ' . ($user->name ?? '') . ',',
        'intro'    => 'Hai richiesto di reimpostare la tua password. Clicca sul pulsante qui sotto per sceglierne una nuova.',
        'button'   => 'Reimposta password',
        'expiry'   => 'Questo link scade tra ' . $expireMinutes . ' minuti.',
        'ignore'   => 'Se non hai effettuato tu questa richiesta, non è necessaria alcuna azione — la tua password rimane invariata.',
        'fallback' => 'Se il pulsante non funziona, copia questo link nel tuo browser:',
        'closing'  => 'Cordiali saluti,',
        'team'     => 'Il team ' . site_name(),
    ],
    'de' => [
        'title'    => 'Passwort zurücksetzen',
        'greeting' => 'Guten Tag ' . ($user->name ?? '') . ',',
        'intro'    => 'Sie haben eine Zurücksetzung Ihres Passworts angefordert. Klicken Sie auf die Schaltfläche unten, um ein neues zu wählen.',
        'button'   => 'Passwort zurücksetzen',
        'expiry'   => 'Dieser Link läuft in ' . $expireMinutes . ' Minuten ab.',
        'ignore'   => 'Wenn Sie diese Anfrage nicht gestellt haben, ist keine weitere Aktion erforderlich — Ihr Passwort bleibt unverändert.',
        'fallback' => 'Falls die Schaltfläche nicht funktioniert, kopieren Sie diesen Link in Ihren Browser:',
        'closing'  => 'Mit freundlichen Grüßen,',
        'team'     => 'Das ' . site_name() . '-Team',
    ],
    'lt' => [
        'title'    => 'Slaptažodžio atkūrimas',
        'greeting' => 'Sveiki ' . ($user->name ?? '') . ',',
        'intro'    => 'Paprašėte atkurti slaptažodį. Spustelėkite žemiau esantį mygtuką, kad pasirinktumėte naują.',
        'button'   => 'Atkurti slaptažodį',
        'expiry'   => 'Ši nuoroda nustos galioti po ' . $expireMinutes . ' minučių.',
        'ignore'   => 'Jei ne jūs pateikėte šį prašymą, jokių veiksmų atlikti nereikia — jūsų slaptažodis liks nepakeistas.',
        'fallback' => 'Jei mygtukas neveikia, nukopijuokite šią nuorodą į naršyklę:',
        'closing'  => 'Pagarbiai,',
        'team'     => site_name() . ' komanda',
    ],
    'ro' => [
        'title'    => 'Resetarea parolei',
        'greeting' => 'Bună ziua ' . ($user->name ?? '') . ',',
        'intro'    => 'Ați solicitat resetarea parolei. Faceți clic pe butonul de mai jos pentru a alege una nouă.',
        'button'   => 'Resetează parola',
        'expiry'   => 'Acest link expiră în ' . $expireMinutes . ' minute.',
        'ignore'   => 'Dacă nu dumneavoastră ați făcut această solicitare, nu este necesară nicio acțiune — parola dumneavoastră rămâne neschimbată.',
        'fallback' => 'Dacă butonul nu funcționează, copiați acest link în browser:',
        'closing'  => 'Cu stimă,',
        'team'     => 'Echipa ' . site_name(),
    ],
    'lv' => [
        'title'    => 'Paroles atiestatīšana',
        'greeting' => 'Sveiki ' . ($user->name ?? '') . ',',
        'intro'    => 'Jūs pieprasījāt paroles atiestatīšanu. Noklikšķiniet uz zemāk esošās pogas, lai izvēlētos jaunu.',
        'button'   => 'Atiestatīt paroli',
        'expiry'   => 'Šī saite zaudēs derīgumu pēc ' . $expireMinutes . ' minūtēm.',
        'ignore'   => 'Ja šo pieprasījumu neveicāt jūs, nekāda darbība nav nepieciešama — jūsu parole paliks nemainīga.',
        'fallback' => 'Ja poga nedarbojas, ielīmējiet šo saiti savā pārlūkprogrammā:',
        'closing'  => 'Ar cieņu,',
        'team'     => site_name() . ' komanda',
    ],
    'nl' => [
        'title'    => 'Wachtwoord opnieuw instellen',
        'greeting' => 'Hallo ' . ($user->name ?? '') . ',',
        'intro'    => 'U heeft gevraagd om uw wachtwoord opnieuw in te stellen. Klik op de onderstaande knop om een nieuw wachtwoord te kiezen.',
        'button'   => 'Wachtwoord opnieuw instellen',
        'expiry'   => 'Deze link verloopt over ' . $expireMinutes . ' minuten.',
        'ignore'   => 'Als u dit niet heeft aangevraagd, hoeft u niets te doen — uw wachtwoord blijft ongewijzigd.',
        'fallback' => 'Als de knop niet werkt, kopieer deze link dan naar uw browser:',
        'closing'  => 'Met vriendelijke groet,',
        'team'     => 'Het team van ' . site_name(),
    ],
    'pt' => [
        'title'    => 'Redefinição de palavra-passe',
        'greeting' => 'Olá ' . ($user->name ?? '') . ',',
        'intro'    => 'Solicitou a redefinição da sua palavra-passe. Clique no botão abaixo para escolher uma nova.',
        'button'   => 'Redefinir palavra-passe',
        'expiry'   => 'Este link expira em ' . $expireMinutes . ' minutos.',
        'ignore'   => 'Se não foi você que fez este pedido, não é necessária qualquer ação — a sua palavra-passe permanece inalterada.',
        'fallback' => 'Se o botão não funcionar, copie este link para o seu navegador:',
        'closing'  => 'Atenciosamente,',
        'team'     => 'A equipa ' . site_name(),
    ],
    'hr' => [
        'title'    => 'Poništavanje lozinke',
        'greeting' => 'Pozdrav ' . ($user->name ?? '') . ',',
        'intro'    => 'Zatražili ste poništavanje lozinke. Kliknite na gumb ispod za odabir nove.',
        'button'   => 'Poništi lozinku',
        'expiry'   => 'Ova poveznica istječe za ' . $expireMinutes . ' minuta.',
        'ignore'   => 'Ako niste vi zatražili ovo, nije potrebna nikakva radnja — vaša lozinka ostaje nepromijenjena.',
        'fallback' => 'Ako gumb ne radi, kopirajte ovu poveznicu u preglednik:',
        'closing'  => 'S poštovanjem,',
        'team'     => 'Tim ' . site_name(),
    ],
];
$t = $texts[$locale] ?? $texts['fr'];
$sub = ($subs[$locale] ?? $subs['fr'])[$portal] ?? ($subs['fr'][$portal] ?? $subs['fr']['client']);
@endphp
<x-email-layout
    :title="$t['title']"
    :subtitle="$sub"
    accent="teal"
    :locale="$locale"
>

  <p class="greeting">{{ $t['greeting'] }}</p>

  <p class="body-text">{{ $t['intro'] }}</p>

  <div class="btn-wrap">
    <a href="{{ $url }}" class="btn">{{ $t['button'] }}</a>
  </div>

  <p class="url-fallback">
    {{ $t['fallback'] }}<br>
    <a href="{{ $url }}">{{ $url }}</a>
  </p>

  <div class="alert alert-info">
    <p>{{ $t['expiry'] }}</p>
  </div>

  <p class="body-text">{{ $t['ignore'] }}</p>

  <p class="closing">
    {{ $t['closing'] }}<br>
    <strong>{{ $t['team'] }}</strong>
  </p>

</x-email-layout>
