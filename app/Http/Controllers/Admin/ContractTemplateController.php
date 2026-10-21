<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContractTemplate;
use App\Models\User;
use App\Services\ContractDocxRenderer;
use App\Services\ContractHtmlService;
use App\Services\ContractService;
use App\Services\DocxTemplateManager;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ContractTemplateController extends Controller
{
    public function __construct(
        private ContractService      $contractService,
        private ContractHtmlService  $htmlService,
        private DocxTemplateManager  $docxManager,
        private ContractDocxRenderer $docxRenderer,
    ) {}

    public function index(Request $request)
    {
        $user = Auth::user();
        if ($user->hasRole('super-admin')) {
            $query = ContractTemplate::with('creator', 'assignedAdmins')->latest();
        } else {
            $query = $user->assignedTemplates()->with('creator')->latest();
        }

        // Le compteur affiche en tete doit porter sur TOUS les modeles, pas sur la
        // page courante : on le calcule avant de paginer.
        $totalTemplates = (clone $query)->count();
        $templates      = $query->paginate(15)->appends($request->query());

        return view('admin.contract-templates.index', compact('templates', 'totalTemplates'));
    }

    public function create()
    {
        return view('admin.contract-templates.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name'       => 'required|string|max:255',
            'is_default' => 'boolean',
            'locale'     => 'nullable|in:fr,en,pl,es,bg,hu,it,de,lt,ro,lv,nl,pt,hr',
        ]);

        // Le modèle par défaut a un impact global (utilisé pour tout dossier sans
        // modèle explicite) — réservé au super-admin.
        $isDefault = $data['is_default'] ?? false;
        if ($isDefault && !Auth::user()->hasRole('super-admin')) {
            $isDefault = false;
        }

        if ($isDefault) {
            ContractTemplate::where('is_default', true)->update(['is_default' => false]);
        }

        ContractTemplate::create([
            'name'          => $data['name'],
            'content'       => '',
            'is_default'    => $isDefault,
            'template_type' => 'docx',
            'locale'        => $data['locale'] ?? null,
            'created_by'    => Auth::id(),
        ]);

        return redirect()->route('admin.contract-templates.index')
                         ->with('success', 'Modèle créé. Uploadez maintenant votre fichier .docx.');
    }

    public function edit(ContractTemplate $contractTemplate)
    {
        $this->authorizeTemplate($contractTemplate);

        $variables = $this->variablesList();

        $admins = Auth::user()->hasRole('super-admin')
            ? User::whereHas('roles', fn($q) => $q->where('name', 'admin'))->orderBy('name')->get()
            : collect();
        $assignedIds = $contractTemplate->assignedAdmins()->pluck('users.id')->toArray();

        return view('admin.contract-templates.edit', [
            'template'    => $contractTemplate,
            'variables'   => $variables,
            'admins'      => $admins,
            'assignedIds' => $assignedIds,
        ]);
    }

    public function update(Request $request, ContractTemplate $contractTemplate)
    {
        $this->authorizeTemplate($contractTemplate);

        $data = $request->validate([
            'name'       => 'required|string|max:255',
            'is_default' => 'boolean',
            'locale'     => 'nullable|in:fr,en,pl,es,bg,hu,it,de,lt,ro,lv,nl,pt,hr',
        ]);

        $isSuperAdmin = Auth::user()->hasRole('super-admin');
        $isDefault    = $isSuperAdmin ? ($data['is_default'] ?? false) : $contractTemplate->is_default;

        if ($isSuperAdmin && $isDefault) {
            ContractTemplate::where('id', '!=', $contractTemplate->id)
                             ->update(['is_default' => false]);
        }

        $contractTemplate->update([
            'name'       => $data['name'],
            'is_default' => $isDefault,
            'locale'     => $data['locale'] ?? $contractTemplate->locale,
        ]);

        if ($isSuperAdmin) {
            $adminIds = array_filter(array_map('intval', (array) $request->input('assigned_admins', [])));
            $contractTemplate->assignedAdmins()->sync($adminIds);
        }

        return redirect()->route('admin.contract-templates.index')
                         ->with('success', 'Modèle mis à jour.');
    }

    public function saveContent(Request $request, ContractTemplate $contractTemplate)
    {
        $this->authorizeTemplate($contractTemplate);

        $request->validate(['content' => 'required|string']);
        $contractTemplate->update(['content' => $request->content]);
        return response()->json(['ok' => true]);
    }

    public function destroy(ContractTemplate $contractTemplate)
    {
        $this->authorizeTemplate($contractTemplate);

        abort_if($contractTemplate->is_default, 403, 'Impossible de supprimer le modèle par défaut.');
        $contractTemplate->delete();
        return back()->with('success', 'Modèle supprimé.');
    }

    public function preview(ContractTemplate $contractTemplate)
    {
        $this->authorizeTemplate($contractTemplate);

        $knownVars = $this->variablesList();
        preg_match_all('/\{([a-zA-Z][a-zA-Z0-9_]*)\}/', $contractTemplate->content ?? '', $m);
        $contentTags  = array_values(array_unique($m[0] ?? []));
        $detectedBalises = [];
        foreach ($contentTags as $tag) {
            $detectedBalises[$tag] = $knownVars[$tag] ?? null;
        }

        return view('admin.contract-templates.preview', [
            'template'        => $contractTemplate,
            'detectedBalises' => $detectedBalises,
        ]);
    }

    public function previewPdf(ContractTemplate $contractTemplate)
    {
        $this->authorizeTemplate($contractTemplate);

        $locale = 'fr';
        try {
            $pdfPath = $this->htmlService->generatePreview(
                $contractTemplate,
                [],
                $locale
            );
        } catch (\Throwable $e) {
            abort(500, 'Génération PDF impossible : ' . $e->getMessage());
        }

        return response()->file($pdfPath, [
            'Content-Type'        => 'application/pdf',
            'Content-Disposition' => 'inline; filename="' . Str::slug($contractTemplate->name) . '-preview.pdf"',
        ])->deleteFileAfterSend(true);
    }

    /**
     * Retourne les balises du template qui ne correspondent à aucune variable standard.
     * Utilisé en AJAX lors de la création d'une demande de prêt.
     */
    public function missingVars(ContractTemplate $contractTemplate)
    {
        $this->authorizeTemplate($contractTemplate);

        $knownKeys = array_keys($this->variablesList());

        preg_match_all('/\{([a-zA-Z][a-zA-Z0-9_]*)\}/', $contractTemplate->content ?? '', $m);
        $contentTags = array_values(array_unique($m[0] ?? []));

        $unknownTags = array_values(array_filter($contentTags, fn($tag) => !in_array($tag, $knownKeys)));
        $fields = array_map(fn($t) => trim($t, '{}'), $unknownTags);

        return response()->json(['fields' => $fields]);
    }

    // ── DOCX ─────────────────────────────────────────────────────────────────────

    /**
     * Upload un nouveau template DOCX pour ce modèle de contrat.
     */
    public function uploadDocx(Request $request, ContractTemplate $contractTemplate)
    {
        $this->authorizeTemplate($contractTemplate);

        $request->validate([
            'docx_file' => 'required|file|mimes:docx,zip|max:20480',
        ]);

        try {
            $vars = $this->docxManager->upload($request->file('docx_file'), $contractTemplate);
        } catch (\InvalidArgumentException $e) {
            return back()->withErrors(['docx_file' => $e->getMessage()]);
        } catch (\Throwable $e) {
            return back()->withErrors(['docx_file' => 'Erreur lors de l\'upload : ' . $e->getMessage()]);
        }

        $count = count($vars);
        return back()->with('success', "Template DOCX uploadé — {$count} variable(s) détectée(s) : " . implode(', ', $vars));
    }

    /**
     * Télécharge le template DOCX actuel.
     */
    public function downloadDocx(ContractTemplate $contractTemplate)
    {
        $this->authorizeTemplate($contractTemplate);

        if (!$contractTemplate->docx_template_path) {
            abort(404, 'Aucun template DOCX disponible pour ce modèle.');
        }

        $absPath = storage_path('app/' . $contractTemplate->docx_template_path);
        if (!file_exists($absPath)) {
            abort(404, 'Fichier DOCX introuvable.');
        }

        return response()->download(
            $absPath,
            Str::slug($contractTemplate->name) . '_v' . $contractTemplate->docx_version . '.docx'
        );
    }

    /**
     * Génère et télécharge un DOCX de prévisualisation avec données de démonstration.
     */
    public function previewDocx(ContractTemplate $contractTemplate)
    {
        $this->authorizeTemplate($contractTemplate);

        if (!$contractTemplate->hasDocxTemplate()) {
            abort(404, 'Aucun template DOCX uploadé.');
        }

        try {
            $path = $this->docxRenderer->generatePreview($contractTemplate);
        } catch (\Throwable $e) {
            abort(500, 'Génération aperçu DOCX impossible : ' . $e->getMessage());
        }

        return response()->download(
            $path,
            Str::slug($contractTemplate->name) . '-preview.docx'
        )->deleteFileAfterSend(true);
    }

    // ── Helpers ─────────────────────────────────────────────────────────────────

    private function handleImageUploads(Request $request, ContractTemplate $template): void
    {
        $imageFields = [
            'watermark'       => 'watermark_path',
            'logo_left'       => 'logo_left_path',
            'logo_right'      => 'logo_right_path',
            'stamp'           => 'stamp_path',
            'signature_admin' => 'signature_admin_path',
            'signature_agent' => 'signature_agent_path',
        ];

        foreach ($imageFields as $input => $column) {
            if ($request->hasFile($input)) {
                $old = $template->$column;
                $template->$column = $request->file($input)->store('contract-images', 'public');
                if ($old) Storage::disk('public')->delete($old);
            } elseif ($request->boolean('remove_' . $input) && $template->$column) {
                Storage::disk('public')->delete($template->$column);
                $template->$column = null;
            }
        }

        $template->save();
    }

    private function variablesList(): array
    {
        return $this->contractService->variableDescriptions();
    }

    /**
     * Vérifie qu'un admin classique a bien accès à ce modèle : modèle par défaut
     * (repli utilisé par tous, cf. templatesForAdmin() dans LoanRequestController)
     * ou explicitement assigné à lui. Bypass pour le super-admin.
     */
    private function authorizeTemplate(ContractTemplate $contractTemplate): void
    {
        $user = Auth::user();
        if ($user->hasRole('super-admin')) return;

        $hasAccess = $contractTemplate->is_default
            || $contractTemplate->assignedAdmins()->where('users.id', $user->id)->exists();
        abort_unless($hasAccess, 403, 'Accès non autorisé à ce modèle.');
    }
}
