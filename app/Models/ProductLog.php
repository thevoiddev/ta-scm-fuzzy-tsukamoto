<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductLog extends Model
{
    use HasFactory;

    public function items()
    {
        return $this->hasMany(ProductLogItem::class, 'product_log_id');
    }

    public function distributor()
    {
        return $this->belongsTo(UserBusiness::class, 'distributor_id');
    }

    public function agent()
    {
        return $this->belongsTo(UserBusiness::class, 'agent_id');
    }
}
