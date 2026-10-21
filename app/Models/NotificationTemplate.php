<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NotificationTemplate extends Model
{
    use HasFactory;

    const TYPE_VALIDATION    = 'validation';
    const TYPE_CONTRACT_SENT = 'contract_sent';
    const TYPE_CONDITIONS    = 'conditions';
    const TYPE_INSURANCE     = 'insurance';

    const TYPES = [
        self::TYPE_VALIDATION    => 'Notification de validation',
        self::TYPE_CONTRACT_SENT => 'Contrat envoyé',
        self::TYPE_CONDITIONS    => 'Conditions générales',
        self::TYPE_INSURANCE     => 'Assurance emprunteur',
    ];

    protected $fillable = [
        'locale', 'type', 'name', 'subject', 'content', 'created_by',
        'docx_template_path', 'docx_version', 'docx_detected_vars',
    ];

    protected $casts = [
        'docx_detected_vars' => 'array',
    ];

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function hasDocxTemplate(): bool
    {
        return (bool) $this->docx_template_path;
    }

    public function typeLabel(): string
    {
        return self::TYPES[$this->type] ?? $this->type;
    }

    /**
     * Résout le modèle applicable à un dossier selon sa langue et le type d'email
     * (repli sur FR si aucun modèle n'est configuré pour cette langue).
     */
    public static function resolveForLoan(LoanRequest $loan, string $type = self::TYPE_VALIDATION): ?self
    {
        $locale = $loan->contract_language ?? 'fr';

        return self::where('locale', $locale)->where('type', $type)->first()
            ?? self::where('locale', 'fr')->where('type', $type)->first();
    }
}
