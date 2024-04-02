<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ApkNotification extends Controller
{
    public function SendNotification()
    {
        return view('admin.mains-admin.notapk.not_apk');
    }
}
