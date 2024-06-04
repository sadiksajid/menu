<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
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



    public function province()
    {
        return $this->belongsTo(Province::class, 'province_id');
    }

    public function quartiers()
    {
        return $this->hasMany(Quartier::class);
    }
}
