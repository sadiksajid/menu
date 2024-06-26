<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Offer extends Model
{
    use HasFactory;
    use HasTranslations;

    public $translatable = ['title', 'description'];

    public function products()
    {
        return $this->hasMany(OfferProduct::class);
    }
}
