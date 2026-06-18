<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Storage;

class ProjectDocument extends Model
{
    protected $fillable = [
        'project_id',
        'path',
        'position',
    ];

    protected static function booted(): void
    {
        static::deleted(function ($model) {
            Storage::disk('S3Public')->delete($model->path);
        });
    }

    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class);
    }

    protected function isPublic(): Attribute
    {
        return Attribute::make(
            get: fn () => true,
        );
    }
}
