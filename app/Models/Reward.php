<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Reward extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function exchanges(): HasMany
    {
        return $this->hasMany(RewardExchange::class);
    }

    public function partnerUser(): BelongsTo
    {
        return $this->belongsTo(User::class, 'partner_user_id');
    }

    public function ekrafPartner(): BelongsTo
    {
        return $this->belongsTo(EkrafPartner::class, 'partner_user_id', 'user_id');
    }
}
