<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductView extends Model
{
    use HasFactory;
    public function product()
    {
        return $this->belongsTo(StoreProduct::class, 'store_product_id');
    }

    public function client()
    {
        return $this->belongsTo(Client::class, 'client_id');
    }
}
