<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Feedback extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'feedbacks';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'campaign_id',
        'donation_id',
        'name',
        'email',
        'subject',
        'type',
        'priority',
        'message',
        'status',
        'admin_notes',
        'admin_response',
        'responded_by',
        'responded_at',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'responded_at' => 'datetime',
    ];

    /**
     * Get the user that owns the feedback.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    
    /**
     * Get the campaign that the feedback belongs to.
     */
    public function campaign(): BelongsTo
    {
        return $this->belongsTo(Campaign::class);
    }

    /**
     * Get the admin who responded to the feedback.
     */
    public function responder(): BelongsTo
    {
        return $this->belongsTo(User::class, 'responded_by');
    }

    /**
     * Check if the feedback is unread.
     */
    public function isUnread(): bool
    {
        return $this->status === 'unread';
    }

    /**
     * Check if the feedback is in progress.
     */
    public function isInProgress(): bool
    {
        return $this->status === 'in_progress';
    }

    /**
     * Check if the feedback has been responded to.
     */
    public function isResponded(): bool
    {
        return $this->status === 'responded';
    }

    /**
     * Check if the feedback is closed.
     */
    public function isClosed(): bool
    {
        return $this->status === 'closed';
    }

    /**
     * Mark the feedback as read.
     */
    public function markAsRead(): bool
    {
        return $this->update(['status' => 'read']);
    }

    /**
     * Mark the feedback as in progress.
     */
    public function markAsInProgress(): bool
    {
        return $this->update(['status' => 'in_progress']);
    }

    /**
     * Mark the feedback as responded.
     */
    public function markAsResponded(int $respondedBy, string $response): bool
    {
        return $this->update([
            'status' => 'responded',
            'admin_response' => $response,
            'responded_by' => $respondedBy,
            'responded_at' => now(),
        ]);
    }

    /**
     * Close the feedback.
     */
    public function close(): bool
    {
        return $this->update(['status' => 'closed']);
    }

    /**
     * Scope a query to only include unread feedback.
     */
    public function scopeUnread($query)
    {
        return $query->where('status', 'unread');
    }

    /**
     * Scope a query to only include read feedback.
     */
    public function scopeRead($query)
    {
        return $query->where('status', 'read');
    }

    /**
     * Scope a query to only include in-progress feedback.
     */
    public function scopeInProgress($query)
    {
        return $query->where('status', 'in_progress');
    }

    /**
     * Scope a query to only include responded feedback.
     */
    public function scopeResponded($query)
    {
        return $query->where('status', 'responded');
    }

    /**
     * Scope a query to only include closed feedback.
     */
    public function scopeClosed($query)
    {
        return $query->where('status', 'closed');
    }

    /**
     * Scope a query to only include feedback with a specific priority.
     */
    public function scopeWithPriority($query, $priority)
    {
        return $query->where('priority', $priority);
    }

    /**
     * Scope a query to only include feedback with a specific type.
     */
    public function scopeOfType($query, $type)
    {
        return $query->where('type', $type);
    }

    /**
     * Get the sender name (user name or guest name).
     */
    public function getSenderNameAttribute(): string
    {
        if ($this->user) {
            return $this->user->name;
        }

        return $this->name ?? 'Tamu';
    }

}
