<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class RewardExchange extends Model
{
    use HasFactory;
    protected $guarded = [];
    
    public function tourist():BelongsTo{
        return $this->belongsTo(User::class, 'tourist_user_id');
    }

    public function reward():BelongsTo{
        return $this->belongsTo(Reward::class, 'reward_id');
    }
}
