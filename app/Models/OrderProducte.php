<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderProducte extends Model
{
    use HasFactory;

    public function product()
    {
        return $this->belongsTo(StoreProduct::class, 'store_product_id');
    }

    public function extras()
    {
        return $this->hasMany(OrderProductExtra::class);
    }
}
