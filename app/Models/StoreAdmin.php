<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class StoreAdmin extends Authenticatable
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'password',
        'telephone',
        'created_at',
        'is_admin',
        'status',
        'store_id',

    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];
    
    public function store()
    {
        return $this->belongsTo(Store::class, 'store_id');
    }

    public function token()
    {
        return $this->hasMany(StoreAdminToken::class);
    }

}
