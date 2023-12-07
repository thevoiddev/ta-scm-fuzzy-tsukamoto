<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductScanner extends Model
{
    use HasFactory;

    public function office()
    {
        return $this->belongsTo(UserOffice::class, 'office_id');
    }
}
