<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class apksController extends Controller
{
    public function apks()
    {
        return view('admin.mains-admin.apks.apks-list');
    }

    public function ApkToAdmin()
    {
        if (Auth::User()->is_admin == 1) {
            return view('admin.mains-admin.apks.apks-to-admin');
        } else {
            return redirect('/admin/dashboard');
        }
    }
    public function linkstorage()
    {
        $var = '';

        try {
            $targetFolder = $_SERVER['DOCUMENT_ROOT'] . '/storage/app/Public';
            $linkFolder = $_SERVER['DOCUMENT_ROOT'] . '/public/storage';
            symlink($targetFolder, $linkFolder);
            $var .= 'Ok public - ';
        } catch (\Throwable $th) {
            $var .= 'No public - ';
        }

        try {
            $targetFolder = $_SERVER['DOCUMENT_ROOT'] . '/storage/app/Public/product_extras';
            $linkFolder = $_SERVER['DOCUMENT_ROOT'] . '/public/storage/product_extras';
            symlink($targetFolder, $linkFolder);
            $var .= 'Ok product_extras - ';
        } catch (\Throwable $th) {
            $var .= 'No product_extras - ';
        }

        try {
            $targetFolder = $_SERVER['DOCUMENT_ROOT'] . '/storage/app/Public/categories';
            $linkFolder = $_SERVER['DOCUMENT_ROOT'] . '/public/storage/categories';
            symlink($targetFolder, $linkFolder);
            $var .= 'Ok categories - ';
        } catch (\Throwable $th) {
            $var .= 'No categories - ';
        }

        try {
            $targetFolder = $_SERVER['DOCUMENT_ROOT'] . '/storage/app/Public/product_images';
            $linkFolder = $_SERVER['DOCUMENT_ROOT'] . '/public/storage/product_images';
            symlink($targetFolder, $linkFolder);
            $var .= 'Ok product_images - ';
        } catch (\Throwable $th) {
            $var .= 'No product_images - ';
        }

        try {
            $targetFolder = $_SERVER['DOCUMENT_ROOT'] . '/storage/app/Public/extra_images';
            $linkFolder = $_SERVER['DOCUMENT_ROOT'] . '/public/storage/extra_images';
            symlink($targetFolder, $linkFolder);
            $var .= 'Ok extra_images - ';
        } catch (\Throwable $th) {
            $var .= 'No extra_images - ';
        }

        try {
            $targetFolder = $_SERVER['DOCUMENT_ROOT'] . '/storage/app/Public/store_logo';
            $linkFolder = $_SERVER['DOCUMENT_ROOT'] . '/public/storage/store_logo';
            symlink($targetFolder, $linkFolder);
            $var .= 'Ok store_logo - ';
        } catch (\Throwable $th) {
            $var .= 'No store_logo - ';
        }

        return $var;
    }
}