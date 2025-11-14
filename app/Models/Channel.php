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
}
