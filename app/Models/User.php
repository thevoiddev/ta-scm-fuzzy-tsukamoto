<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    use HasFactory;

    public function role()
    {
        return $this->belongsTo(UserRole::class, 'role_id');
    }

    public function userable()
    {
        return $this->morphTo();
    }
}
