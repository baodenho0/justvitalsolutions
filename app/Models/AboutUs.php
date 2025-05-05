<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AboutUs extends Model
{
    use \Illuminate\Database\Eloquent\Factories\HasFactory;

    protected $fillable = [
        'title',
        'subtitle',
        'banner_image',
        'section1_title',
        'section1_content',
        'section2_title',
        'section2_content',
        'skills',
        'team_members',
        'is_active',
    ];

    protected $casts = [
        'skills' => 'array',
        'team_members' => 'array',
        'is_active' => 'boolean',
    ];

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
}
