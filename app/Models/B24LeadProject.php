<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class B24LeadProject extends Model
{
    protected $fillable = [
        'id',
        'name',
    ];

    public function project(): HasOne
    {
        return $this->hasOne(Project::class);
    }
}
