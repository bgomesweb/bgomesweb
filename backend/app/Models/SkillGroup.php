<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class SkillGroup extends Model
{
    protected $fillable = [
        'category',
        'sort_order',
    ];

    public function skills(): HasMany
    {
        return $this->hasMany(Skill::class);
    }
}
