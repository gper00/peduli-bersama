<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'username',
        'email',
        'password',
        'role',
        'phone_number',
        'image',
        'bio',
        'address',
        'facebook_url',
        'twitter_url',
        'instagram_url',
        'is_active',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    /**
     * Get the campaigns that belong to the user.
     */
    public function campaigns(): HasMany
    {
        return $this->hasMany(Campaign::class);
    }

    /**
     * Get the donations that belong to the user.
     */
    public function donations(): HasMany
    {
        return $this->hasMany(Donation::class);
    }

    /**
     * Get the comments that belong to the user.
     */
    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class);
    }

    /**
     * Get the feedbacks that belong to the user.
     */
    public function feedbacks(): HasMany
    {
        return $this->hasMany(Feedback::class);
    }

    /**
     * Get the withdrawals that belong to the user.
     */
    public function withdrawals(): HasMany
    {
        return $this->hasMany(Withdrawal::class);
    }

    /**
     * Check if the user is an admin.
     */
    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }
    
    /**
     * Check if the user is the super admin (first admin in the system).
     */
    public function isSuperAdmin(): bool
    {
        // Super admin is the first admin user (ID = 1)
        return $this->isAdmin() && $this->id === 1;
    }

    /**
     * Check if the user is a donor.
     */
    public function isDonor(): bool
    {
        return $this->role === 'donor';
    }

    /**
     * Check if the user is a creator.
     */
    public function isCreator(): bool
    {
        return $this->role === 'creator';
    }

    /**
     * Get the user's profile image URL.
     */
    public function getImageUrlAttribute(): string
    {
        if ($this->image) {
            return asset('storage/' . $this->image);
        }

        // Return default avatar if no image
        return asset('assets/img/default-avatar.png');
    }

    /**
     * Get the user's display name.
     */
    public function getDisplayNameAttribute(): string
    {
        return $this->username ?: $this->name;
    }

    /**
     * Scope to get users by role.
     */
    public function scopeByRole($query, $role)
    {
        return $query->where('role', $role);
    }

    /**
     * Scope to get active users (email verified).
     */
    public function scopeActive($query)
    {
        return $query->whereNotNull('email_verified_at');
    }
}
