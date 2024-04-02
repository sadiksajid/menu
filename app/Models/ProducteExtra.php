<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProducteExtra extends Model
{
    use HasFactory;

    protected $fillable = [
        'image',
        'title',
        'created_at',
        'updated_at',
    ];


    public function products()
    {
        return $this->hasMany(ExtraToProduct::class);
    }
    public function store()
    {
        return $this->belongsTo(Store::class, 'store_id');
    }
    public function order_extras()
    {
        return $this->hasMany(OrderProductExtra::class);
    }



}
