<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QrCodeTemplate extends Model
{
    use HasFactory;

    protected $casts = [
        'image' => 'array',
        'qr_config' => 'array',
        'logo_config' => 'array',
        'phone1_config' => 'array',
        'phone2_config' => 'array',
        'email_config' => 'array',
        'title_config' => 'array',
    ];
}
