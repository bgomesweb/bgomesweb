<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = [
        'name',
        'description',
        'technologies',
        'url',
        'repository_url',
        'sort_order',
    ];

    protected $casts = [
        'technologies' => 'array',
    ];
}
