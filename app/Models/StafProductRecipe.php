<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StafProductRecipe extends Model
{
    use HasFactory;
    protected $fillable = [
        'element',
        'staf_product_id',
        'created_at',
        'updated_at',
    ];
    
    public function product()
    {
        return $this->belongsTo(StafProduct::class, 'staf_product_id');
    }
}
