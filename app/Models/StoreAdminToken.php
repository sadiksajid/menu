<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StoreAdminToken extends Model
{
    use HasFactory;

    public function store_admin()
    {
        return $this->belongsTo(StoreAdmin::class, 'store_admin_id');
    }
}
