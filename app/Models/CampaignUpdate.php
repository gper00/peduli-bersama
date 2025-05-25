<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CampaignUpdate extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'campaign_id',
        'user_id',
        'title',
        'description',
        'type',
        'status',
        'image',
        'attachments',
        'pinned',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'attachments' => 'json',
        'pinned' => 'boolean',
    ];

    /**
     * Get the campaign that owns the update.
     */
    public function campaign(): BelongsTo
    {
        return $this->belongsTo(Campaign::class);
    }

    /**
     * Get the user that created the update.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    
    /**
     * Scope a query to only include published updates.
     */
    public function scopePublished($query)
    {
        return $query->where('status', 'published');
    }
    
    /**
     * Scope a query to only include draft updates.
     */
    public function scopeDraft($query)
    {
        return $query->where('status', 'draft');
    }
    
    /**
     * Scope a query to only include pinned updates.
     */
    public function scopePinned($query)
    {
        return $query->where('pinned', true);
    }
    
    /**
     * Scope a query to filter by update type.
     */
    public function scopeOfType($query, $type)
    {
        return $query->where('type', $type);
    }
    
    /**
     * Get the image URL attribute.
     */
    public function getImageUrlAttribute(): ?string
    {
        if ($this->image) {
            return asset('storage/' . $this->image);
        }
        
        return null;
    }
}
