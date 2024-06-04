<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StoreOrder extends Model
{
    use HasFactory;

    public function store()
    {
        return $this->belongsTo(Store::class, 'store_id');
    }

    public function client()
    {
        return $this->belongsTo(Client::class, 'client_id');
    }

    public function client_address()
    {
        return $this->belongsTo(ClientAddress::class, 'client_address_id');
    }

    public function products()
    {
        return $this->hasMany(OrderProducte::class, 'store_order_id');
    }
}