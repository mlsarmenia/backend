<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class B24Project extends Model
{
    protected $fillable = [
        'id',
        'name',
    ];

    public function project()
    {
        return $this->hasOne(Project::class);
    }
}
