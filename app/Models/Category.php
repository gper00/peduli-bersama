<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'description',
        'icon',
    ];

    /**
     * Get the campaigns for the category.
     */
    public function campaigns(): HasMany
    {
        return $this->hasMany(Campaign::class);
    }

    /**
     * Get active campaigns count for the category.
     */
    public function getActiveCampaignsCountAttribute(): int
    {
        return $this->campaigns()->where('status', 'active')
                   ->where('end_date', '>=', now())
                   ->count();
    }

    /**
     * Get total donations amount for the category.
     */
    public function getTotalDonationsAttribute(): int
    {
        return $this->campaigns()
                   ->sum('current_amount');
    }
}
