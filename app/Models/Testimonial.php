<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Testimonial extends Model
{
    use HasFactory;

    protected $fillable = [
        'section_id',
        'name',
        'position',
        'company',
        'content',
        'image',
        'rating',
        'order',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'rating' => 'integer',
    ];

    /**
     * Get the section that owns the testimonial.
     */
    public function section()
    {
        return $this->belongsTo(LandingPageSection::class, 'section_id');
    }

    /**
     * Scope a query to only include active testimonials.
     */
    public function scopeActive($query)
    {
        return $query->where('is_active');
    }

    /**
     * Scope a query to order testimonials by their order value.
     */
    public function scopeOrdered($query)
    {
        return $query->orderBy('order');
    }
}
