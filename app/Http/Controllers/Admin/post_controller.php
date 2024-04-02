<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class post_controller extends Controller
{
    public function PostsManage()
    {
        return view('admin.mains-admin.posts.posts-list');
    }

   
}
