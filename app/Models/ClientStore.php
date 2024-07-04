<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClientStore extends Model
{
    use HasFactory;
    public function client()
    {
        return $this->belongsTo(Client::class, 'client_id');
    }
    public function store()
    {
        return $this->belongsTo(Store::class, 'store_id');
    }

    public function address()
    {
        return $this->hasMany(StoreAdress::class, 'client_store_id');
    }
    
}
