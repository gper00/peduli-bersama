<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Comment extends Model
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
        'parent_id',
        'comment',
        'likes',
        'is_pinned',
        'status',
        'moderated_at',
        'moderated_by',
    ];

    /**
     * Get the campaign that owns the comment.
     */
    public function campaign(): BelongsTo
    {
        return $this->belongsTo(Campaign::class);
    }

    /**
     * Get the user that owns the comment.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the parent comment.
     */
    public function parent(): BelongsTo
    {
        return $this->belongsTo(Comment::class, 'parent_id');
    }

    /**
     * Get the replies for the comment.
     */
    public function replies(): HasMany
    {
        return $this->hasMany(Comment::class, 'parent_id');
    }

    /**
     * Check if the comment is a reply.
     */
    public function getIsReplyAttribute(): bool
    {
        return !is_null($this->parent_id);
    }

    /**
     * Check if the comment has replies.
     */
    public function getHasRepliesAttribute(): bool
    {
        return $this->replies()->count() > 0;
    }
    
    /**
     * Get the moderator that moderated the comment.
     */
    public function moderator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'moderated_by');
    }
    
    /**
     * Scope a query to only include published comments.
     */
    public function scopePublished($query)
    {
        return $query->where('status', 'published');
    }
    
    /**
     * Scope a query to only include pending comments.
     */
    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }
    
    /**
     * Scope a query to only include spam comments.
     */
    public function scopeSpam($query)
    {
        return $query->where('status', 'spam');
    }
    
    /**
     * Scope a query to only include pinned comments.
     */
    public function scopePinned($query)
    {
        return $query->where('is_pinned', true);
    }
}
