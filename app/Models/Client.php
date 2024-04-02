<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Client extends Authenticatable
{
    use HasFactory, Notifiable;
    protected $guard = 'client';

    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'phone',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function findForPassport($phone)
    {
        return $this->where('phone', $phone)->first();
    }

    public function client_address()
    {
        return $this->hasMany(ClientAddress::class);
    }

    public function token()
    {
        return $this->hasMany(ClientAddress::class);
    }

    public function orders()
    {
        return $this->hasMany(StoreOrder::class);
    }

    public function stores()
    {
        return $this->hasMany(ClientStore::class);
    }

    public function notification()
    {
        return $this->hasMany(StoreToClientNotification::class);
    }

    public function product_view()
    {
        return $this->hasMany(ProductView::class);
    }

    public function apk_view()
    {
        return $this->hasMany(ApkView::class);
    }
}
