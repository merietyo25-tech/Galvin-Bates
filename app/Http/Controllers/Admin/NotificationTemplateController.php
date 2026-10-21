<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\NotificationTemplate;
use App\Services\ContractService;
use App\Services\NotificationDocxService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class NotificationTemplateController extends Controller
{
    public function __construct(
        private ContractService       $contractService,
        private NotificationDocxService $docxService,
    ) {}

    public function index(Request $request)
    {
        $type           = $request->get('type', NotificationTemplate::TYPE_VALIDATION);
        $query          = NotificationTemplate::with('creator')->where('type', $type)->orderBy('locale');
        $localeLabels   = $this->localeLabels();

        // $configured doit lister les langues deja configurees sur l ENSEMBLE des
        // modeles. Le deduire de la page affichee ferait apparaitre comme manquantes
        // des langues presentes en page suivante.
        $configured     = (clone $query)->pluck('locale')->all();
        $missingLocales = array_diff(array_keys($localeLabels), $configured);
        $totalTemplates = count($configured);

        $templates      = $query->paginate(15)->appends($request->query());

        return view('admin.notification-templates.index', compact('templates', 'missingLocales', 'localeLabels', 'type', 'totalTemplates'));
    }

    public function create()
    {
        return view('admin.notification-templates.create', [
            'localeLabels' => $this->localeLabels(),
            'types'        => NotificationTemplate::TYPES,
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name'    => 'required|string|max:255',
            'type'    => 'required|in:' . implode(',', array_keys(NotificationTemplate::TYPES)),
            'locale'  => ['required', 'in:fr,en,pl,es,bg,hu,it,de,lt,ro,lv,nl,pt,hr',
                Rule::unique('notification_templates')->where(fn($q) => $q->where('type', $request->type)),
            ],
            'subject' => 'nullable|required_unless:type,' . NotificationTemplate::TYPE_CONDITIONS . '|string|max:255',
        ]);

        $template = NotificationTemplate::create([
            'name'       => $data['name'],
            'type'       => $data['type'],
            'locale'     => $data['locale'],
            'subject'    => $data['subject'] ?? null,
            'content'    => '',
            'created_by' => Auth::id(),
        ]);

        return redirect()->route('admin.notification-templates.edit', $template)
                         ->with('success', 'Modèle créé. Rédigez maintenant son contenu.');
    }

    public function edit(NotificationTemplate $notificationTemplate)
    {
        return view('admin.notification-templates.edit', [
            'template'  => $notificationTemplate,
            'variables' => $this->contractService->variableDescriptions(),
            'types'     => NotificationTemplate::TYPES,
        ]);
    }

    public function update(Request $request, NotificationTemplate $notificationTemplate)
    {
        $data = $request->validate([
            'name'    => 'required|string|max:255',
            'type'    => 'required|in:' . implode(',', array_keys(NotificationTemplate::TYPES)),
            'locale'  => ['required', 'in:fr,en,pl,es,bg,hu,it,de,lt,ro,lv,nl,pt,hr',
                Rule::unique('notification_templates')
                    ->where(fn($q) => $q->where('type', $request->type))
                    ->ignore($notificationTemplate->id),
            ],
            'subject' => 'nullable|required_unless:type,' . NotificationTemplate::TYPE_CONDITIONS . '|string|max:255',
            'content' => 'nullable|string',
        ]);

        $data['subject'] = $data['subject'] ?? null;

        $notificationTemplate->update($data);

        return redirect()->route('admin.notification-templates.edit', $notificationTemplate)
                         ->with('success', 'Modèle mis à jour.');
    }

    public function destroy(NotificationTemplate $notificationTemplate)
    {
        $notificationTemplate->delete();
        return back()->with('success', 'Modèle supprimé.');
    }

    /**
     * Upload un nouveau template DOCX pour ce modèle de notification.
     */
    public function uploadDocx(Request $request, NotificationTemplate $notificationTemplate)
    {
        $request->validate([
            'docx_file' => 'required|file|mimes:docx,zip|max:20480',
        ]);

        try {
            $vars = $this->docxService->upload($request->file('docx_file'), $notificationTemplate);
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
    public function downloadDocx(NotificationTemplate $notificationTemplate)
    {
        if (!$notificationTemplate->docx_template_path) {
            abort(404, 'Aucun template DOCX disponible pour ce modèle.');
        }

        $absPath = storage_path('app/' . $notificationTemplate->docx_template_path);
        if (!file_exists($absPath)) {
            abort(404, 'Fichier DOCX introuvable.');
        }

        return response()->download(
            $absPath,
            Str::slug($notificationTemplate->name) . '_v' . $notificationTemplate->docx_version . '.docx'
        );
    }

    private function localeLabels(): array
    {
        return [
            'fr' => 'Français', 'en' => 'Anglais', 'pl' => 'Polonais', 'es' => 'Espagnol',
            'bg' => 'Bulgare', 'hu' => 'Hongrois', 'it' => 'Italien', 'de' => 'Allemand',
            'lt' => 'Lituanien', 'ro' => 'Roumain', 'lv' => 'Letton', 'nl' => 'Néerlandais',
            'pt' => 'Portugais', 'hr' => 'Croate',
        ];
    }
}
