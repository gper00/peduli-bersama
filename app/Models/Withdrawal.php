<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Withdrawal extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'reference_number',
        'campaign_id',
        'user_id',
        'amount',
        'status',
        'bank_name',
        'account_number',
        'account_name',
        'bank_branch',
        'bank_code',
        'purpose',
        'evidence_file',
        'notes',
        'rejection_reason',
        'approved_by',
        'approved_at',
        'processed_by',
        'processed_at',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'amount' => 'integer',
        'approved_at' => 'datetime',
        'processed_at' => 'datetime',
    ];

    /**
     * Get the campaign that owns the withdrawal.
     */
    public function campaign(): BelongsTo
    {
        return $this->belongsTo(Campaign::class);
    }

    /**
     * Get the user that owns the withdrawal.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    
    /**
     * Get the admin who approved the withdrawal.
     */
    public function approver(): BelongsTo
    {
        return $this->belongsTo(User::class, 'approved_by');
    }
    
    /**
     * Get the admin who processed the withdrawal.
     */
    public function processor(): BelongsTo
    {
        return $this->belongsTo(User::class, 'processed_by');
    }

    /**
     * Check if the withdrawal is pending.
     */
    public function isPending(): bool
    {
        return $this->status === 'pending';
    }

    /**
     * Check if the withdrawal is processing.
     */
    public function isProcessing(): bool
    {
        return $this->status === 'processing';
    }

    /**
     * Check if the withdrawal is approved.
     */
    public function isApproved(): bool
    {
        return $this->status === 'approved';
    }
    
    /**
     * Check if the withdrawal is completed.
     */
    public function isCompleted(): bool
    {
        return $this->status === 'completed';
    }

    /**
     * Check if the withdrawal is rejected.
     */
    public function isRejected(): bool
    {
        return $this->status === 'rejected';
    }

    /**
     * Approve the withdrawal.
     */
    public function approve(int $approvedBy): bool
    {
        return $this->update([
            'status' => 'approved',
            'approved_by' => $approvedBy,
            'approved_at' => now(),
        ]);
    }

    /**
     * Mark withdrawal as processing.
     */
    public function markAsProcessing(): bool
    {
        return $this->update(['status' => 'processing']);
    }
    
    /**
     * Complete the withdrawal.
     */
    public function complete(int $processedBy): bool
    {
        return $this->update([
            'status' => 'completed',
            'processed_by' => $processedBy,
            'processed_at' => now(),
        ]);
    }

    /**
     * Reject the withdrawal.
     */
    public function reject(int $approvedBy, string $reason = null): bool
    {
        $data = [
            'status' => 'rejected',
            'approved_by' => $approvedBy,
            'approved_at' => now(),
        ];

        if ($reason) {
            $data['rejection_reason'] = $reason;
        }

        return $this->update($data);
    }

    /**
     * Scope a query to only include pending withdrawals.
     */
    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }
    
    /**
     * Scope a query to only include processing withdrawals.
     */
    public function scopeProcessing($query)
    {
        return $query->where('status', 'processing');
    }

    /**
     * Scope a query to only include approved withdrawals.
     */
    public function scopeApproved($query)
    {
        return $query->where('status', 'approved');
    }
    
    /**
     * Scope a query to only include completed withdrawals.
     */
    public function scopeCompleted($query)
    {
        return $query->where('status', 'completed');
    }

    /**
     * Scope a query to only include rejected withdrawals.
     */
    public function scopeRejected($query)
    {
        return $query->where('status', 'rejected');
    }
}
