<?php

namespace App\Services;

use App\Models\LoanRequest;
use App\Models\NotificationTemplate;
use Illuminate\Http\UploadedFile;

/**
 * Gère l'upload du template DOCX d'un modèle de notification et la génération
 * du DOCX rempli pour un dossier donné. Réutilise le moteur générique de
 * ContractDocxRenderer/DocxTemplateManager (déjà découplé de ContractTemplate),
 * sans passer par DocumentArchive/GeneratedDocument (liés par FK à contract_templates).
 */
class NotificationDocxService
{
    public function __construct(
        private DocxTemplateManager      $docxManager,
        private ContractDocxRenderer     $renderer,
        private ContractVariableResolver $resolver,
    ) {}

    /**
     * Valide, stocke et enregistre un nouveau template DOCX sur le modèle de notification.
     *
     * @return string[] Liste des variables détectées (sans accolades)
     */
    public function upload(UploadedFile $file, NotificationTemplate $template): array
    {
        $this->docxManager->validateDocx($file);

        $version     = ($template->docx_version ?? 0) + 1;
        $filename    = 'notification_template_' . $template->id . '_v' . $version . '_' . time() . '.docx';
        $storagePath = $file->storeAs('docx-templates', $filename, 'local');
        $absPath     = storage_path('app/' . $storagePath);

        try {
            $vars = $this->docxManager->detectVariables($absPath);
        } catch (\Throwable $e) {
            @unlink($absPath);
            throw $e;
        }

        $template->update([
            'docx_template_path' => $storagePath,
            'docx_version'       => $version,
            'docx_detected_vars' => $vars,
        ]);

        return $vars;
    }

    /**
     * Génère le DOCX de notification rempli pour un dossier donné.
     * Retourne le chemin absolu du fichier généré.
     */
    public function generate(LoanRequest $loan, NotificationTemplate $template, string $locale = 'fr'): string
    {
        if (!$template->docx_template_path) {
            throw new \RuntimeException("Aucun template DOCX uploadé pour le modèle \"{$template->name}\".");
        }

        $templatePath = storage_path('app/' . $template->docx_template_path);
        if (!file_exists($templatePath)) {
            throw new \RuntimeException("Fichier DOCX template introuvable : {$template->docx_template_path}");
        }

        $vars = $this->resolver->resolve($loan, $locale);

        $safe = preg_replace('/[^a-zA-Z0-9_\-]/', '_', $loan->reference);
        $dir  = storage_path('app/generated-notifications');
        if (!is_dir($dir)) {
            mkdir($dir, 0755, true);
        }
        $outputPath = $dir . DIRECTORY_SEPARATOR . 'notification_' . $safe . '_' . $locale . '.docx';

        return $this->renderer->render($templatePath, $vars, $outputPath);
    }
}
