<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LoanSetting extends Model
{
    protected $fillable = [
        'annual_rate',
        'min_amount',
        'max_amount',
        'notification_email',
    ];

    protected $casts = [
        'annual_rate' => 'decimal:2',
        'min_amount'  => 'decimal:2',
        'max_amount'  => 'decimal:2',
    ];

    /**
     * Enregistrement singleton des paramètres de prêt.
     */
    public static function current(): self
    {
        return static::first() ?? static::create([
            'annual_rate' => 2.00,
            'min_amount'  => 100.00,
            'max_amount'  => 100000.00,
        ]);
    }
}
