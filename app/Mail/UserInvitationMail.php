<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class UserInvitationMail extends Mailable
{
    use Queueable, SerializesModels;

    // ── Sujets de l'email selon [locale][genre] ──────────────────────────────
    private array $subjects;

    private function subjectsArray(): array
    {
        return [
        'fr' => ['M' => 'Activation de votre compte — ' . site_name(),
                 'F' => 'Activation de votre compte — ' . site_name(),
                 'N' => 'Activez votre compte — ' . site_name()],
        'en' => ['M' => 'Activate your account — ' . site_name(),
                 'F' => 'Activate your account — ' . site_name(),
                 'N' => 'Activate your account — ' . site_name()],
        'es' => ['M' => 'Activación de su cuenta — ' . site_name(),
                 'F' => 'Activación de su cuenta — ' . site_name(),
                 'N' => 'Active su cuenta — ' . site_name()],
        'pl' => ['M' => 'Aktywacja Twojego konta — ' . site_name(),
                 'F' => 'Aktywacja Twojego konta — ' . site_name(),
                 'N' => 'Aktywuj swoje konto — ' . site_name()],
        'bg' => ['M' => 'Активиране на вашия профил — ' . site_name(),
                 'F' => 'Активиране на вашия профил — ' . site_name(),
                 'N' => 'Активирайте профила си — ' . site_name()],
        'hu' => ['M' => 'Fiókja aktiválása — ' . site_name(),
                 'F' => 'Fiókja aktiválása — ' . site_name(),
                 'N' => 'Aktiválja fiókját — ' . site_name()],
        'it' => ['M' => 'Attivazione del tuo account — ' . site_name(),
                 'F' => 'Attivazione del tuo account — ' . site_name(),
                 'N' => 'Attiva il tuo account — ' . site_name()],
        'de' => ['M' => 'Aktivierung Ihres Kontos — ' . site_name(),
                 'F' => 'Aktivierung Ihres Kontos — ' . site_name(),
                 'N' => 'Aktivieren Sie Ihr Konto — ' . site_name()],
        'lt' => ['M' => 'Jūsų paskyros aktyvinimas — ' . site_name(),
                 'F' => 'Jūsų paskyros aktyvinimas — ' . site_name(),
                 'N' => 'Aktyvuokite savo paskyrą — ' . site_name()],
        'ro' => ['M' => 'Activarea contului dumneavoastră — ' . site_name(),
                 'F' => 'Activarea contului dumneavoastră — ' . site_name(),
                 'N' => 'Activați-vă contul — ' . site_name()],
        'lv' => ['M' => 'Jūsu konta aktivizēšana — ' . site_name(),
                 'F' => 'Jūsu konta aktivizēšana — ' . site_name(),
                 'N' => 'Aktivizējiet savu kontu — ' . site_name()],
        'nl' => ['M' => 'Activering van uw account — ' . site_name(),
                 'F' => 'Activering van uw account — ' . site_name(),
                 'N' => 'Activeer uw account — ' . site_name()],
        'pt' => ['M' => 'Ativação da sua conta — ' . site_name(),
                 'F' => 'Ativação da sua conta — ' . site_name(),
                 'N' => 'Ative a sua conta — ' . site_name()],
        ];
    }

    // ── Labels du bouton selon la locale ────────────────────────────────────
    private const BTN_LABELS = [
        'fr' => 'Activer mon compte',
        'en' => 'Activate my account',
        'es' => 'Activar mi cuenta',
        'pl' => 'Aktywuj moje konto',
        'bg' => 'Активирай моя профил',
        'hu' => 'Fiókom aktiválása',
        'it' => 'Attiva il mio account',
        'de' => 'Mein Konto aktivieren',
        'lt' => 'Aktyvuoti paskyrą',
        'ro' => 'Activează-mi contul',
        'lv' => 'Aktivizēt manu kontu',
        'nl' => 'Mijn account activeren',
        'pt' => 'Ativar a minha conta',
    ];

    // ── Corps principal selon la locale ─────────────────────────────────────
    private const BODY = [
        'fr' => [
            'intro'  => 'Un conseiller **{NOM_ENTREPRISE}** vient de créer votre espace client personnel.',
            'action' => 'Pour accéder à votre espace et suivre vos dossiers de financement, **activez votre compte** en cliquant sur le bouton ci-dessous.',
        ],
        'en' => [
            'intro'  => 'A **{NOM_ENTREPRISE}** advisor has just created your personal client space.',
            'action' => 'To access your space and track your financing files, **activate your account** by clicking the button below.',
        ],
        'es' => [
            'intro'  => 'Un asesor de **{NOM_ENTREPRISE}** acaba de crear su espacio de cliente personal.',
            'action' => 'Para acceder a su espacio y hacer seguimiento de sus expedientes, **active su cuenta** haciendo clic en el botón a continuación.',
        ],
        'pl' => [
            'intro'  => 'Doradca **{NOM_ENTREPRISE}** właśnie utworzył Twój osobisty obszar klienta.',
            'action' => 'Aby uzyskać dostęp do swojego obszaru i śledzić swoje wnioski, **aktywuj konto** klikając poniższy przycisk.',
        ],
        'bg' => [
            'intro'  => 'Консултант от **{NOM_ENTREPRISE}** току-що създаде вашето лично клиентско пространство.',
            'action' => 'За да получите достъп до пространството си и да следите досиетата си за финансиране, **активирайте профила си**, като натиснете бутона по-долу.',
        ],
        'hu' => [
            'intro'  => 'A **{NOM_ENTREPRISE}** egyik tanácsadója most hozta létre az Ön személyes ügyfélfiókját.',
            'action' => 'A fiókjának eléréséhez és finanszírozási ügyeinek nyomon követéséhez kérjük, **aktiválja fiókját** az alábbi gombra kattintva.',
        ],
        'it' => [
            'intro'  => 'Un consulente **{NOM_ENTREPRISE}** ha appena creato il tuo spazio cliente personale.',
            'action' => 'Per accedere al tuo spazio e monitorare le tue pratiche di finanziamento, **attiva il tuo account** cliccando sul pulsante qui sotto.',
        ],
        'de' => [
            'intro'  => 'Ein Berater von **{NOM_ENTREPRISE}** hat soeben Ihren persönlichen Kundenbereich erstellt.',
            'action' => 'Um auf Ihren Bereich zuzugreifen und Ihre Finanzierungsvorgänge zu verfolgen, **aktivieren Sie Ihr Konto**, indem Sie auf die Schaltfläche unten klicken.',
        ],
        'lt' => [
            'intro'  => '**{NOM_ENTREPRISE}** konsultantas ką tik sukūrė jūsų asmeninę kliento paskyrą.',
            'action' => 'Norėdami pasiekti savo paskyrą ir stebėti savo finansavimo bylas, **aktyvuokite paskyrą**, spustelėję mygtuką žemiau.',
        ],
        'ro' => [
            'intro'  => 'Un consilier **{NOM_ENTREPRISE}** tocmai a creat spațiul dumneavoastră personal de client.',
            'action' => 'Pentru a accesa spațiul dumneavoastră și a urmări dosarele de finanțare, **activați-vă contul** apăsând pe butonul de mai jos.',
        ],
        'lv' => [
            'intro'  => '**{NOM_ENTREPRISE}** konsultants tikko izveidoja jūsu personīgo klienta profilu.',
            'action' => 'Lai piekļūtu savam profilam un sekotu līdzi savām finansējuma lietām, **aktivizējiet savu kontu**, noklikšķinot uz zemāk esošās pogas.',
        ],
        'nl' => [
            'intro'  => 'Een adviseur van **{NOM_ENTREPRISE}** heeft zojuist uw persoonlijke klantomgeving aangemaakt.',
            'action' => 'Om toegang te krijgen tot uw omgeving en uw financieringsdossiers te volgen, **activeert u uw account** door op onderstaande knop te klikken.',
        ],
        'pt' => [
            'intro'  => 'Um consultor da **{NOM_ENTREPRISE}** acabou de criar o seu espaço de cliente pessoal.',
            'action' => 'Para aceder ao seu espaço e acompanhar os seus processos de financiamento, **ative a sua conta** clicando no botão abaixo.',
        ],
    ];

    // ── Valeurs des balises selon [locale][genre] ────────────────────────────
    private array $brandTags;

    private function brandTagsArray(): array
    {
        return [
        '{CHER_E}' => [
            'fr' => ['M' => 'Cher',       'F' => 'Chère',     'N' => 'Bonjour'],
            'en' => ['M' => 'Dear',       'F' => 'Dear',      'N' => 'Hello'],
            'es' => ['M' => 'Estimado',   'F' => 'Estimada',  'N' => 'Hola'],
            'pl' => ['M' => 'Szanowny',   'F' => 'Szanowna',  'N' => 'Witaj'],
            'bg' => ['M' => 'Уважаеми',   'F' => 'Уважаема',  'N' => 'Здравейте'],
            'hu' => ['M' => 'Tisztelt',   'F' => 'Tisztelt',  'N' => 'Kedves'],
            'it' => ['M' => 'Egregio',    'F' => 'Gentile',   'N' => 'Ciao'],
            'de' => ['M' => 'Sehr geehrter', 'F' => 'Sehr geehrte', 'N' => 'Hallo'],
            'lt' => ['M' => 'Gerbiamas',  'F' => 'Gerbiama',  'N' => 'Sveiki'],
            'ro' => ['M' => 'Stimate',    'F' => 'Stimată',   'N' => 'Bună ziua'],
            'lv' => ['M' => 'Godātais',   'F' => 'Godātā',    'N' => 'Sveiki'],
            'nl' => ['M' => 'Geachte',    'F' => 'Geachte',   'N' => 'Beste'],
            'pt' => ['M' => 'Caro',       'F' => 'Cara',      'N' => 'Olá'],
        ],
        '{SALUTATION}' => [
            'fr' => ['M' => 'Monsieur',   'F' => 'Madame',    'N' => ''],
            'en' => ['M' => 'Mr.',        'F' => 'Ms.',       'N' => ''],
            'es' => ['M' => 'Sr.',        'F' => 'Sra.',      'N' => ''],
            'pl' => ['M' => 'Panie',      'F' => 'Pani',      'N' => ''],
            'bg' => ['M' => 'Господин',   'F' => 'Госпожо',   'N' => ''],
            'hu' => ['M' => '',           'F' => '',          'N' => ''],
            'it' => ['M' => 'Signor',     'F' => 'Signora',   'N' => ''],
            'de' => ['M' => 'Herr',       'F' => 'Frau',      'N' => ''],
            'lt' => ['M' => 'Pone',       'F' => 'Ponia',     'N' => ''],
            'ro' => ['M' => 'Domnule',    'F' => 'Doamnă',    'N' => ''],
            'lv' => ['M' => 'Kungs',      'F' => 'Kundze',    'N' => ''],
            'nl' => ['M' => 'heer',       'F' => 'mevrouw',   'N' => ''],
            'pt' => ['M' => 'Sr.',        'F' => 'Sra.',      'N' => ''],
        ],
        '{FORMULE_POLITESSE}' => [
            'fr' => ['M' => 'Cordialement',    'F' => 'Cordialement',    'N' => 'Cordialement'],
            'en' => ['M' => 'Best regards',    'F' => 'Best regards',    'N' => 'Kind regards'],
            'es' => ['M' => 'Atentamente',     'F' => 'Atentamente',     'N' => 'Saludos'],
            'pl' => ['M' => 'Z poważaniem',    'F' => 'Z poważaniem',    'N' => 'Z pozdrowieniami'],
            'bg' => ['M' => 'С уважение',      'F' => 'С уважение',      'N' => 'Поздрави'],
            'hu' => ['M' => 'Tisztelettel',    'F' => 'Tisztelettel',    'N' => 'Üdvözlettel'],
            'it' => ['M' => 'Cordiali saluti', 'F' => 'Cordiali saluti', 'N' => 'Un saluto'],
            'de' => ['M' => 'Mit freundlichen Grüßen', 'F' => 'Mit freundlichen Grüßen', 'N' => 'Freundliche Grüße'],
            'lt' => ['M' => 'Pagarbiai',       'F' => 'Pagarbiai',       'N' => 'Pagarbiai'],
            'ro' => ['M' => 'Cu stimă',        'F' => 'Cu stimă',        'N' => 'Cu respect'],
            'lv' => ['M' => 'Ar cieņu',        'F' => 'Ar cieņu',        'N' => 'Ar cieņu'],
            'nl' => ['M' => 'Met vriendelijke groet', 'F' => 'Met vriendelijke groet', 'N' => 'Vriendelijke groeten'],
            'pt' => ['M' => 'Atenciosamente',  'F' => 'Atenciosamente',  'N' => 'Cumprimentos'],
        ],
        '{EQUIPE}' => [
            'fr' => ['M' => "L'équipe " . site_name(),     'F' => "L'équipe " . site_name(),     'N' => "L'équipe " . site_name()],
            'en' => ['M' => 'The ' . site_name() . ' Team',     'F' => 'The ' . site_name() . ' Team',     'N' => 'The ' . site_name() . ' Team'],
            'es' => ['M' => 'El equipo de ' . site_name(), 'F' => 'El equipo de ' . site_name(), 'N' => 'El equipo de ' . site_name()],
            'pl' => ['M' => 'Zespół ' . site_name(),       'F' => 'Zespół ' . site_name(),       'N' => 'Zespół ' . site_name()],
            'bg' => ['M' => 'Екипът на ' . site_name(),    'F' => 'Екипът на ' . site_name(),    'N' => 'Екипът на ' . site_name()],
            'hu' => ['M' => 'A ' . site_name() . ' csapata',    'F' => 'A ' . site_name() . ' csapata',    'N' => 'A ' . site_name() . ' csapata'],
            'it' => ['M' => 'Il team ' . site_name(),      'F' => 'Il team ' . site_name(),      'N' => 'Il team ' . site_name()],
            'de' => ['M' => 'Das ' . site_name() . '-Team',     'F' => 'Das ' . site_name() . '-Team',     'N' => 'Das ' . site_name() . '-Team'],
            'lt' => ['M' => site_name() . ' komanda',      'F' => site_name() . ' komanda',      'N' => site_name() . ' komanda'],
            'ro' => ['M' => 'Echipa ' . site_name(),       'F' => 'Echipa ' . site_name(),       'N' => 'Echipa ' . site_name()],
            'lv' => ['M' => site_name() . ' komanda',      'F' => site_name() . ' komanda',      'N' => site_name() . ' komanda'],
            'nl' => ['M' => 'Het ' . site_name() . ' Team',     'F' => 'Het ' . site_name() . ' Team',     'N' => 'Het ' . site_name() . ' Team'],
            'pt' => ['M' => 'A equipa ' . site_name(),     'F' => 'A equipa ' . site_name(),     'N' => 'A equipa ' . site_name()],
        ],
        '{NOTICE_PERSONNEL}' => [
            'fr' => ['M' => "Ce lien d'activation est **personnel et unique**. Il expire dès que vous avez défini votre mot de passe.",
                     'F' => "Ce lien d'activation est **personnel et unique**. Il expire dès que vous avez défini votre mot de passe.",
                     'N' => "Ce lien d'activation est **personnel et unique**. Il expire dès que vous avez défini votre mot de passe."],
            'en' => ['M' => 'This activation link is **personal and unique**. It expires as soon as you have set your password.',
                     'F' => 'This activation link is **personal and unique**. It expires as soon as you have set your password.',
                     'N' => 'This activation link is **personal and unique**. It expires as soon as you have set your password.'],
            'es' => ['M' => 'Este enlace de activación es **personal y único**. Expira en cuanto haya establecido su contraseña.',
                     'F' => 'Este enlace de activación es **personal y único**. Expira en cuanto haya establecido su contraseña.',
                     'N' => 'Este enlace de activación es **personal y único**. Expira en cuanto haya establecido su contraseña.'],
            'pl' => ['M' => 'Ten link aktywacyjny jest **osobisty i unikalny**. Wygasa natychmiast po ustawieniu hasła.',
                     'F' => 'Ten link aktywacyjny jest **osobisty i unikalny**. Wygasa natychmiast po ustawieniu hasła.',
                     'N' => 'Ten link aktywacyjny jest **osobisty i unikalny**. Wygasa natychmiast po ustawieniu hasła.'],
            'bg' => ['M' => 'Този линк за активиране е **личен и уникален**. Той изтича веднага щом зададете паролата си.',
                     'F' => 'Този линк за активиране е **личен и уникален**. Той изтича веднага щом зададете паролата си.',
                     'N' => 'Този линк за активиране е **личен и уникален**. Той изтича веднага щом зададете паролата си.'],
            'hu' => ['M' => 'Ez az aktivációs link **személyes és egyedi**. A jelszó beállítása után azonnal lejár.',
                     'F' => 'Ez az aktivációs link **személyes és egyedi**. A jelszó beállítása után azonnal lejár.',
                     'N' => 'Ez az aktivációs link **személyes és egyedi**. A jelszó beállítása után azonnal lejár.'],
            'it' => ['M' => 'Questo link di attivazione è **personale e unico**. Scade non appena avrai impostato la tua password.',
                     'F' => 'Questo link di attivazione è **personale e unico**. Scade non appena avrai impostato la tua password.',
                     'N' => 'Questo link di attivazione è **personale e unico**. Scade non appena avrai impostato la tua password.'],
            'de' => ['M' => 'Dieser Aktivierungslink ist **persönlich und einmalig**. Er läuft ab, sobald Sie Ihr Passwort festgelegt haben.',
                     'F' => 'Dieser Aktivierungslink ist **persönlich und einmalig**. Er läuft ab, sobald Sie Ihr Passwort festgelegt haben.',
                     'N' => 'Dieser Aktivierungslink ist **persönlich und einmalig**. Er läuft ab, sobald Sie Ihr Passwort festgelegt haben.'],
            'lt' => ['M' => 'Ši aktyvinimo nuoroda yra **asmeninė ir unikali**. Ji nustoja galioti, kai tik nustatote savo slaptažodį.',
                     'F' => 'Ši aktyvinimo nuoroda yra **asmeninė ir unikali**. Ji nustoja galioti, kai tik nustatote savo slaptažodį.',
                     'N' => 'Ši aktyvinimo nuoroda yra **asmeninė ir unikali**. Ji nustoja galioti, kai tik nustatote savo slaptažodį.'],
            'ro' => ['M' => 'Acest link de activare este **personal și unic**. Expiră imediat ce ați stabilit parola.',
                     'F' => 'Acest link de activare este **personal și unic**. Expiră imediat ce ați stabilit parola.',
                     'N' => 'Acest link de activare este **personal și unic**. Expiră imediat ce ați stabilit parola.'],
            'lv' => ['M' => 'Šī aktivizācijas saite ir **personiska un unikāla**. Tā zaudē derīgumu uzreiz pēc paroles iestatīšanas.',
                     'F' => 'Šī aktivizācijas saite ir **personiska un unikāla**. Tā zaudē derīgumu uzreiz pēc paroles iestatīšanas.',
                     'N' => 'Šī aktivizācijas saite ir **personiska un unikāla**. Tā zaudē derīgumu uzreiz pēc paroles iestatīšanas.'],
            'nl' => ['M' => 'Deze activeringslink is **persoonlijk en uniek**. Hij vervalt zodra u uw wachtwoord heeft ingesteld.',
                     'F' => 'Deze activeringslink is **persoonlijk en uniek**. Hij vervalt zodra u uw wachtwoord heeft ingesteld.',
                     'N' => 'Deze activeringslink is **persoonlijk en uniek**. Hij vervalt zodra u uw wachtwoord heeft ingesteld.'],
            'pt' => ['M' => 'Este link de ativação é **pessoal e único**. Expira assim que definir a sua palavra-passe.',
                     'F' => 'Este link de ativação é **pessoal e único**. Expira assim que definir a sua palavra-passe.',
                     'N' => 'Este link de ativação é **pessoal e único**. Expira assim que definir a sua palavra-passe.'],
        ],
        '{NOTICE_IGNORE}' => [
            'fr' => ['M' => "Si vous n'êtes pas à l'origine de cette création de compte, vous pouvez ignorer cet email.",
                     'F' => "Si vous n'êtes pas à l'origine de cette création de compte, vous pouvez ignorer cet email.",
                     'N' => "Si vous n'êtes pas à l'origine de cette création de compte, vous pouvez ignorer cet email."],
            'en' => ['M' => "If you did not request this account creation, you can ignore this email.",
                     'F' => "If you did not request this account creation, you can ignore this email.",
                     'N' => "If you did not request this account creation, you can ignore this email."],
            'es' => ['M' => "Si usted no solicitó la creación de esta cuenta, puede ignorar este email.",
                     'F' => "Si usted no solicitó la creación de esta cuenta, puede ignorar este email.",
                     'N' => "Si usted no solicitó la creación de esta cuenta, puede ignorar este email."],
            'pl' => ['M' => "Jeśli nie prosiłeś o utworzenie tego konta, możesz zignorować ten email.",
                     'F' => "Jeśli nie prosiłaś o utworzenie tego konta, możesz zignorować ten email.",
                     'N' => "Jeśli nie prosiłeś/aś o utworzenie tego konta, możesz zignorować ten email."],
            'bg' => ['M' => "Ако не сте инициирали създаването на този профил, можете да игнорирате този имейл.",
                     'F' => "Ако не сте инициирали създаването на този профил, можете да игнорирате този имейл.",
                     'N' => "Ако не сте инициирали създаването на този профил, можете да игнорирате този имейл."],
            'hu' => ['M' => "Ha nem Ön kezdeményezte ennek a fióknak a létrehozását, figyelmen kívül hagyhatja ezt az e-mailt.",
                     'F' => "Ha nem Ön kezdeményezte ennek a fióknak a létrehozását, figyelmen kívül hagyhatja ezt az e-mailt.",
                     'N' => "Ha nem Ön kezdeményezte ennek a fióknak a létrehozását, figyelmen kívül hagyhatja ezt az e-mailt."],
            'it' => ['M' => "Se non sei tu all'origine della creazione di questo account, puoi ignorare questa email.",
                     'F' => "Se non sei tu all'origine della creazione di questo account, puoi ignorare questa email.",
                     'N' => "Se non sei tu all'origine della creazione di questo account, puoi ignorare questa email."],
            'de' => ['M' => "Wenn Sie diese Kontoerstellung nicht veranlasst haben, können Sie diese E-Mail ignorieren.",
                     'F' => "Wenn Sie diese Kontoerstellung nicht veranlasst haben, können Sie diese E-Mail ignorieren.",
                     'N' => "Wenn Sie diese Kontoerstellung nicht veranlasst haben, können Sie diese E-Mail ignorieren."],
            'lt' => ['M' => "Jei ne jūs inicijavote šios paskyros sukūrimą, galite ignoruoti šį el. laišką.",
                     'F' => "Jei ne jūs inicijavote šios paskyros sukūrimą, galite ignoruoti šį el. laišką.",
                     'N' => "Jei ne jūs inicijavote šios paskyros sukūrimą, galite ignoruoti šį el. laišką."],
            'ro' => ['M' => "Dacă nu dumneavoastră ați inițiat crearea acestui cont, puteți ignora acest e-mail.",
                     'F' => "Dacă nu dumneavoastră ați inițiat crearea acestui cont, puteți ignora acest e-mail.",
                     'N' => "Dacă nu dumneavoastră ați inițiat crearea acestui cont, puteți ignora acest e-mail."],
            'lv' => ['M' => "Ja šī konta izveide nav notikusi pēc jūsu pieprasījuma, varat ignorēt šo e-pastu.",
                     'F' => "Ja šī konta izveide nav notikusi pēc jūsu pieprasījuma, varat ignorēt šo e-pastu.",
                     'N' => "Ja šī konta izveide nav notikusi pēc jūsu pieprasījuma, varat ignorēt šo e-pastu."],
            'nl' => ['M' => "Als u niet zelf om het aanmaken van dit account heeft gevraagd, kunt u deze e-mail negeren.",
                     'F' => "Als u niet zelf om het aanmaken van dit account heeft gevraagd, kunt u deze e-mail negeren.",
                     'N' => "Als u niet zelf om het aanmaken van dit account heeft gevraagd, kunt u deze e-mail negeren."],
            'pt' => ['M' => "Se não foi você quem solicitou a criação desta conta, pode ignorar este email.",
                     'F' => "Se não foi você quem solicitou a criação desta conta, pode ignorar este email.",
                     'N' => "Se não foi você quem solicitou a criação desta conta, pode ignorar este email."],
        ],
    ];
    }


    public function __construct(
        public User   $user,
        public string $activationUrl,
    ) {
        $this->subjects = $this->subjectsArray();
        $this->brandTags = $this->brandTagsArray();
    }

    public function envelope(): Envelope
    {
        $locale  = $this->user->locale  ?? 'fr';
        $gender  = $this->user->gender  ?? 'N';
        $subject = $this->subjects[$locale][$gender]
                ?? $this->subjects['fr']['N'];

        return new Envelope(subject: $subject);
    }

    public function content(): Content
    {
        $locale    = $this->user->locale ?? 'fr';
        $gender    = $this->user->gender ?? 'N';
        $firstName = explode(' ', $this->user->name)[0];

        $resolved = [];
        foreach ($this->brandTags as $balise => $locales) {
            $resolved[$balise] = $locales[$locale][$gender]
                              ?? $locales['fr']['N'];
        }

        $resolved['{PRENOM}']          = $firstName;
        $resolved['{NOM_COMPLET}']     = $this->user->name;
        $resolved['{EMAIL}']           = $this->user->email;
        $resolved['{LIEN_ACTIVATION}'] = $this->activationUrl;
        $resolved['{NOM_ENTREPRISE}']  = site_name();

        $body = self::BODY[$locale] ?? self::BODY['fr'];
        $resolved['{INTRO_CORPS}']  = $this->applyReplacements($body['intro'],  $resolved);
        $resolved['{CORPS_ACTION}'] = $this->applyReplacements($body['action'], $resolved);

        $greeting = trim($resolved['{CHER_E}'] . ' ' . $resolved['{SALUTATION}'] . ' ' . $this->user->name);

        return new Content(
            view: 'emails.user-invitation',
            with: [
                'user'          => $this->user,
                'activationUrl' => $this->activationUrl,
                'btnLabel'      => self::BTN_LABELS[$locale] ?? self::BTN_LABELS['fr'],
                'greeting'      => $greeting,
                'resolved'      => $resolved,
                'locale'        => $locale,
            ],
        );
    }

    public function attachments(): array
    {
        return [];
    }

    private function applyReplacements(string $text, array $resolved): string
    {
        return str_replace(array_keys($resolved), array_values($resolved), $text);
    }
}
