<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;

#[Fillable(['path', 'ip', 'user_agent', 'referrer'])]
class Visit extends Model
{
    public const UPDATED_AT = null;
}
