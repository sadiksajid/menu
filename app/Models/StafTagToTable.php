<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StafTagToTable extends Model
{
    use HasFactory;

    public function tags()
    {
        return $this->belongsTo(StafTag::class);
    }


    
}
