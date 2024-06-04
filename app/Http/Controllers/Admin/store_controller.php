<?php
namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class store_controller extends Controller
{
    public function StoreManage()
    {
        return view('admin.mains-admin.store.store-manage');
    }
}
