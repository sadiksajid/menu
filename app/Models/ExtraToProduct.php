<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExtraToProduct extends Model
{
    use HasFactory;

    public function product()
    {
        return $this->belongsTo(StoreProduct::class, 'store_product_id');
    }

    public function extra()
    {
        return $this->belongsTo(ProducteExtra::class, 'product_extra_id');
    }
}
