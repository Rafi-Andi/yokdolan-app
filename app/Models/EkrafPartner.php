<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class EkrafPartner extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function channel():BelongsTo{
        return $this->belongsTo(Channel::class);
    }
}
