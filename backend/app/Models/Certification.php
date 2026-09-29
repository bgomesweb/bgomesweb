<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Certification extends Model
{
    protected $fillable = [
        'name',
        'issuer',
        'issued_at',
        'expires_at',
        'credential_url',
        'file_path',
        'featured',
        'description',
        'sort_order',
    ];

    protected $casts = [
        'issued_at' => 'date',
        'expires_at' => 'date',
        'featured' => 'boolean',
    ];
}
