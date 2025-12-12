<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Carbon\Carbon;

class Campaign extends Model
{
    protected $fillable = [
        'title',
        'description',
        'image',
        'image_url',
        'target_amount',
        'current_amount',
        'end_date',
        'status',
        'donors_count',
    ];

    protected $casts = [
        'target_amount' => 'decimal:2',
        'current_amount' => 'decimal:2',
        'end_date' => 'date',
    ];

    /**
     * Get all donations for this campaign
     */
    public function donations(): HasMany
    {
        return $this->hasMany(Donation::class)->where('payment_status', 'paid')->latest();
    }

    /**
     * Get all updates for this campaign
     */
    public function updates(): HasMany
    {
        return $this->hasMany(CampaignUpdate::class)->latest();
    }

    /**
     * Get progress percentage
     */
    public function getProgressAttribute()
    {
        if ($this->target_amount == 0) {
            return 0;
        }
        return min(100, round(($this->current_amount / $this->target_amount) * 100));
    }

    /**
     * Get days left until campaign ends
     */
    public function getDaysLeftAttribute()
    {
        if (!$this->end_date) {
            return 0;
        }
        $now = Carbon::now();
        $endDate = Carbon::parse($this->end_date);
        
        if ($endDate->isPast()) {
            return 0;
        }
        
        return $now->diffInDays($endDate);
    }
}
