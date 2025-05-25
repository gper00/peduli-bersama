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
        'slug',
        'description',
        'icon',
        'color',
        'is_active',
        'sort_order',
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
    
    /**
     * Scope a query to only include active categories.
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
    
    /**
     * Scope a query to order categories by sort_order.
     */
    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order');
    }
    
    /**
     * Get the category icon URL.
     */
    public function getIconUrlAttribute(): string
    {
        if ($this->icon) {
            return asset('storage/' . $this->icon);
        }
        
        // Return default icon if no icon is set
        return asset('assets/img/default-category-icon.png');
    }
    
    /**
     * Get the route key for the model.
     */
    public function getRouteKeyName()
    {
        return 'slug';
    }
}
