<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StoreToClientNotification extends Model
{
    use HasFactory;

    public function store()
    {
        return $this->belongsTo(Store::class, 'store_id');
    }

    public function client()
    {
        return $this->belongsTo(Client::class, 'client_id');
    }
}
