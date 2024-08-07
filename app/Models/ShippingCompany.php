<?php

namespace App\Models;

use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ShippingCompany extends Model
{
    use HasFactory;

    protected $casts = [
        'contact_info' => 'array',
        'working_time' => 'array',
        'cities' => 'array',
    ];

    public function shippingCompanyToStores()
    {
        return $this->hasMany(ShippingCompanyToStore::class);
    }

    public function getShippingCompanyIntegrationStore()
    {
        $data = $this->shippingCompanyToStores()
        ->where('store_id', Auth::user()->store->id)
        ->get();
        return $data ;
    }

}
