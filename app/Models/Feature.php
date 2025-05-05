<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Feature extends Model
{
    use HasFactory;

    protected $fillable = [
        'section_id',
        'title',
        'description',
        'icon',
        'image',
        'order',
        'is_active',
        'extra_data',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'extra_data' => 'array',
    ];

    /**
     * Get the section that owns the feature.
     */
    public function section()
    {
        return $this->belongsTo(LandingPageSection::class, 'section_id');
    }

    /**
     * Scope a query to only include active features.
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', 1);
    }

    /**
     * Scope a query to order features by their order value.
     */
    public function scopeOrdered($query)
    {
        return $query->orderBy('order');
    }
}
