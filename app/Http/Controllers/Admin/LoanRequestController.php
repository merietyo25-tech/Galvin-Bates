<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\LoanFinalizedMail;
use App\Mail\LoanRejectedMail;
use App\Mail\LoanValidatedMail;
use App\Mail\SignedContractAcknowledgementMail;
use App\Mail\LoanValidationNotificationMail;
use App\Models\AccountMovement;
use App\Models\ClientNotification;
use App\Models\ContractTemplate;
use App\Models\Currency;
use App\Models\LoanHistory;
use App\Models\LoanRequest;
use App\Models\NotificationTemplate;
use App\Models\User;
use App\Services\DocumentArchive;
use App\Services\LoanPdfService;
use App\Services\LoanService;
use App\Services\NotificationDocxService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class LoanRequestController extends Controller
{
    public function __construct(
        private LoanService            $loanService,
        private LoanPdfService         $pdfService,
        private NotificationDocxService $notificationDocxService,
    ) {}

    public function index(Request $request)
    {
        $admin        = Auth::user();
        $isSuperAdmin = $admin->hasRole('super-admin');

        // Super-admin voit tous les dossiers; admin régulier voit les siens
        $query = LoanRequest::with(['client', 'admin']);
        if (! $isSuperAdmin) {
            $query->where('admin_id', $admin->id);
        }

        // Filtre par admin (super-admin uniquement)
        if ($isSuperAdmin && $request->filled('admin_id')) {
            $query->where('admin_id', $request->admin_id);
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }
        if ($request->filled('type_financement')) {
            $query->where('type_financement', $request->type_financement);
        }
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%$search%")
                  ->orWhere('email', 'like', "%$search%")
                  ->orWhere('reference', 'like', "%$search%");
            });
        }

        $loans = $query->latest()->paginate(15)->appends($request->query());

        $base = $isSuperAdmin ? LoanRequest::query() : LoanRequest::where('admin_id', $admin->id);
        $stats = [
            'total'           => (clone $base)->count(),
            'draft'           => (clone $base)->where('status', 'draft')->count(),
            'pending'         => (clone $base)->where('status', 'pending')->count(),
            'validated'       => (clone $base)->where('status', 'validated')->count(),
            'contract_sent'   => (clone $base)->where('status', 'contract_sent')->count(),
            'contract_signed' => (clone $base)->where('status', 'contract_signed')->count(),
            'finalized'       => (clone $base)->where('status', 'finalized')->count(),
            'rejected'        => (clone $base)->where('status', 'rejected')->count(),
        ];

        $admins = $isSuperAdmin
            ? User::where('type', 'staff')
                  ->whereHas('roles', fn($q) => $q->whereIn('name', ['admin', 'super-admin']))
                  ->orderBy('name')->get()
            : collect();

        return view('admin.loans.index', compact('loans', 'stats', 'isSuperAdmin', 'admins'));
    }

    public function create()
    {
        $admin     = Auth::user();
        $myClients = $this->clientsForAdmin($admin);
        $templates  = $this->templatesForAdmin($admin);
        $currencies = Currency::codes();
        $annualRate = \App\Models\LoanSetting::current()->annual_rate;
        $financingTypes = LoanRequest::FINANCING_TYPES;

        return view('admin.loans.create', compact('myClients', 'templates', 'currencies', 'annualRate', 'financingTypes'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            // Client
            'client_mode'       => 'required|in:existing,new',
            'client_id'         => 'required_if:client_mode,existing|nullable|exists:users,id',
            'client_name'       => 'required_if:client_mode,new|nullable|string|max:255',
            'client_email'      => 'required_if:client_mode,new|nullable|email|unique:users,email',
            'client_phone'      => 'nullable|string|max:50',
            'client_address'    => 'nullable|string|max:500',
            'client_birth_date' => 'nullable|date',
            'client_id_type'    => 'nullable|string|max:30',
            'client_id_number'  => 'nullable|string|max:60',
            'client_date_delivre' => 'nullable|date',
            'client_tax_number' => 'nullable|string|max:60',
            'client_activity'   => 'nullable|string|max:255',
            'client_locale'     => 'nullable|in:fr,en,pl,es,bg,hu,it,de,lt,ro,lv,nl,pt,hr',
            'client_currency'   => 'nullable|string|max:10',
            // Prêt
            'amount'            => 'required|numeric|min:100',
            'darly'             => 'required|integer|min:1|max:360',
            'objet'             => 'nullable|string|max:255',
            'type_financement'  => 'nullable|in:' . implode(',', array_keys(LoanRequest::FINANCING_TYPES)),
            'subject'           => 'nullable|string|max:2000',
            'start_date'        => 'nullable|date',
            'currency'          => 'required|string|max:10',
            'admin_fees'        => 'nullable|numeric|min:0',
            'bank_account'      => 'nullable|string|max:255',
            'agent_suivi'       => 'nullable|string|max:255',
            'directeur'         => 'nullable|string|max:255',
            'notaire'           => 'nullable|string|max:255',
            'special_conditions'=> 'nullable|string',
            'contract_template_id' => 'nullable|exists:contract_templates,id',
            // Balises personnalisées du template (modale)
            'extra_fields'      => 'nullable|array',
            'extra_fields.*'    => 'nullable|string|max:500',
            // Fichiers joints au dossier
            'files'             => 'nullable|array|max:10',
            'files.*'           => 'nullable|file|mimes:pdf,jpg,jpeg,png,doc,docx,xls,xlsx|max:20480',
        ], [
            'client_email.unique' => 'Cet email est déjà utilisé dans le système. Passez en mode "Client existant" pour sélectionner ce client.',
            'client_name.required_if'  => 'Le nom du client est obligatoire pour un nouveau client.',
            'client_email.required_if' => 'L\'email du client est obligatoire pour un nouveau client.',
            'client_id.required_if'    => 'Veuillez sélectionner un client existant.',
            'amount.required'   => 'Le montant est obligatoire.',
            'darly.required'    => 'La durée est obligatoire.',
        ]);

        $admin = Auth::user();

        // Vérifier l'autorisation client existant avant la transaction
        if ($data['client_mode'] === 'existing') {
            $client = User::findOrFail($data['client_id']);
            if (!$admin->hasRole('super-admin')) {
                abort_unless($client->created_by === $admin->id, 403, 'Client non autorisé.');
            }
        }

        $annualRate = \App\Models\LoanSetting::current()->annual_rate;

        $calc = $this->loanService->calculateAll(
            (float) $data['amount'],
            (float) $annualRate,
            (int) $data['darly']
        );

        $loan = DB::transaction(
            function () use ($data, $admin, $calc, $annualRate) {
                if ($data['client_mode'] === 'new') {
                    $token  = Str::random(64);
                    $client = User::create([
                        'name'             => $data['client_name'],
                        'email'            => $data['client_email'],
                        'password'         => Hash::make(Str::random(32)),
                        'type'             => 'client',
                        'created_by'       => $admin->id,
                        'invitation_token' => $token,
                        'phone'            => $data['client_phone'] ?? null,
                        'address'          => $data['client_address'] ?? null,
                        'birth_date'       => $data['client_birth_date'] ?? null,
                        'id_type'          => $data['client_id_type'] ?? null,
                        'id_number'        => $data['client_id_number'] ?? null,
                        'date_delivre'     => $data['client_date_delivre'] ?? null,
                        'tax_number'       => $data['client_tax_number'] ?? null,
                        'activity'         => $data['client_activity'] ?? null,
                        'locale'           => $data['client_locale'] ?? 'fr',
                        'currency'         => $data['client_currency'] ?? $data['currency'],
                    ]);
                    $client->assignRole('client');
                    // L'email d'invitation n'est plus envoyé automatiquement ici.
                    // L'admin peut l'envoyer manuellement depuis la fiche client
                    // (bouton "Renvoyer l'invitation"), une fois le dossier prêt.
                } else {
                    $client = User::findOrFail($data['client_id']);
                }

                $locale = $client->locale ?? 'fr';

                $loan = LoanRequest::create([
                    'reference'            => LoanRequest::generateReference(),
                    'archive_ref'          => 'CR-ARCH-' . strtoupper(Str::random(8)),
                    'admin_id'             => $admin->id,
                    'client_id'            => $client->id,
                    'contract_template_id' => $data['contract_template_id'] ?? null,
                    'name'                 => $client->name,
                    'email'                => $client->email,
                    'phone'                => $client->phone ?? $data['client_phone'] ?? null,
                    'address'              => $client->address ?? $data['client_address'] ?? null,
                    'amount'               => $data['amount'],
                    'interest_rate'        => $annualRate,
                    'currency'             => $client->currency ?? $data['currency'],
                    'start_date'           => $data['start_date'] ?? now()->toDateString(),
                    'darly'                => $data['darly'],
                    'objet'                => $data['objet'] ?? null,
                    'type_financement'     => $data['type_financement'] ?? null,
                    'subject'              => $data['subject'] ?? null,
                    'special_conditions'   => $data['special_conditions'] ?? null,
                    'admin_fees'           => $data['admin_fees'] ?? null,
                    'bank_account'         => $data['bank_account'] ?? null,
                    'agent_suivi'          => $data['agent_suivi'] ?? null,
                    'directeur'            => $data['directeur'] ?? null,
                    'notaire'              => $data['notaire'] ?? null,
                    'monthly_payment'      => $calc['monthly_payment'],
                    'total_cost'           => $calc['total_cost'],
                    'total_with_interest'  => $calc['total_with_interest'],
                    'amortization_schedule'=> $calc['amortization_schedule'],
                    'contract_language'    => $locale,
                    'status'               => LoanRequest::STATUS_DRAFT,
                    'extra_fields'         => !empty($data['extra_fields']) ? $data['extra_fields'] : null,
                ]);

                $this->logHistory($loan, 'created', null, ['status' => $loan->status]);

                return $loan;
            }
        );

        return redirect()->route($this->panelPrefix().'.loans.show', $loan)
                         ->with('success', 'Dossier N°' . $loan->reference . ' créé (statut : Brouillon).');
    }

    public function show(LoanRequest $loan)
    {
        $this->authorizeAccess($loan);
        $loan->load(['client', 'admin', 'history.admin', 'contractTemplate']);
        $generatedDocs        = $loan->generatedDocuments()->with('generatedBy')->get();
        $notificationTemplate = NotificationTemplate::resolveForLoan($loan);
        $conditionsTemplate   = NotificationTemplate::resolveForLoan($loan, NotificationTemplate::TYPE_CONDITIONS);
        $insuranceTemplate    = NotificationTemplate::resolveForLoan($loan, NotificationTemplate::TYPE_INSURANCE);
        $isSuperAdmin  = Auth::user()->hasRole('super-admin');
        $admins        = $isSuperAdmin
            ? \App\Models\User::where('type', 'staff')
                ->whereHas('roles', fn($q) => $q->whereIn('name', ['admin', 'super-admin']))
                ->orderBy('name')->get()
            : collect();
        return view('admin.loans.show', compact('loan', 'generatedDocs', 'isSuperAdmin', 'admins', 'notificationTemplate', 'conditionsTemplate', 'insuranceTemplate'));
    }

    public function edit(LoanRequest $loan)
    {
        $this->authorizeAccess($loan);
        abort_unless($loan->isEditable(), 403, 'Cette demande ne peut plus être modifiée.');

        $admin     = Auth::user();
        $myClients = User::where('type', 'client')
                         ->whereHas('clientLoans', fn($q) => $q->where('admin_id', $admin->id))
                         ->orderBy('name')->get();
        $currencies = Currency::codes();
        $templates  = $this->templatesForAdmin($admin);
        $financingTypes = LoanRequest::FINANCING_TYPES;

        return view('admin.loans.edit', compact('loan', 'myClients', 'currencies', 'templates', 'financingTypes'));
    }

    public function update(Request $request, LoanRequest $loan)
    {
        $this->authorizeAccess($loan);
        abort_unless($loan->isEditable(), 403);

        $data = $request->validate([
            'amount'               => 'required|numeric|min:100',
            'darly'                => 'required|integer|min:1|max:360',
            'objet'                => 'nullable|string|max:255',
            'type_financement'     => 'nullable|in:' . implode(',', array_keys(LoanRequest::FINANCING_TYPES)),
            'subject'              => 'nullable|string|max:2000',
            'start_date'           => 'nullable|date',
            'currency'             => 'required|string|max:10',
            'admin_fees'            => 'nullable|numeric|min:0',
            'frais_assurance'       => 'nullable|numeric|min:0',
            'date_fin_assurance'    => 'nullable|date',
            'bank_account'          => 'nullable|string|max:255',
            'agent_suivi'           => 'nullable|string|max:255',
            'directeur'             => 'nullable|string|max:255',
            'notaire'               => 'nullable|string|max:255',
            'special_conditions'    => 'nullable|string',
            'contract_template_id'  => 'nullable|exists:contract_templates,id',
            'contract_language'     => 'nullable|in:fr,en,pl,es,bg,hu,it,de,lt,ro,lv,nl,pt,hr',
            'extra_fields'         => 'nullable|array',
            'extra_fields.*'       => 'nullable|string|max:500',
        ]);

        $old = $loan->only(['amount','darly','status','contract_template_id']);

        $calc = $this->loanService->calculateAll(
            (float) $data['amount'], (float) $loan->interest_rate, (int) $data['darly']
        );

        $loan->update(array_merge($data, [
            'monthly_payment'      => $calc['monthly_payment'],
            'total_cost'           => $calc['total_cost'],
            'total_with_interest'  => $calc['total_with_interest'],
            'amortization_schedule'=> $calc['amortization_schedule'],
            'contract_language'    => $data['contract_language'] ?? $loan->contract_language ?? 'fr',
            'extra_fields'         => !empty($data['extra_fields']) ? $data['extra_fields'] : null,
        ]));

        $this->logHistory($loan, 'updated', $old, $loan->only(['amount','darly','status','contract_template_id']));

        return redirect()->route($this->panelPrefix().'.loans.show', $loan)
                         ->with('success', 'Demande mise à jour.');
    }

    public function contractViewer(LoanRequest $loan)
    {
        $this->authorizeAccess($loan);
        if (!$loan->contract_pdf_path) {
            return back()->with('error', 'Aucun PDF de contrat disponible pour ce dossier.');
        }
        return view('admin.loans.contract-viewer', compact('loan'));
    }

    public function insuranceViewer(LoanRequest $loan)
    {
        $this->authorizeAccess($loan);
        if (!$loan->insurance_pdf_path) {
            return back()->with('error', 'Aucune attestation d\'assurance disponible pour ce dossier.');
        }
        $insuranceTemplate = NotificationTemplate::resolveForLoan($loan, NotificationTemplate::TYPE_INSURANCE);
        return view('admin.loans.insurance-viewer', compact('loan', 'insuranceTemplate'));
    }

    public function contract(LoanRequest $loan)
    {
        $this->authorizeAccess($loan);
        $templates             = $this->templatesForAdmin(Auth::user());
        $previewHtml           = $loan->contract_content ?? '';
        $variables             = app(\App\Services\ContractService::class)->variableDescriptions();
        $notificationTemplate  = NotificationTemplate::resolveForLoan($loan);
        $insuranceTemplate     = NotificationTemplate::resolveForLoan($loan, NotificationTemplate::TYPE_INSURANCE);
        return view('admin.loans.contract', compact('loan', 'templates', 'previewHtml', 'variables', 'notificationTemplate', 'insuranceTemplate'));
    }

    public function previewPdf(LoanRequest $loan)
    {
        $this->authorizeAccess($loan);

        if (!$loan->contract_pdf_path) {
            return back()->with('error', 'Aucun PDF uploadé pour ce dossier.');
        }

        $absPath = storage_path('app/private/' . $loan->contract_pdf_path);
        if (!file_exists($absPath)) {
            return back()->with('error', 'Fichier PDF introuvable sur le serveur.');
        }

        return response()->file($absPath, [
            'Content-Type'        => 'application/pdf',
            'Content-Disposition' => 'inline; filename="Contrat_' . $loan->reference . '.pdf"',
        ]);
    }

    public function uploadContractPdf(Request $request, LoanRequest $loan)
    {
        $this->authorizeAccess($loan);

        $request->validate([
            'contract_pdf' => 'required|file|mimes:pdf|max:20480',
        ], [
            'contract_pdf.required' => 'Veuillez sélectionner un fichier PDF.',
            'contract_pdf.mimes'    => 'Seuls les fichiers PDF sont acceptés.',
            'contract_pdf.max'      => 'Le fichier PDF ne doit pas dépasser 20 Mo.',
        ]);

        // Supprimer l'ancien PDF s'il existe
        if ($loan->contract_pdf_path) {
            $old = storage_path('app/private/' . $loan->contract_pdf_path);
            if (file_exists($old)) {
                @unlink($old);
            }
        }

        $file    = $request->file('contract_pdf');
        $relPath = 'contract-pdfs/' . $loan->id . '/' . $loan->reference . '.pdf';
        $absDir  = storage_path('app/private/contract-pdfs/' . $loan->id);

        if (!is_dir($absDir)) {
            mkdir($absDir, 0755, true);
        }

        $file->move($absDir, $loan->reference . '.pdf');

        $loan->update(['contract_pdf_path' => $relPath]);

        $this->logHistory($loan, 'pdf_uploaded', [], ['pdf' => $relPath]);

        return back()->with('success', 'PDF du contrat uploadé avec succès. Il sera joint à l\'email envoyé au client.');
    }

    public function previewInsurancePdf(LoanRequest $loan)
    {
        $this->authorizeAccess($loan);

        if (!$loan->insurance_pdf_path) {
            return back()->with('error', 'Aucune attestation d\'assurance uploadée pour ce dossier.');
        }

        $absPath = storage_path('app/private/' . $loan->insurance_pdf_path);
        if (!file_exists($absPath)) {
            return back()->with('error', 'Fichier d\'attestation introuvable sur le serveur.');
        }

        return response()->file($absPath, [
            'Content-Type'        => 'application/pdf',
            'Content-Disposition' => 'inline; filename="Assurance_' . $loan->reference . '.pdf"',
        ]);
    }

    public function uploadInsurancePdf(Request $request, LoanRequest $loan)
    {
        $this->authorizeAccess($loan);

        $request->validate([
            'insurance_pdf' => 'required|file|mimes:pdf|max:20480',
        ], [
            'insurance_pdf.required' => 'Veuillez sélectionner un fichier PDF.',
            'insurance_pdf.mimes'    => 'Seuls les fichiers PDF sont acceptés.',
            'insurance_pdf.max'      => 'Le fichier PDF ne doit pas dépasser 20 Mo.',
        ]);

        if ($loan->insurance_pdf_path) {
            $old = storage_path('app/private/' . $loan->insurance_pdf_path);
            if (file_exists($old)) {
                @unlink($old);
            }
        }

        $file    = $request->file('insurance_pdf');
        $relPath = 'insurance-pdfs/' . $loan->id . '/' . $loan->reference . '_assurance.pdf';
        $absDir  = storage_path('app/private/insurance-pdfs/' . $loan->id);

        if (!is_dir($absDir)) {
            mkdir($absDir, 0755, true);
        }

        $file->move($absDir, $loan->reference . '_assurance.pdf');

        $loan->update(['insurance_pdf_path' => $relPath]);

        $this->logHistory($loan, 'insurance_pdf_uploaded', [], ['pdf' => $relPath]);

        return back()->with('success', 'Attestation d\'assurance uploadée avec succès.');
    }

    public function sendInsuranceMail(LoanRequest $loan)
    {
        $this->authorizeAccess($loan);

        if (!$loan->insurance_pdf_path) {
            return back()->with('error', 'Générez d\'abord l\'attestation d\'assurance.');
        }

        $absPath = storage_path('app/private/' . $loan->insurance_pdf_path);
        if (!file_exists($absPath)) {
            return back()->with('error', 'Fichier d\'attestation introuvable sur le serveur.');
        }

        $locale   = $loan->contract_language ?? 'fr';
        $template = NotificationTemplate::resolveForLoan($loan, NotificationTemplate::TYPE_INSURANCE);

        if (!$template) {
            return back()->with('error', 'Aucun modèle d\'assurance n\'est configuré (langue ' . strtoupper($locale) . ' ni FR). Créez-en un depuis "Modèles de notification".');
        }

        $vars    = app(\App\Services\ContractService::class)->getVariables($loan);
        $subject = str_replace(array_keys($vars), array_values($vars), $template->subject);
        $body    = str_replace(array_keys($vars), array_values($vars), $template->content ?? '');

        Mail::to($loan->email)->send(new \App\Mail\InsuranceAttestationMail($loan, $subject, $body, $absPath));

        $this->logHistory($loan, 'insurance_sent', [], ['email' => $loan->email]);

        return back()->with('success', 'Attestation d\'assurance envoyée à ' . $loan->email . '.');
    }

    /**
     * Génère le DOCX de l'attestation d'assurance rempli pour ce dossier, à
     * partir du modèle assigné à la langue du dossier (résolu par langue,
     * comme les notifications et les conditions générales). L'admin le
     * convertit lui-même en PDF puis l'uploade via uploadInsurancePdf().
     */
    public function downloadInsuranceDocx(LoanRequest $loan)
    {
        $this->authorizeAccess($loan);

        $template = NotificationTemplate::resolveForLoan($loan, NotificationTemplate::TYPE_INSURANCE);

        if (!$template || !$template->hasDocxTemplate()) {
            return back()->with('error', 'Aucun template DOCX d\'assurance disponible pour la langue de ce dossier. Uploadez-en un depuis "Modèles de notification".');
        }

        $locale = $loan->contract_language ?? 'fr';

        try {
            $path = $this->notificationDocxService->generate($loan, $template, $locale);
        } catch (\Throwable $e) {
            return back()->with('error', 'Génération DOCX d\'assurance impossible : ' . $e->getMessage());
        }

        return response()->download($path, 'Assurance_' . $loan->reference . '.docx');
    }

    public function downloadDocx(LoanRequest $loan, DocumentArchive $archive)
    {
        $this->authorizeAccess($loan);

        $template = $loan->contractTemplate
            ?? ContractTemplate::where('is_default', true)->first();

        if (!$template || !$template->hasDocxTemplate()) {
            return back()->with('error', 'Aucun template DOCX disponible pour ce dossier. Uploadez un template DOCX depuis la gestion des modèles.');
        }

        $locale = $loan->contract_language ?? 'fr';

        try {
            $path = $archive->getOrGenerate($loan, $template, $locale);
        } catch (\Throwable $e) {
            return back()->with('error', 'Génération DOCX impossible : ' . $e->getMessage());
        }

        return response()->download($path, 'Contrat_' . $loan->reference . '.docx');
    }

    public function updateContract(Request $request, LoanRequest $loan)
    {
        $this->authorizeAccess($loan);
        $data = $request->validate(['contract_content' => 'required|string']);

        $old = ['contract_content' => substr($loan->contract_content ?? '', 0, 100)];
        $loan->update(['contract_content' => $data['contract_content']]);
        $this->logHistory($loan, 'contract_edited', $old, ['contract_content' => substr($data['contract_content'], 0, 100)]);

        return back()->with('success', 'Contrat enregistré.');
    }

    public function validateLoan(LoanRequest $loan)
    {
        $this->authorizeAccess($loan);
        abort_unless($loan->canBeValidated(), 403, 'Cette demande ne peut pas être validée.');

        if ($error = $this->sendValidationNotification($loan)) {
            return back()->with('error', $error);
        }

        return redirect()->route($this->panelPrefix().'.loans.show', $loan)
            ->with('success', 'Dossier validé — notification envoyée à ' . $this->recipientEmail($loan) . '.');
    }

    public function sendContract(LoanRequest $loan)
    {
        $this->authorizeAccess($loan);
        abort_unless($loan->canSendContract(), 403, 'Le contrat ne peut être envoyé que pour un dossier validé.');

        if ($error = $this->sendContractStep($loan)) {
            return back()->with('error', $error);
        }

        return redirect()->route($this->panelPrefix().'.loans.show', $loan)
            ->with('success', 'Contrat envoyé à ' . $this->recipientEmail($loan) . '.');
    }

    /**
     * Envoie le mail de notification (modèle sélectionné selon la langue du client)
     * et passe le dossier au statut "validated". Retourne un message d'erreur si
     * l'envoi n'a pas pu avoir lieu, ou null en cas de succès.
     */
    private function sendValidationNotification(LoanRequest $loan): ?string
    {
        // ── Bloquer si le document de notification (PDF) n'est pas encore uploadé ─
        $notificationPdfAbs = $loan->notification_pdf_path
            ? storage_path('app/private/' . $loan->notification_pdf_path)
            : null;

        if (!$notificationPdfAbs || !file_exists($notificationPdfAbs)) {
            return 'Impossible de valider : aucun document de notification n\'a été uploadé pour ce dossier. '
                . 'Générez le DOCX, convertissez-le en PDF et uploadez-le (section "Documents").';
        }

        $locale   = $loan->contract_language ?? 'fr';
        $template = NotificationTemplate::resolveForLoan($loan);

        if (!$template) {
            return 'Impossible de valider : aucun modèle de notification n\'est configuré (langue '
                . strtoupper($locale) . ' ni FR). Créez-en un depuis "Modèles de notification".';
        }

        $vars      = app(\App\Services\ContractService::class)->getVariables($loan);
        $subject   = str_replace(array_keys($vars), array_values($vars), $template->subject);
        $body      = str_replace(array_keys($vars), array_values($vars), $template->content ?? '');
        $recipient = $this->recipientEmail($loan);

        // ── Tableau d'amortissement (pro forma) joint à la notification, dans la langue du dossier ─
        $amortPdfPath = null;
        try {
            $amortPdfPath = $this->pdfService->generateAmortizationPdf($loan, $locale);
        } catch (\Throwable $e) {
            Log::warning('Amortization PDF generation failed for ' . $loan->reference . ': ' . $e->getMessage());
            // L email partait sans le tableau d amortissement sans que personne ne le sache :
            // l admin voyait un simple "Contrat envoye". On le signale desormais.
            session()->flash('warning', "Le tableau d'amortissement n'a pas pu etre genere : l'email est parti sans cette piece jointe.");
        }

        try {
            Mail::to($recipient)->send(
                new LoanValidationNotificationMail($loan, $subject, $body, $notificationPdfAbs, $amortPdfPath ?? '')
            );
        } catch (\Throwable $e) {
            Log::error('LoanValidationNotificationMail failed for ' . $loan->reference . ': ' . $e->getMessage());
            return 'Erreur lors de l\'envoi de la notification : ' . $e->getMessage();
        } finally {
            if ($amortPdfPath && file_exists($amortPdfPath)) {
                @unlink($amortPdfPath);
            }
        }

        $old = ['status' => $loan->status];
        $loan->update([
            'status'       => LoanRequest::STATUS_VALIDATED,
            'validated_at' => now(),
        ]);

        $this->logHistory($loan, 'validated', $old, ['status' => $loan->status, 'locale' => $locale, 'recipient' => $recipient]);

        return null;
    }

    /**
     * Reprend la logique historique de validation complète : génère le tableau
     * d'amortissement, envoie le contrat (LoanValidatedMail) et passe le dossier
     * au statut "contract_sent". Retourne un message d'erreur ou null en cas de succès.
     */
    private function sendContractStep(LoanRequest $loan): ?string
    {
        $contractPdfAbs = $loan->contract_pdf_path
            ? storage_path('app/private/' . $loan->contract_pdf_path)
            : null;

        if (!$contractPdfAbs || !file_exists($contractPdfAbs)) {
            return 'Impossible d\'envoyer le contrat : aucun contrat PDF n\'a été uploadé pour ce dossier.';
        }

        $content = $this->resolveContractSentContent($loan);
        if (!$content) {
            $locale = strtoupper($loan->contract_language ?? 'fr');
            return "Impossible d'envoyer le contrat : aucun modèle d'email \"Contrat envoyé\" n'est configuré (langue $locale ni FR). Créez-en un depuis \"Modèles de notification\".";
        }

        $old       = ['status' => $loan->status];
        $locale    = $loan->contract_language ?? 'fr';
        $recipient = $this->recipientEmail($loan);

        // ── Générer le tableau d'amortissement en PDF ─────────────────────
        set_time_limit(180);
        $amortPdfPath = null;
        try {
            $amortPdfPath = $this->pdfService->generateAmortizationPdf($loan, $locale);
        } catch (\Throwable $e) {
            Log::warning('Amortization PDF generation failed for ' . $loan->reference . ': ' . $e->getMessage());
            // L email partait sans le tableau d amortissement sans que personne ne le sache :
            // l admin voyait un simple "Contrat envoye". On le signale desormais.
            session()->flash('warning', "Le tableau d'amortissement n'a pas pu etre genere : l'email est parti sans cette piece jointe.");
        }

        // ── Conditions générales : PDF uploadé pour ce dossier (comme le contrat) ──
        $conditionsPdfAbs = $loan->conditions_pdf_path
            ? storage_path('app/private/' . $loan->conditions_pdf_path)
            : null;
        if ($conditionsPdfAbs && !file_exists($conditionsPdfAbs)) {
            $conditionsPdfAbs = null;
        }

        // ── Envoyer l'email dans la langue du client ──────────────────────
        $mailError = null;
        try {
            Mail::to($recipient)->send(
                new LoanValidatedMail($loan, $content['subject'], $content['body'], $contractPdfAbs, $amortPdfPath ?? '', $conditionsPdfAbs ?? '')
            );
        } catch (\Throwable $e) {
            Log::error('LoanValidatedMail failed for ' . $loan->reference . ': ' . $e->getMessage());
            $mailError = $e->getMessage();
        } finally {
            if ($amortPdfPath && file_exists($amortPdfPath)) {
                @unlink($amortPdfPath);
            }
        }

        // L envoi ayant echoue, on NE passe PAS le dossier en "contrat envoye" : il
        // etait marque comme tel alors que le client n avait rien recu, et l admin
        // voyait un message de succes.
        if ($mailError !== null) {
            return "L'email n'a pas pu etre envoye : " . $mailError;
        }

        // ── Passer au statut contract_sent ────────────────────────────────
        $loan->update([
            'status'  => LoanRequest::STATUS_CONTRACT_SENT,
            'sent_at' => now(),
        ]);

        $this->logHistory($loan, 'validated_and_sent', $old, ['status' => $loan->status, 'locale' => $locale, 'recipient' => $recipient]);

        // Notification in-app au client
        if ($loan->client_id) {
            ClientNotification::notifyUser(
                $loan->client,
                'loan_update',
                'app.notif_loan_contract',
                'app.notif_loan_contract_body',
                ['reference' => $loan->reference],
                ['loan_id' => $loan->id, 'reference' => $loan->reference]
            );
        }

        return null;
    }

    /**
     * Résout le sujet et le corps HTML de l'email "contrat envoyé" à partir du
     * modèle configuré pour la langue du dossier. Retourne null si aucun modèle
     * n'est configuré (ni pour la langue du dossier, ni en repli FR).
     */
    private function resolveContractSentContent(LoanRequest $loan): ?array
    {
        $template = NotificationTemplate::resolveForLoan($loan, NotificationTemplate::TYPE_CONTRACT_SENT);
        if (!$template) {
            return null;
        }

        $vars = app(\App\Services\ContractService::class)->getVariables($loan);

        return [
            'subject' => str_replace(array_keys($vars), array_values($vars), $template->subject),
            'body'    => str_replace(array_keys($vars), array_values($vars), $template->content ?? ''),
        ];
    }

    /**
     * Génère le DOCX des conditions générales rempli pour ce dossier, à partir
     * du modèle assigné à la langue du dossier (repli FR géré par
     * resolveForLoan). L'admin le convertit lui-même en PDF puis l'uploade
     * via uploadConditionsPdf() — même flux que le document de notification.
     */
    public function downloadConditionsDocx(LoanRequest $loan)
    {
        $this->authorizeAccess($loan);

        $template = NotificationTemplate::resolveForLoan($loan, NotificationTemplate::TYPE_CONDITIONS);

        if (!$template || !$template->hasDocxTemplate()) {
            return back()->with('error', 'Aucun template DOCX de conditions générales disponible pour la langue de ce dossier. Uploadez-en un depuis "Modèles de notification".');
        }

        $locale = $loan->contract_language ?? 'fr';

        try {
            $path = $this->notificationDocxService->generate($loan, $template, $locale);
        } catch (\Throwable $e) {
            return back()->with('error', 'Génération DOCX des conditions générales impossible : ' . $e->getMessage());
        }

        return response()->download($path, 'Conditions_' . $loan->reference . '.docx');
    }

    /**
     * Upload la version PDF des conditions générales pour ce dossier, une fois
     * le DOCX (ci-dessus) converti manuellement par l'admin — comme pour le
     * contrat, l'assurance et le document de notification.
     */
    public function uploadConditionsPdf(Request $request, LoanRequest $loan)
    {
        $this->authorizeAccess($loan);

        $request->validate([
            'conditions_pdf' => 'required|file|mimes:pdf|max:20480',
        ], [
            'conditions_pdf.required' => 'Veuillez sélectionner un fichier PDF.',
            'conditions_pdf.mimes'    => 'Seuls les fichiers PDF sont acceptés.',
            'conditions_pdf.max'      => 'Le fichier PDF ne doit pas dépasser 20 Mo.',
        ]);

        if ($loan->conditions_pdf_path) {
            $old = storage_path('app/private/' . $loan->conditions_pdf_path);
            if (file_exists($old)) {
                @unlink($old);
            }
        }

        $file    = $request->file('conditions_pdf');
        $relPath = 'conditions-pdfs/' . $loan->id . '/' . $loan->reference . '_conditions.pdf';
        $absDir  = storage_path('app/private/conditions-pdfs/' . $loan->id);

        if (!is_dir($absDir)) {
            mkdir($absDir, 0755, true);
        }

        $file->move($absDir, $loan->reference . '_conditions.pdf');

        $loan->update(['conditions_pdf_path' => $relPath]);

        $this->logHistory($loan, 'conditions_pdf_uploaded', [], ['pdf' => $relPath]);

        return back()->with('success', 'PDF des conditions générales uploadé avec succès.');
    }

    /**
     * Affiche le PDF des conditions générales uploadé pour ce dossier.
     */
    public function previewConditionsPdf(LoanRequest $loan)
    {
        $this->authorizeAccess($loan);

        if (!$loan->conditions_pdf_path) {
            return back()->with('error', 'Aucun PDF de conditions générales uploadé pour ce dossier.');
        }

        $absPath = storage_path('app/private/' . $loan->conditions_pdf_path);
        if (!file_exists($absPath)) {
            return back()->with('error', 'Fichier PDF introuvable sur le serveur.');
        }

        return response()->file($absPath, [
            'Content-Type'        => 'application/pdf',
            'Content-Disposition' => 'inline; filename="Conditions_' . $loan->reference . '.pdf"',
        ]);
    }

    public function downloadNotificationDocx(LoanRequest $loan)
    {
        $this->authorizeAccess($loan);

        $template = NotificationTemplate::resolveForLoan($loan);

        if (!$template || !$template->hasDocxTemplate()) {
            return back()->with('error', 'Aucun template DOCX de notification disponible pour la langue de ce dossier. Uploadez-en un depuis "Modèles de notification".');
        }

        $locale = $loan->contract_language ?? 'fr';

        try {
            $path = $this->notificationDocxService->generate($loan, $template, $locale);
        } catch (\Throwable $e) {
            return back()->with('error', 'Génération DOCX de notification impossible : ' . $e->getMessage());
        }

        return response()->download($path, 'Notification_' . $loan->reference . '.docx');
    }

    public function uploadNotificationPdf(Request $request, LoanRequest $loan)
    {
        $this->authorizeAccess($loan);

        $request->validate([
            'notification_pdf' => 'required|file|mimes:pdf|max:20480',
        ], [
            'notification_pdf.required' => 'Veuillez sélectionner un fichier PDF.',
            'notification_pdf.mimes'    => 'Seuls les fichiers PDF sont acceptés.',
            'notification_pdf.max'      => 'Le fichier PDF ne doit pas dépasser 20 Mo.',
        ]);

        if ($loan->notification_pdf_path) {
            $old = storage_path('app/private/' . $loan->notification_pdf_path);
            if (file_exists($old)) {
                @unlink($old);
            }
        }

        $file    = $request->file('notification_pdf');
        $relPath = 'notification-pdfs/' . $loan->id . '/' . $loan->reference . '_notification.pdf';
        $absDir  = storage_path('app/private/notification-pdfs/' . $loan->id);

        if (!is_dir($absDir)) {
            mkdir($absDir, 0755, true);
        }

        $file->move($absDir, $loan->reference . '_notification.pdf');

        $loan->update(['notification_pdf_path' => $relPath]);

        $this->logHistory($loan, 'notification_pdf_uploaded', [], ['pdf' => $relPath]);

        return back()->with('success', 'Document de notification uploadé avec succès. Il débloque le bouton "Valider".');
    }

    /**
     * Telecharge le tableau d'amortissement en PDF.
     *
     * Le document etait jusqu'ici uniquement genere pour etre joint aux emails
     * (envoi du contrat, relance). L'admin n'avait aucun moyen de le recuperer
     * depuis le dossier : il devait renvoyer un email pour le voir.
     */
    public function downloadAmortizationPdf(LoanRequest $loan)
    {
        $this->authorizeAccess($loan);

        if (empty($loan->amortization_schedule)) {
            return back()->with('error', "Ce dossier n'a pas de tableau d'amortissement calcule.");
        }

        $locale = $loan->contract_language ?? 'fr';

        // Meme budget de temps que lors de l'envoi du contrat : un echeancier de
        // 120 lignes prend quelques secondes a rendre.
        set_time_limit(180);

        try {
            $absPath = $this->pdfService->generateAmortizationPdf($loan, $locale);
        } catch (\Throwable $e) {
            Log::error('Amortization PDF download failed for ' . $loan->reference . ': ' . $e->getMessage());
            return back()->with('error', "Le tableau d'amortissement n'a pas pu etre genere.");
        }

        if (!file_exists($absPath)) {
            return back()->with('error', 'Fichier PDF introuvable sur le serveur.');
        }

        return response()->download($absPath, $loan->documentFileName('amortization'), [
            'Content-Type' => 'application/pdf',
        ]);
    }

    public function previewNotificationPdf(LoanRequest $loan)
    {
        $this->authorizeAccess($loan);

        if (!$loan->notification_pdf_path) {
            return back()->with('error', 'Aucun document de notification uploadé pour ce dossier.');
        }

        $absPath = storage_path('app/private/' . $loan->notification_pdf_path);
        if (!file_exists($absPath)) {
            return back()->with('error', 'Fichier PDF introuvable sur le serveur.');
        }

        return response()->file($absPath, [
            'Content-Type'        => 'application/pdf',
            'Content-Disposition' => 'inline; filename="Notification_' . $loan->reference . '.pdf"',
        ]);
    }

    public function resendContractEmail(LoanRequest $loan)
    {
        $this->authorizeAccess($loan);

        if (!$loan->contract_pdf_path) {
            return back()->with('error', 'Aucun PDF uploadé pour ce dossier. Uploadez le PDF avant de renvoyer l\'email.');
        }

        $pdfAbs = storage_path('app/private/' . $loan->contract_pdf_path);

        if (!file_exists($pdfAbs)) {
            return back()->with('error', 'Fichier PDF introuvable sur le serveur.');
        }

        $content = $this->resolveContractSentContent($loan);
        if (!$content) {
            $locale = strtoupper($loan->contract_language ?? 'fr');
            return back()->with('error', "Aucun modèle d'email \"Contrat envoyé\" n'est configuré (langue $locale ni FR).");
        }

        $recipient = $this->recipientEmail($loan);
        $locale    = $loan->contract_language ?? 'fr';

        // ── Régénérer le tableau d'amortissement, comme lors de l'envoi initial ─
        set_time_limit(180);
        $amortPdfPath = null;
        try {
            $amortPdfPath = $this->pdfService->generateAmortizationPdf($loan, $locale);
        } catch (\Throwable $e) {
            Log::warning('Amortization PDF generation failed for ' . $loan->reference . ': ' . $e->getMessage());
            // L email partait sans le tableau d amortissement sans que personne ne le sache :
            // l admin voyait un simple "Contrat envoye". On le signale desormais.
            session()->flash('warning', "Le tableau d'amortissement n'a pas pu etre genere : l'email est parti sans cette piece jointe.");
        }

        // ── Conditions générales : PDF uploadé pour ce dossier, comme lors de l'envoi initial ─
        $conditionsPdfAbs = $loan->conditions_pdf_path
            ? storage_path('app/private/' . $loan->conditions_pdf_path)
            : null;
        if ($conditionsPdfAbs && !file_exists($conditionsPdfAbs)) {
            $conditionsPdfAbs = null;
        }

        try {
            Mail::to($recipient)->send(
                new LoanValidatedMail($loan, $content['subject'], $content['body'], $pdfAbs, $amortPdfPath ?? '', $conditionsPdfAbs ?? '')
            );
        } catch (\Throwable $e) {
            Log::error('resendContractEmail failed for ' . $loan->reference . ': ' . $e->getMessage());
            return back()->with('error', 'Erreur lors de l\'envoi de l\'email : ' . $e->getMessage());
        } finally {
            if ($amortPdfPath && file_exists($amortPdfPath)) {
                @unlink($amortPdfPath);
            }
        }

        $this->logHistory($loan, 'contract_edited', [], ['action' => 'email_with_pdf_resent', 'recipient' => $recipient]);

        return back()->with('success', 'Email avec le PDF du contrat renvoyé à ' . $recipient . '.');
    }

    public function markSigned(LoanRequest $loan)
    {
        $this->authorizeAccess($loan);

        $old = ['status' => $loan->status];
        $loan->update([
            'status'              => LoanRequest::STATUS_CONTRACT_SIGNED,
            'signed_received_at'  => now(),
        ]);

        $locale    = $loan->contract_language ?? 'fr';
        $recipient = $this->recipientEmail($loan);
        $mailSent  = true;
        try {
            Mail::to($recipient)->send(new SignedContractAcknowledgementMail($loan, $locale));
        } catch (\Throwable $e) {
            Log::error('SignedContractAcknowledgementMail failed for ' . $loan->reference . ': ' . $e->getMessage());
            $mailSent = false;
        }

        if ($loan->client_id) {
            ClientNotification::notifyUser(
                $loan->client,
                'loan_update',
                'app.notif_loan_signed',
                'app.notif_loan_signed_body',
                ['reference' => $loan->reference],
                ['loan_id' => $loan->id, 'reference' => $loan->reference]
            );
        }

        $this->logHistory($loan, 'signed_received', $old, ['status' => $loan->status]);

        $msg = 'Contrat signé marqué comme reçu.';
        $msg .= $mailSent ? ' Email envoyé au client.' : ' (Email non envoyé — vérifiez la configuration mail.)';

        return back()->with('success', $msg);
    }

    public function updateStatus(Request $request, LoanRequest $loan)
    {
        $this->authorizeAccess($loan);
        $data = $request->validate([
            'status' => 'required|in:' . implode(',', LoanRequest::STATUSES),
        ]);

        $old = ['status' => $loan->status];

        // ── Passage en "validé" : envoie la notification (modèle selon la langue) ─
        if ($data['status'] === LoanRequest::STATUS_VALIDATED && $old['status'] !== LoanRequest::STATUS_VALIDATED) {
            if ($error = $this->sendValidationNotification($loan)) {
                return back()->with('error', $error);
            }

            return redirect()->route($this->panelPrefix().'.loans.show', $loan)
                ->with('success', 'Dossier validé — notification envoyée à ' . $this->recipientEmail($loan) . '.');
        }

        // ── Passage en "contrat envoyé" : tableau d'amortissement + LoanValidatedMail ─
        if ($data['status'] === LoanRequest::STATUS_CONTRACT_SENT && $old['status'] !== LoanRequest::STATUS_CONTRACT_SENT) {
            if ($error = $this->sendContractStep($loan)) {
                return back()->with('error', $error);
            }

            return redirect()->route($this->panelPrefix().'.loans.show', $loan)
                ->with('success', 'Contrat envoyé à ' . $this->recipientEmail($loan) . '.');
        }

        // ── La finalisation passe obligatoirement par le bouton dédié : elle
        // implique un email et un choix explicite de crédit du compte, ce que
        // ce sélecteur générique ne permet pas de collecter.
        if ($data['status'] === LoanRequest::STATUS_FINALIZED && $old['status'] !== LoanRequest::STATUS_FINALIZED) {
            return back()->with('error', 'Utilisez le bouton "Finaliser le dossier" pour finaliser (il permet de choisir si le compte client doit être crédité).');
        }

        // ── Le rejet passe obligatoirement par le bouton dédié : il exige un
        // motif et envoie un email au client, ce que ce sélecteur ne permet pas.
        if ($data['status'] === LoanRequest::STATUS_REJECTED && $old['status'] !== LoanRequest::STATUS_REJECTED) {
            return back()->with('error', 'Utilisez le bouton "Rejeter le dossier" pour rejeter (il permet de saisir le motif envoyé au client).');
        }

        // ── Autres changements de statut ──────────────────────────────────
        DB::transaction(function () use ($loan, $data, $old) {
            $loan->update(['status' => $data['status']]);
            $this->logHistory($loan, 'status_changed', $old, ['status' => $data['status']]);
        });

        $loan->refresh();

        return back()->with('success', 'Statut mis à jour.');
    }

    /**
     * Finalise un dossier (statut "contract_signed" → "finalized") : envoie un
     * email de confirmation au client et, si demandé par l'admin, crédite son
     * compte du montant du prêt (avec traçabilité via AccountMovement).
     */
    public function finalizeLoan(Request $request, LoanRequest $loan)
    {
        $this->authorizeAccess($loan);
        abort_unless($loan->canFinalize(), 403, 'Le dossier ne peut être finalisé qu\'après réception du contrat signé.');

        $data            = $request->validate(['credit_account' => 'nullable|boolean']);
        $creditRequested = (bool) ($data['credit_account'] ?? false);

        $old              = ['status' => $loan->status];
        $credited         = false;
        $alreadyFinalized = false;

        DB::transaction(function () use ($loan, $old, $creditRequested, &$credited, &$alreadyFinalized) {
            // Verrou pessimiste pour éviter double-crédit en cas de double-clic
            $fresh = LoanRequest::lockForUpdate()->find($loan->id);
            if ($fresh->status === LoanRequest::STATUS_FINALIZED) {
                $alreadyFinalized = true;
                return;
            }

            $fresh->update([
                'status'       => LoanRequest::STATUS_FINALIZED,
                'finalized_at' => now(),
            ]);

            $cur = $fresh->currency ?? Currency::default();

            if ($creditRequested && $fresh->client_id) {
                $before = (float) $fresh->client->balance;
                $fresh->client->increment('balance', (float) $fresh->amount);

                AccountMovement::create([
                    'user_id'        => $fresh->client_id,
                    'admin_id'       => Auth::id(),
                    'type'           => 'credit',
                    'amount'         => $fresh->amount,
                    'currency'       => $cur,
                    'balance_before' => $before,
                    'balance_after'  => $before + (float) $fresh->amount,
                    'note'           => 'Déboursement prêt ' . $fresh->reference,
                ]);

                $credited = true;

                ClientNotification::notifyUser(
                    $fresh->client,
                    'credit',
                    'app.notif_loan_funded',
                    'app.notif_loan_funded_body',
                    ['amount' => number_format((float) $fresh->amount, 2, ',', ' '), 'currency' => $cur],
                    ['loan_id' => $fresh->id, 'amount' => $fresh->amount, 'currency' => $cur]
                );
            } elseif ($fresh->client_id) {
                ClientNotification::notifyUser(
                    $fresh->client,
                    'loan_update',
                    'app.notif_loan_finalized',
                    'app.notif_loan_finalized_body',
                    ['reference' => $fresh->reference],
                    ['loan_id' => $fresh->id]
                );
            }

            $this->logHistory($fresh, 'finalized', $old, ['status' => $fresh->status, 'credited' => $credited]);
        });

        if ($alreadyFinalized) {
            return back()->with('error', 'Ce dossier est déjà finalisé.');
        }

        $loan->refresh();

        $recipient = $this->recipientEmail($loan);
        $locale    = $loan->contract_language ?? 'fr';
        $mailSent  = true;
        try {
            Mail::to($recipient)->send(new LoanFinalizedMail($loan, $credited, $locale));
        } catch (\Throwable $e) {
            Log::error('LoanFinalizedMail failed for ' . $loan->reference . ': ' . $e->getMessage());
            $mailSent = false;
        }

        $msg = 'Dossier finalisé' . ($credited ? ' — compte client crédité.' : '.');
        $msg .= $mailSent ? ' Email envoyé au client.' : ' (Email non envoyé — vérifiez la configuration mail.)';

        return back()->with('success', $msg);
    }

    /**
     * Rejette le dossier avec un motif obligatoire, et envoie un email au
     * client dans la langue du dossier incluant ce motif et un lien vers la
     * page "prochaines étapes".
     */
    public function rejectLoan(Request $request, LoanRequest $loan)
    {
        $this->authorizeAccess($loan);

        $data = $request->validate([
            'rejection_reason' => 'required|string|max:2000',
        ]);

        $old = ['status' => $loan->status];

        $loan->update([
            'status'           => LoanRequest::STATUS_REJECTED,
            'rejected_at'      => now(),
            'rejection_reason' => $data['rejection_reason'],
        ]);

        if ($loan->client_id) {
            ClientNotification::notifyUser(
                $loan->client,
                'loan_update',
                'app.notif_loan_rejected',
                'app.notif_loan_rejected_body',
                ['reference' => $loan->reference],
                ['loan_id' => $loan->id]
            );
        }

        $this->logHistory($loan, 'rejected', $old, ['status' => $loan->status, 'reason' => $data['rejection_reason']]);

        $mailSent = true;
        if ($loan->client_id) {
            try {
                Mail::to($this->recipientEmail($loan))->send(new LoanRejectedMail($loan, $data['rejection_reason']));
            } catch (\Throwable $e) {
                Log::error('LoanRejectedMail failed for ' . $loan->reference . ': ' . $e->getMessage());
                $mailSent = false;
            }
        }

        $msg = 'Dossier rejeté.';
        $msg .= $mailSent ? ' Email envoyé au client.' : ' (Email non envoyé — vérifiez la configuration mail.)';

        return back()->with('success', $msg);
    }

    public function destroy(LoanRequest $loan)
    {
        $this->authorizeAccess($loan);
        $loan->delete();
        return back()->with('success', 'Demande supprimée.');
    }

    public function assignAdmin(Request $request, LoanRequest $loan)
    {
        abort_unless(Auth::user()->hasRole('super-admin'), 403);

        $data = $request->validate([
            'admin_id' => 'required|exists:users,id',
        ]);

        $admin = \App\Models\User::findOrFail($data['admin_id']);
        abort_unless(
            $admin->hasRole('admin') || $admin->hasRole('super-admin'),
            422,
            'L\'utilisateur sélectionné n\'est pas un administrateur.'
        );

        $old = ['admin_id' => $loan->admin_id, 'admin_name' => $loan->admin?->name];
        $loan->update(['admin_id' => $admin->id]);
        $this->logHistory($loan, 'admin_assigned', $old, ['admin_id' => $admin->id, 'admin_name' => $admin->name]);

        return back()->with('success', "Dossier réaffecté à {$admin->name}.");
    }

    private function clientsForAdmin(\App\Models\User $admin): \Illuminate\Support\Collection
    {
        if ($admin->hasRole('super-admin')) {
            return User::where('type', 'client')->orderBy('name')->get();
        }
        return User::where('type', 'client')
                   ->where('created_by', $admin->id)
                   ->orderBy('name')->get();
    }

    private function templatesForAdmin(\App\Models\User $admin): \Illuminate\Support\Collection
    {
        if ($admin->hasRole('super-admin')) {
            return ContractTemplate::orderBy('name')->get();
        }
        $assigned = $admin->assignedTemplates()->orderBy('name')->get();
        if ($assigned->isEmpty()) {
            return ContractTemplate::where('is_default', true)->get();
        }
        return $assigned;
    }

    private function authorizeAccess(LoanRequest $loan): void
    {
        $user = Auth::user();
        if ($user->hasRole('super-admin')) return;
        abort_unless($loan->admin_id === $user->id, 403, 'Accès non autorisé.');
    }

    /**
     * Préfixe de route ('admin' ou 'super-admin') selon le panneau depuis lequel
     * la requête courante a été faite — pour rediriger vers le bon contexte.
     */
    private function panelPrefix(): string
    {
        return request()->routeIs('super-admin.*') ? 'super-admin' : 'admin';
    }

    private function logHistory(LoanRequest $loan, string $action, ?array $old, ?array $new): void
    {
        LoanHistory::create([
            'loan_request_id' => $loan->id,
            'admin_id'        => Auth::id(),
            'action'          => $action,
            'old_value'       => $old,
            'new_value'       => $new,
        ]);
    }

    /**
     * Retourne l'email actuel du client lié au dossier.
     * Priorité : email du compte User (toujours à jour) → email copié sur le dossier.
     */
    private function recipientEmail(LoanRequest $loan): string
    {
        return $loan->client?->email ?? $loan->email;
    }
}
