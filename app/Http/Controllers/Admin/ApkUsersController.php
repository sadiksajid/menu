<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ApkUsersController extends Controller
{
    public function ApkUsersList()
    {        
        return view('admin.mains-admin.apk_users.apk_users_list');
    }
}
