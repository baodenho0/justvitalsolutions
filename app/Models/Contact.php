<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use \Illuminate\Database\Eloquent\Factories\HasFactory;

    protected $fillable = [
        'title',
        'subtitle',
        'banner_image',
        'intro_text',
        'address',
        'phone',
        'email',
        'map_embed_code',
        'office_hours',
        'show_contact_form',
        'form_title',
        'form_description',
        'is_active',
    ];

    protected $casts = [
        'office_hours' => 'array',
        'show_contact_form' => 'boolean',
        'is_active' => 'boolean',
    ];

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function submissions()
    {
        return $this->hasMany(ContactSubmission::class);
    }
}
