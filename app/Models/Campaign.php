<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Campaign extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'category_id',
        'title',
        'slug',
        'short_description',
        'description',
        'target_amount',
        'current_amount',
        'start_date',
        'end_date',
        'cover_image',
        'status',
        'verification_status',
        'featured',
        'donor_count',
        'view_count',
        'share_count',
        'rejection_reason',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
        'target_amount' => 'integer',
        'current_amount' => 'integer',
    ];

    /**
     * Get the user that owns the campaign.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the category that the campaign belongs to.
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Get the donations for the campaign.
     */
    public function donations(): HasMany
    {
        return $this->hasMany(Donation::class);
    }

    /**
     * Get the comments for the campaign.
     */
    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class)->whereNull('parent_id');
    }

    /**
     * Get the updates for the campaign.
     */
    public function updates(): HasMany
    {
        return $this->hasMany(CampaignUpdate::class);
    }

    /**
     * Get the withdrawals for the campaign.
     */
    public function withdrawals(): HasMany
    {
        return $this->hasMany(Withdrawal::class);
    }

    /**
     * Calculate the percentage of the campaign's progress.
     */
    public function getProgressPercentageAttribute(): float
    {
        if ($this->target_amount > 0) {
            $percentage = ($this->current_amount / $this->target_amount) * 100;
            return min(100, $percentage);
        }

        return 0;
    }

    /**
     * Check if the campaign is still active.
     */
    public function getIsActiveAttribute(): bool
    {
        return $this->status === 'active' && $this->end_date >= now();
    }

    /**
     * Check if the campaign is still valid for donations.
     */
    public function getCanDonateAttribute(): bool
    {
        return $this->is_active && $this->current_amount < $this->target_amount;
    }

    /**
     * Get the total number of donors for the campaign.
     */
    public function getDonorCountAttribute(): int
    {
        return $this->donations()
            ->where('status', 'success')
            ->distinct('user_id')
            ->count('user_id');
    }

    /**
     * Get the days remaining for the campaign.
     */
    public function getDaysRemainingAttribute(): int
    {
        return max(0, now()->diffInDays($this->end_date, false));
    }

    /**
     * Scope a query to only include active campaigns.
     */
    public function scopeActive($query)
    {
        return $query->where('status', 'active')
                    ->where('end_date', '>=', now());
    }

    /**
     * Scope a query to only include campaigns by category.
     */
    public function scopeByCategory($query, $categoryId)
    {
        return $query->where('category_id', $categoryId);
    }

    /**
     * Scope a query to search campaigns by title or description.
     */
    public function scopeSearch($query, $searchTerm)
    {
        return $query->where('title', 'like', "%{$searchTerm}%")
                    ->orWhere('description', 'like', "%{$searchTerm}%");
    }
}
