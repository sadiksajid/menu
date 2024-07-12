<?php

namespace App\Models;

use App\Models\User;
use App\Models\StafProductMedia;
use App\Models\StafProductRecipe;
use App\Models\StafExtraToProduct;
use App\Models\StafProductCategory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class StafProduct extends Model
{
    use HasFactory;
    use HasTranslations;

    public $translatable = ['title', 'description'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function category()
    {
        return $this->belongsTo(StafProductCategory::class, 'staf_product_category_id');
    }

    public function media()
    {
        return $this->hasMany(StafProductMedia::class);
    }

    public function extras()
    {
        return $this->hasMany(StafExtraToProduct::class);
    }

    public function recipes()
    {
        return $this->hasMany(StafProductRecipe::class);
    }


}
