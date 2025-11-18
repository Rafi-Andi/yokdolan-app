<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Channel extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function missions()
    {
        return $this->hasMany(Mission::class);
    }

    public function owner()
    {
        return $this->belongsTo(User::class, 'owner_user_id');
    }

    public function ekrafPartners()
    {
        return $this->hasMany(EkrafPartner::class);
    }
}
