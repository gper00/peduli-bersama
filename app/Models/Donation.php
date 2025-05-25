<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Donation extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'invoice_number',
        'campaign_id',
        'user_id',
        'amount',
        'status',
        'payment_method',
        'payment_code',
        'payment_url',
        'transaction_id',
        'external_reference',
        'payment_date',
        'anonymous',
        'donor_name',
        'donor_email',
        'donor_phone',
        'message',
        'payment_details',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'amount' => 'integer',
        'anonymous' => 'boolean',
        'payment_date' => 'datetime',
        'payment_details' => 'json',
    ];

    /**
     * Get the campaign that owns the donation.
     */
    public function campaign(): BelongsTo
    {
        return $this->belongsTo(Campaign::class);
    }

    /**
     * Get the user that owns the donation.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the donor name attribute.
     */
    public function getDonorNameAttribute(): string
    {
        if ($this->anonymous) {
            return 'Anonim';
        }

        if ($this->donor_name) {
            return $this->donor_name;
        }
        
        return $this->user ? $this->user->name : 'Donatur';
    }

    /**
     * Scope a query to only include successful donations.
     */
    public function scopeSuccessful($query)
    {
        return $query->where('status', 'success');
    }

    /**
     * Scope a query to only include pending donations.
     */
    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    /**
     * Scope a query to only include failed donations.
     */
    public function scopeFailed($query)
    {
        return $query->where('status', 'failed');
    }
    
    /**
     * Scope a query to only include processing donations.
     */
    public function scopeProcessing($query)
    {
        return $query->where('status', 'processing');
    }
    
    /**
     * Scope a query to only include expired donations.
     */
    public function scopeExpired($query)
    {
        return $query->where('status', 'expired');
    }
    
    /**
     * Scope a query to only include refunded donations.
     */
    public function scopeRefunded($query)
    {
        return $query->where('status', 'refunded');
    }
}
