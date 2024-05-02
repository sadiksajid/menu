<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Scopes\UserApps;
class ApkView extends Model
{
    use HasFactory;


    public function client()
    {
        return $this->belongsTo(Client::class, 'client_id');
    }


}
