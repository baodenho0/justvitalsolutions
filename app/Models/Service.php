<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use \Illuminate\Database\Eloquent\Factories\HasFactory;

    protected $fillable = [
        'title',
        'subtitle',
        'banner_image',
        'intro_text',
        'service_items',
        'process_steps',
        'show_cta',
        'cta_title',
        'cta_description',
        'cta_button_text',
        'cta_button_url',
        'is_active',
    ];

    protected $casts = [
        'service_items' => 'array',
        'process_steps' => 'array',
        'show_cta' => 'boolean',
        'is_active' => 'boolean',
    ];

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
}
