<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class StoreProduct extends Model
{
    use HasFactory;
    use HasTranslations;

    public $translatable = ['title', 'description'];

    public function store()
    {
        return $this->belongsTo(Store::class, 'store_id');
    }

    public function category()
    {
        return $this->belongsTo(ProductCategory::class, 'product_category_id');
    }

    public function media()
    {
        return $this->hasMany(ProductMedia::class);
    }

    public function extras()
    {
        return $this->hasMany(ExtraToProduct::class);
    }

    public function view()
    {
        return $this->hasMany(ProductView::class);
    }

    public function recipes()
    {
        return $this->hasMany(ProductRecipe::class);
    }

    public function order_products()
    {
        return $this->hasMany(OrderProducte::class);
    }

    public function firstMedia()
    {
        return $this->hasOne(ProductMedia::class, 'store_product_id')->oldest();
    }
    

}
