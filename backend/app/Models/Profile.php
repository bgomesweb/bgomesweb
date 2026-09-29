<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $fillable = [
        'name',
        'title',
        'summary',
        'location',
        'phone',
        'whatsapp',
        'email',
        'linkedin_url',
        'github_url',
        'resume_path',
        'photo_path',
    ];
}
