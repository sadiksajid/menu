<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClientAddress extends Model
{
    use HasFactory;

    public function city()
    {
        return $this->belongsTo(City::class, 'city_id');
    }
    public function quartier()
    {
        return $this->belongsTo(Quartier::class, 'quartier_id');
    }
    
    public function client()
    {
        return $this->belongsTo(Client::class, 'client_id');
    }

    public function orders()
    {
        return $this->hasMany(StoreOrder::class);
    }
    
}
