<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserOffice extends Model
{
    use HasFactory;

    public function business()
    {
        return $this->belongsTo(UserBusiness::class, 'business_id');
    }

    public function user()
    {
        return $this->morphOne(User::class, 'ref');
    }
}
