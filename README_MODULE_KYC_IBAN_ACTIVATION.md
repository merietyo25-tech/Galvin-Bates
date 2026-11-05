# Module : vérification KYC · attribution IBAN · activation du compte

Extrait du projet `financ` (Laravel). Cette branche ne contient **que** ce module, avec les fichiers
à leur chemin Laravel habituel : on peut donc la fusionner directement dans un autre projet Laravel.

## Récupérer le module dans un autre dépôt

```bash
# depuis le dépôt cible
git remote add financ https://github.com/merietyo25-tech/Rhonda-Mercer.git
git fetch financ module/kyc-iban-activation

# Option A : copier les fichiers sans historique
git checkout financ/module/kyc-iban-activation -- .

# Option B : fusionner la branche (historiques indépendants)
git merge financ/module/kyc-iban-activation --allow-unrelated-histories
```

## Contenu

| Fonction | Fichiers |
|---|---|
| **KYC client** | `Client/KycController`, `Services/KycForm`, `Services/KycDocumentService`, `Requests/SubmitKycRequest`, vues `client/app/kyc/*` |
| **KYC admin** | `Admin/KycController` (approuver / rejeter / valider sans documents), `Admin/KycFieldController` (champs configurables), vues `admin/kyc/*`, `Mail/KycStatusMail` |
| **Traduction des champs KYC** | `Services/KycTranslator`, commande `TranslateKycField` |
| **Blocage tant que KYC non approuvé** | `Middleware/EnsureKycApproved` (alias `kyc.approved`) |
| **Attribution IBAN** | `Services/BankingProvisioner` (IBAN allemand valide, clé mod 97, BIC), `Admin/BankingController`, `Requests/AssignBankingRequest`, `Rules/ValidIban`, modèles `BankAccount` / `Card`, vue `admin/users/banking`, `Mail/BankingAssignedMail` |
| **Activation du compte** | `Auth/EmailVerificationController` (lien signé), `Auth/ActivationOtpController` (code OTP), `Mail/VerifyAccountMail`, `Mail/OtpMail`, vues `auth/verify-notice`, `auth/activate-otp` |
| **Base de données** | migrations `kyc_verifications`, `kyc_reviews`, `kyc_fields` / `kyc_answers`, `bank_accounts`, `cards`, + `add_kyc_iban_activation_module_columns` (colonnes de réglage) |
| **Routes** | `routes/kyc_iban_activation.php` |
| **Traductions** | `lang/*/kyc.php`, `lang/*/banking.php` (17 langues) |

Fonctionnement : quand un admin approuve le KYC (ou force la validation), `BankingProvisioner::provision()`
crée automatiquement l'IBAN + BIC du client puis le notifie. L'admin peut ensuite modifier / bloquer / supprimer
ces coordonnées depuis `admin/users/{user}/banking`.

## Intégration dans le projet cible

1. **Routes** — dans `routes/web.php` :
   ```php
   require __DIR__ . '/kyc_iban_activation.php';
   ```
   Adapter les middlewares des groupes (`role:client`, `role:admin|super-admin` viennent de spatie/laravel-permission).

2. **Middleware** — dans `app/Http/Kernel.php` (`$middlewareAliases`) ou `bootstrap/app.php` (Laravel 11+) :
   ```php
   'kyc.approved' => \App\Http\Middleware\EnsureKycApproved::class,
   ```

3. **Modèle `User`** — ajouter :
   ```php
   protected $casts = ['email_verified_at' => 'datetime' /* ... */];

   public function kycAnswers()      { return $this->hasMany(\App\Models\KycAnswer::class); }
   public function kycVerification() { return $this->hasOne(\App\Models\KycVerification::class); }
   public function bankAccount()     { return $this->hasOne(\App\Models\BankAccount::class); }
   public function card()            { return $this->hasOne(\App\Models\Card::class); }
   ```
   Le module utilise aussi les colonnes `uuid`, `name`, `email`, `locale`, `type` de `users`.

4. **Modèle `SiteContact`** (réglages du site, une seule ligne) — doit exposer `current()` et :
   ```php
   // fillable : 'default_bic', 'iban_bank_code', 'activation_mail_enabled', 'activation_otp_enabled', 'kyc_steps'
   // casts    : 'activation_mail_enabled' => 'boolean', 'activation_otp_enabled' => 'boolean'

   /** « otp » (code saisi), « link » (lien par e-mail) ou « none » (activation automatique). */
   public function activationMethod(): string
   {
       return $this->activation_otp_enabled ? 'otp' : ($this->activation_mail_enabled ? 'link' : 'none');
   }
   ```

5. **Branchement de l'activation**
   - À l'inscription, après création de l'utilisateur :
     ```php
     $sent = EmailVerificationController::sendActivationMail($user);
     if ($user->fresh()->email_verified_at) { /* activation « none » : connexion directe */ }
     elseif (SiteContact::current()->activationMethod() === 'otp') {
         $request->session()->put('activation_user_id', $user->id);
         return redirect()->route('activation.otp');
     } else {
         return redirect()->route('verification.notice')->with('verify_email', $user->email);
     }
     ```
   - À la connexion, si `! $user->email_verified_at` :
     ```php
     $method = SiteContact::current()->activationMethod();
     if ($method === 'none') { $user->forceFill(['email_verified_at' => now()])->save(); }
     elseif ($method === 'otp') {
         $request->session()->put('activation_user_id', $user->id);
         ActivationOtpController::sendCode($user);
         return redirect()->route('activation.otp');
     } else {
         return redirect()->route('verification.notice')->with('verify_email', $user->email);
     }
     ```

## Dépendances restées dans le projet d'origine (à fournir / adapter)

- Modèles : `User`, `SiteContact`, `ClientNotification` (méthode statique `notifyUser()`), `Language` (`enabledCodes()`)
- Helper global `site_name()`
- Layouts Blade : `layouts.dashboard` (admin), `layouts.client-app` (client), `layouts.auth-flow` (activation)
- Fichiers de langue `auth.php` et `onboarding.php` (clés utilisées par les vues d'activation)
- Routes appelées par les vues : `login`, `admin.users.show`, `client.app.home`, `client.app.profile`, `client.app.payment-methods`
- Table `site_contacts` (la migration du module y ajoute ses colonnes ; `kyc_steps` est ajouté par la migration `kyc_fields`)
- `KycTranslator` appelle un service HTTP de traduction (voir la classe pour la config)
- spatie/laravel-permission pour `role:...` et `assignRole()`

Après copie : `php artisan migrate`, puis `php artisan optimize:clear`.
