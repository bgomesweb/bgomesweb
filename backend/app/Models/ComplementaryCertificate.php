<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ComplementaryCertificate extends Model
{
    protected $fillable = [
        'name',
        'issuer',
        'sort_order',
    ];
}
