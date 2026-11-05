<?php

/*
|--------------------------------------------------------------------------
| Module : Vérification KYC · Attribution IBAN · Activation du compte
|--------------------------------------------------------------------------
| À inclure depuis routes/web.php :
|
|     require __DIR__ . '/kyc_iban_activation.php';
|
| Adapter les middlewares / préfixes des groupes « client » et « admin » à ceux
| du projet cible (ici : ceux du projet d'origine).
*/

use App\Http\Controllers\Admin\BankingController;
use App\Http\Controllers\Admin\KycController as AdminKycController;
use App\Http\Controllers\Admin\KycFieldController;
use App\Http\Controllers\Auth\ActivationOtpController;
use App\Http\Controllers\Auth\EmailVerificationController;
use App\Http\Controllers\Client\KycController as ClientKycController;
use Illuminate\Support\Facades\Route;

// ── Activation du compte (public) ───────────────────────────────────────────

// Activation par e-mail (lien signé, idempotent)
Route::get('/email/verify',               [EmailVerificationController::class, 'notice'])->name('verification.notice');
Route::get('/email/verify/{uuid}/{hash}', [EmailVerificationController::class, 'verify'])->name('verification.verify')->middleware('throttle:20,1');
Route::post('/email/resend',              [EmailVerificationController::class, 'resend'])->name('verification.resend')->middleware('throttle:3,1');

// Activation par code OTP (option choisie par l'administration)
Route::get('/activate-code',         [ActivationOtpController::class, 'show'])->name('activation.otp');
Route::post('/activate-code',        [ActivationOtpController::class, 'verify'])->name('activation.otp.verify')->middleware('throttle:10,1');
Route::post('/activate-code/resend', [ActivationOtpController::class, 'resend'])->name('activation.otp.resend')->middleware('throttle:3,1');

// ── Espace client : vérification d'identité (KYC) ──────────────────────────
// Projet d'origine : à l'intérieur du groupe client (noms de routes préfixés « client.app. »).
Route::middleware(['auth', 'role:client', 'client.locale'])->prefix('app')->name('client.app.')->group(function () {
    Route::get('/kyc',       [ClientKycController::class, 'show'])->name('kyc.show');
    Route::post('/kyc',      [ClientKycController::class, 'saveStep'])->name('kyc.store');
    Route::post('/kyc/info', [ClientKycController::class, 'saveStep'])->name('kyc.info');

    // Exemple : protéger des routes sensibles derrière un KYC approuvé
    // Route::middleware('kyc.approved')->group(function () { ... });
});

// ── Administration : KYC + attribution IBAN / carte ────────────────────────
// Projet d'origine : à l'intérieur du groupe admin (noms de routes préfixés « admin. »).
Route::middleware(['auth', 'role:admin|super-admin'])->prefix('admin')->name('admin.')->group(function () {
    // Champs du formulaire KYC (configurables)
    Route::get('/kyc/fields',            [KycFieldController::class, 'index'])->name('kyc.fields');
    Route::post('/kyc/fields',           [KycFieldController::class, 'update'])->name('kyc.fields.update');
    Route::post('/kyc/fields/new',       [KycFieldController::class, 'store'])->name('kyc.fields.store');
    Route::delete('/kyc/fields/{field}', [KycFieldController::class, 'destroy'])->name('kyc.fields.destroy');

    // Dossiers KYC
    Route::get('/kyc',                       [AdminKycController::class, 'index'])->name('kyc.index');
    Route::get('/kyc/{kyc}',                 [AdminKycController::class, 'show'])->name('kyc.show');
    Route::get('/kyc/{kyc}/file/{key}',      [AdminKycController::class, 'answerFile'])->name('kyc.file');
    Route::get('/kyc/{kyc}/document/{type}', [AdminKycController::class, 'document'])->name('kyc.document');
    Route::post('/kyc/{kyc}/approve',        [AdminKycController::class, 'approve'])->name('kyc.approve');
    Route::post('/kyc/{kyc}/reject',         [AdminKycController::class, 'reject'])->name('kyc.reject');
    // Valider un client sans documents (génère aussi l'IBAN)
    Route::post('/users/{user}/kyc/validate', [AdminKycController::class, 'forceApprove'])->name('users.kyc.validate');

    // Attribution IBAN / carte (clients au KYC approuvé)
    Route::get('/users/{user}/banking',               [BankingController::class, 'edit'])->name('users.banking.edit');
    Route::post('/users/{user}/banking',              [BankingController::class, 'store'])->name('users.banking.store');
    Route::post('/users/{user}/banking/toggle-block', [BankingController::class, 'toggleBlock'])->name('users.banking.toggle-block');
    Route::delete('/users/{user}/banking',            [BankingController::class, 'destroy'])->name('users.banking.destroy');
});
