<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StafExtraToProduct extends Model
{
    use HasFactory;
    public function product()
    {
        return $this->belongsTo(StafProduct::class, 'staf_product_id');
    }

    public function extra()
    {
        return $this->belongsTo(StafProductExtra::class, 'staf_product_extra_id');
    }
}
