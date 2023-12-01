<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserBusiness extends Model
{
    use HasFactory;

    public function owner()
    {
        return $this->morphOne(User::class, 'userable');
    }

    public function offices()
    {
        return $this->hasMany(UserOffice::class, 'business_id');
    }
}
