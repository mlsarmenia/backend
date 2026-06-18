<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class B24InfoSource extends Model
{
    protected $fillable = [
        'slug',
        'name',
    ];

    public function clients()
    {
        return $this->hasMany(Client::class, 'info_source_id');
    }
}
