<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class StafProductExtra extends Model
{
    use HasFactory;

    protected $fillable = [
        'image',
        'title',
        'created_at',
        'updated_at',
    ];

    use HasTranslations;

    public $translatable = ['title'];

    public function products()
    {
        return $this->hasMany(StafExtraToProduct::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

}
