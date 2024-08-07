<?php

use Illuminate\Http\Request;
use App\Http\Controllers\VueAPI;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiController;
use App\Http\Controllers\ShippingCompaniesAPI;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::middleware('auth:api')->post('/shipping_company_status'    ,[ShippingCompaniesAPI::class, 'CompanyIntegrationStatus']);// good


// Route::get('/apkInfo'    ,[ApiController::class, 'ApkInfo']);// good
// Route::get('/appLinks'   ,[ApiController::class, 'AppLinks']);// good
// Route::get('/allWallpappers'   ,[ApiController::class, 'AllWallpappers']);// good
// Route::get('/getWallpapper'    ,[ApiController::class, 'GetWallpapper']); // good
// Route::get('/wallpapperView',[ApiController::class, 'WallpapperViews']);// good

// Route::get('/newApkUser'  ,[ApiController::class, 'AddApkUser']);// good 
// Route::get('/apkView'    ,[ApiController::class, 'ApkView']); // good 
// Route::get('/apkDelete'  ,[ApiController::class, 'ApkDelete']);
// Route::get('/searchWallpapper' ,[ApiController::class, 'SearchWallpapper']);// good 
// Route::get('/allProducts',[ApiController::class, 'AllProducts']);// good 
// Route::get('/productView',[ApiController::class, 'ProductView']);
// Route::get('/newToken'   ,[ApiController::class, 'AddToken']);
// ///////////////////////////// for vuejs
// Route::get('/getColor'   ,[VueAPI::class, 'GetColor']);
// Route::get('/allApps'    ,[VueAPI::class, 'AllApps']);
// Route::post('/contactUs' ,[VueAPI::class, 'ContactForm']);

