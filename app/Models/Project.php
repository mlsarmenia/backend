<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Project extends Model
{
    use CrudTrait;
    protected $fillable = [
        'title_arm',
        'title_en',
        'title_ru',
        'content_arm',
        'content_en',
        'content_ru',
        'province_id',
        'community_id',
        'city_id',
        'pm_project_id',
        'b24_project_id',
        'b24_lead_project_id',
        'b24_contact_project_id',
        'featured_image',
    ];

    protected $casts = [
        'content_arm' => 'array',
        'content_en' => 'array',
        'content_ru' => 'array',
    ];

    public function documents(): HasMany
    {
        return $this->hasMany(ProjectDocument::class);
    }

    public function b24Project(): BelongsTo
    {
        return $this->belongsTo(B24Project::class);
    }

    public function b24LeadProject(): BelongsTo
    {
        return $this->belongsTo(B24LeadProject::class);
    }

    public function b24ContactProject(): BelongsTo
    {
        return $this->belongsTo(B24ContactProject::class);
    }

    public function estates()
    {
        return $this->hasMany(Estate::class, 'b24_project_id', 'b24_project_id');
    }
}
