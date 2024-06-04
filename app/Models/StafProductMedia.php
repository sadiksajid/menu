<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StafProductMedia extends Model
{
    use HasFactory;
    public function product()
    {
        return $this->belongsTo(StafProduct::class, 'staf_product_id');
    }

}
