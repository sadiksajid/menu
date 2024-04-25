<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class ProductCategory extends Model
{
    use HasFactory;
    use HasTranslations;

    public $translatable = ['title', 's_title'];

    public function products()
    {
        return $this->hasMany(StoreProduct::class);
    }
    public function category_store()
    {
        return $this->hasMany(CatecoryToStore::class);
    }

}
