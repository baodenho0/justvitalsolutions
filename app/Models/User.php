<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'avatar',
        'password',
        'is_admin',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'is_admin' => 'boolean',
        ];
    }

    /**
     * Check if the user is an admin.
     *
     * @return bool
     */
    public function isAdmin(): bool
    {
        return $this->is_admin;
    }

    /**
     * Get the blog posts for the user.
     */
    public function blogPosts(): HasMany
    {
        return $this->hasMany(BlogPost::class);
    }

    /**
     * Get the blog comments for the user.
     */
    public function blogComments(): HasMany
    {
        return $this->hasMany(BlogComment::class);
    }

    /**
     * Get the profile URL for the user.
     *
     * @return string
     */
    public function adminlte_profile_url()
    {
        return route('admin.profile');
    }

    /**
     * Get the profile image URL for the user.
     *
     * @return string
     */
    public function adminlte_image()
    {
        return $this->avatar ? asset($this->avatar) : asset('vendor/adminlte/dist/img/user2-160x160.jpg');
    }

    /**
     * Get the description for the user.
     *
     * @return string
     */
    public function adminlte_desc()
    {
        return $this->isAdmin() ? 'Administrator' : 'User';
    }
}
