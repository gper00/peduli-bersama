<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Notification extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'user_id',
        'campaign_id',
        'donation_id',
        'type',
        'title',
        'message',
        'is_read',
    ];
    
    protected $casts = [
        'is_read' => 'boolean',
    ];
    
    /**
     * Get the user that owns the notification.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    
    /**
     * Get the campaign related to this notification.
     */
    public function campaign(): BelongsTo
    {
        return $this->belongsTo(Campaign::class);
    }
    
    /**
     * Get the donation related to this notification.
     */
    public function donation(): BelongsTo
    {
        return $this->belongsTo(Donation::class);
    }
    
    /**
     * Mark the notification as read.
     */
    public function markAsRead(): void
    {
        $this->update(['is_read' => true]);
    }
    
    /**
     * Scope a query to only include unread notifications.
     */
    public function scopeUnread($query)
    {
        return $query->where('is_read', false);
    }
}
