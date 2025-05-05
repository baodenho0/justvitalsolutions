<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LandingPageSection extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'title',
        'subtitle',
        'content',
        'image',
        'background_image',
        'background_color',
        'button_text',
        'button_url',
        'order',
        'is_active',
        'section_type',
        'extra_data',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'extra_data' => 'array',
    ];

    /**
     * Get the features for the section.
     */
    public function features()
    {
        return $this->hasMany(Feature::class, 'section_id');
    }

    /**
     * Get the testimonials for the section.
     */
    public function testimonials()
    {
        return $this->hasMany(Testimonial::class, 'section_id');
    }



    /**
     * Scope a query to only include active sections.
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', 1);
    }

    /**
     * Scope a query to order sections by their order value.
     */
    public function scopeOrdered($query)
    {
        return $query->orderBy('order');
    }
}
