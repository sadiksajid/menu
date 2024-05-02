<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Scopes\UserApps;

class Activity extends Model
{
    use HasFactory;
    protected static function booted()
    {
        static::addGlobalScope(new UserApps);
    }
}
