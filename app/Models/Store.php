<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Store extends Model
{
    use HasFactory;

    public function products()
    {
        return $this->hasMany(StoreProduct::class);
    }

    public function admin()
    {
        return $this->hasOne(StoreAdmin::class);
    }

    public function link()
    {
        return $this->hasMany(StoreLink::class);
    }

    public function orders()
    {
        return $this->hasMany(StoreOrder::class);
    }

    public function photos()
    {
        return $this->hasMany(StorePhoto::class);
    }

    public function sliders()
    {
        return $this->hasMany(StoreSlider::class);
    }

    public function views()
    {
        return $this->hasMany(StoretView::class);
    }

    public function clients()
    {
        return $this->hasMany(ClientStore::class);
    }

    public function notification()
    {
        return $this->hasMany(StoreNotification::class);
    }

    public function client_notification()
    {
        return $this->hasMany(StoreToClientNotification::class);
    }

    public function category_store()
    {
        return $this->hasMany(CatecoryToStore::class);
    }

    public function product_extra()
    {
        return $this->hasMany(ProducteExtra::class);
    }

    public function city()
    {
        return $this->belongsTo(City::class, 'city_id');
    }


    public function quartier()
    {
        return $this->belongsTo(Quartier::class, 'quartier_id');
    }

    public function profiles()
    {
        return $this->hasMany(StoreStafPassword::class);
    }

}
