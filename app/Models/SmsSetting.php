<?php

namespace App\Models;

use App\Casts\SafeEncrypted;
use Illuminate\Database\Eloquent\Model;

class SmsSetting extends Model
{
    protected $fillable = ['enabled', 'driver', 'api_url', 'username', 'password', 'default_country_code'];

    protected $casts = [
        'enabled'  => 'boolean',
        'password' => SafeEncrypted::class,
    ];

    protected $hidden = ['password'];

    public static function current(): self
    {
        return static::first() ?? static::create([]);
    }
}
