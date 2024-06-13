<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderProducteExtra extends Model
{
    use HasFactory;

    public function order_product()
    {
        return $this->belongsTo(PrderProduct::class, 'order_product_id');
    }

    public function product_extra()
    {
        return $this->belongsTo(ProductExtra::class, 'product_extra_id');
    }

}
