<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ApkSocial extends Model
{
    use HasFactory;

    protected $fillable = [
        'apk_id',
        'social_media',
        'link',
        'created_at',
        'updated_at',
    ];
    public function Apk()
    {
        return $this->belongsTo(Apk::class, 'apk_id');
    }
    
}
