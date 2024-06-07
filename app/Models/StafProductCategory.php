<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class StafProductCategory extends Model
{

    use HasFactory;
    use HasTranslations;
    public $translatable = ['title', 's_title'];

    public function products()
    {
        return $this->hasMany(StafProduct::class);
    }




}
