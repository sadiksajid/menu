<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quartier extends Model
{
    use HasFactory;

    public function client_addresses()
    {
        return $this->hasMany(ClientAddress::class);
    }


    public function stores()
    {
        return $this->hasMany(Store::class);
    }

    
       public function city()
    {
        return $this->belongsTo(City::class, 'city_id');
    }

    public function quartiers()
    {
        return $this->hasMany(Quartier::class);
    }
}
