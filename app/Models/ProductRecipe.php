<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductRecipe extends Model
{
    use HasFactory;
    protected $fillable = [
        'element',
        'store_product_id',
        'created_at',
        'updated_at',
    ];
    
    public function product()
    {
        return $this->belongsTo(StoreProduct::class, 'store_product_id');
    }
}
