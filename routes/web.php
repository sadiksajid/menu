<?php

use App\Models\Offer;
use App\Models\Store;
use App\Models\Client;
use App\Events\CaiseOrder;
use App\Models\StoreProduct;
use Illuminate\Http\Request;
use App\Models\ShippingCompany;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Broadcast;
use App\Http\Controllers\OrdersController;
use App\Http\Controllers\ClientsController;
use App\Http\Controllers\Admin\apksController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\StafAuthController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\DataTables\ShippingCompaniesDataTable;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
 */
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// admi

Route::get('/password/confirm', 'PasswordConfirmationController@showConfirmForm')->name('password.confirm.form');
Route::post('/password/confirm', 'PasswordConfirmationController@confirm')->name('password.confirm');
Route::post('/checkPasswordAdmin'    ,[PasswordConfirmationController::class, 'confirmApi'])->name('check_admin_password');
Route::post('/checkCodedAdmin'    ,[PasswordConfirmationController::class, 'confirmApiCode'])->name('check_admin_code');

Route::group(['prefix' => 'admin', 'middleware' => ['auth:web', 'password.confirmation', 'fw-block-blacklisted', 'fw-block-attacks']], function () {



    Route::get('/', function () {

        return redirect('/admin/dashboard');

    });

    Route::post('/change_lang', function (Request $request) {
        $lang = $request->input('lang');
        if ($lang == 'ma') {
            $lang = 'ar';
        }
        Session::put('locale_admin', $lang);
        return back();
    })->name('change_lang');

    Route::get('/homeEdit', function () {
        return view('livewire.admin.index1.index_route');
    });
    Route::get('/caisse ', function () {
        return view('livewire.admin.caisse.caisse_route');   
    });

    Route::get('/caisse/ads ', function () {
        return view('livewire.admin.caisse.caisse_ads');
    });

    Route::get('/categories ', function () {
        return view('livewire.admin.categories.categories_route');
    });

    Route::get('/security_code ', function () {
        return view('livewire.admin.security_code.security_code_route');
    });



    Route::get('/MenuEdit', function () {
        return view('livewire.admin.menu1.menu_route');
    });

    Route::get('/HeadesEdit', function () {
        return view('livewire.admin.headers_edit.headers_route');
    });
    Route::get('/HomeHeaderEdit', function () {
        return view('livewire.admin.home_header_edit.Home_header_route');
    });

    // Route::get('/linkStorage', [apksController::class, 'linkstorage']);

    Route::get('/products/{page?}/{id?}', function ($page = null, $id = null) {
        return view('livewire.admin.products.products_route', ['page' => $page ?? null, 'id' => $id ?? null]);
    })->name('admin.products');

    Route::get('/offers/{page?}/{id?}', function ($page = null, $id = null) {
        return view('livewire.admin.offers.offers_route', ['page' => $page ?? null, 'id' => $id ?? null]);
    });

    Route::get('/store_info', function () {
        return view('livewire.admin.storeInfo.store_info');
    });

    Route::get('/dashboard', function () {
        if(Auth::user()->store == null){
            Auth::logout();
            return redirect('/');

        }
        return view('livewire.admin.dashboard.dashboard_route');
    });

    Route::get('/orders', [OrdersController::class, 'index'])->name('orders.index');
    Route::get('/orders/details/{id}', function ($id) {
        return view('livewire.admin.orders.orders_route', ['type' => 'details', 'id' => $id]);
    });

    Route::get('/clients', [ClientsController::class, 'index'])->name('clients.index');
    Route::get('/clients/details/{id}', function ($id) {
        $client = Client::join('client_stores', 'client_stores.client_id', 'clients.id')
            ->select('clients.id', 'clients.firstname', 'clients.lastname', 'clients.email', 'clients.phone', 'client_stores.status', 'client_stores.trusted'
                , DB::raw("DATE_FORMAT(client_stores.created_at, '%Y-%m-%d') as join_date"))
            ->where('client_stores.store_id', Auth::user()->store->id)
            ->where('clients.id', $id)
            ->withCount('orders')
            ->first();
        if (!empty($client)) {
            return view('livewire.admin.clients.clients_route', ['client' => $client, 'type' => 'details']);
        } else {
            return view('404');
        }
    });

    Route::get('/marketing', function () {
        return view('livewire.admin.marketing.marketing_route');
    });


    Route::get('/shipping_companies', function () {
        return view('livewire.admin.shipping_companies.shipping_companies_route' );
    });

    route::post('/datatables/shipping_companies/list', ['as' => 'datatables.shipping_companies_admin.list', 'uses' => 'ShippingCompaniesDataTable@ShippingCompaniesListAdmin']);

    ////////////////
    Route::get('/shipping_companies/integration/{tag}', function ($tag) {

        $company_info = ShippingCompany::where('tag',$tag)
        ->where('status',1)
        ->first();
        if(!empty($company_info)){
            if(empty($company_info->getShippingCompanyIntegrationStore())){
                return view('livewire.admin.shipping_companies_integration.shipping_companies_integration_route',['tag'=>$tag,'company_info' => $company_info] );
            }else{
                return redirect('/admin/shipping_companies');
            }
        }else{
            return redirect('/admin/shipping_companies');
        }
        

    });



});
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
Route::group(['prefix' => 'client', 'middleware' => ['auth:client', 'fw-block-blacklisted', 'fw-block-attacks']], function () {

    Route::get('/my_orders', function () {
        return view('livewire.Client.my_orders.my_orders_route');
    });
});

Route::group(['middleware' => ['fw-block-blacklisted', 'fw-block-attacks', 'web']], function () {

    Route::get('/store/{store_meta}/{category?}', function ($store_meta, $category = null) {
        $store_info = Store::where('store_meta', $store_meta)->first();
        if (!empty($store_info)) {
            if ($store_info->status == 1) {
                return view('livewire.store.store_route', ['store_info' => $store_info, 'category' => $category]);
            } else {
                return view('desabled');
            }
        } else {
            return view('404');
        }
    });

    Route::get('/store/{store_meta}/product/{product}', function ($store_meta, $product) {
        $store_info = Store::where('store_meta', $store_meta)->first();
        if (!empty($store_info)) {
            if ($store_info->status == 1) {
                $product_info = StoreProduct::where('product_meta', $product)->where('status', 1)->first();
                if (!empty($product_info)) {
                    return view('livewire.product.product_route', ['store_info' => $store_info, 'product_info' => $product_info]);
                } else {
                    return view('404');
                }
            } else {
                return view('desabled');
            }
        } else {
            return view('404');
        }
    });

    Route::get('/shop/{category?}', function ($category = null) {
        $store_info = Store::where('store_meta', env('STOR_NAME'))->first();
        if (!empty($store_info)) {
            if ($store_info->status == 1) {
                return view('livewire.store.store_route', ['store_info' => $store_info, 'category' => $category]);
            } else {
                return view('desabled');
            }
        } else {
            return view('404');
        }
    });

    Route::get('/shop/product/{product}', function ($product) {
        $store_info = Store::where('store_meta', env('STOR_NAME'))->first();
        if (!empty($store_info)) {
            if ($store_info->status == 1) {
                $product_info = StoreProduct::where('product_meta', $product)->where('status', 1)->first();
                if (!empty($product_info)) {
                    return view('livewire.product.product_route', ['store_info' => $store_info, 'product_info' => $product_info]);
                } else {
                    return view('404');
                }
            } else {
                return view('desabled');
            }
        } else {
            return view('404');
        }
    });
    Route::get('/shop/offer/{meta}', function ($meta) {
        $store_info = Store::where('store_meta', env('STOR_NAME'))->first();
        if (!empty($store_info)) {
            if ($store_info->status == 1) {
                $offer = Offer::where('offer_meta', $meta)->where('status', 1)
                    ->with(['products' => function ($q) {
                        $q->with(['product' => function ($q) {
                            $q->with('media');

                        }]);
                    }])->first();

                if (!empty($offer)) {
                    return view('livewire.offer.offer_route', ['store_info' => $store_info, 'offer' => $offer]);
                } else {
                    return view('404');
                }
            } else {
                return view('desabled');
            }
        } else {
            return view('404');
        }
    });

    // Route::get('/shop/offers', function ($category = null) {
    //     $store_info = Store::where('store_meta', env('STOR_NAME'))->first();
    //     if (!empty($store_info)) {
    //         if ($store_info->status == 1) {
    //             return view('livewire.offers.offers_route', ['store_info' => $store_info]);
    //         } else {
    //             return view('desabled');
    //         }
    //     } else {
    //         return view('404');
    //     }
    // });

    // Route::get('/store/{store_meta}/operation/cart', function ($store_meta) {
    //     $store_info = Store::where('store_meta', $store_meta)->first();
    //     if (!empty($store_info)) {
    //         if ($store_info->status == 1) {
    //             return view('livewire.cart.cart_route', ['store_info' => $store_info]);
    //         } else {
    //             return view('desabled');
    //         }
    //     } else {
    //         return view('404');
    //     }
    // });

    Route::get('/client/cart', function () {

        return view('livewire.cart.cart_route');

    });

    // Route::get('/store/{store_meta}/operation/checkout', function ($store_meta) {
    //     $store_info = Store::where('store_meta', $store_meta)->first();
    //     if (!empty($store_info)) {
    //         if ($store_info->status == 1) {
    //             return view('livewire.checkout.checkout_route', ['store_info' => $store_info]);
    //         } else {
    //             return view('desabled');
    //         }
    //     } else {
    //         return view('404');
    //     }
    // });

    Route::get('/client/checkout', function () {
        return view('livewire.checkout.checkout_route');
    });

    Route::get('/to_competition', function () {
        $store_info = Store::where('store_meta', env('STOR_NAME'))->first();
        if (!empty($store_info)) {
            if ($store_info->status == 1) {
                return view('livewire.index1.index_route', ['scroll' => true]);
            } else {
                return view('desabled');
            }
        } else {
            return view('404');
        }
    })->name('to_competition');

    Route::get('/', function () {
        return view('livewire.home.home_route');
    })->name('index');

    Route::get('/contact-us', function () {
        return view('livewire.contact.contact_route');
    })->name('contact-us');


    Route::get('/home', function () {
        $store_info = Store::where('store_meta', env('STOR_NAME'))->first();
        if (!empty($store_info)) {
            if ($store_info->status == 1) {
                return view('livewire.index1.index_route');
            } else {
                return view('desabled');
            }
        } else {
            return view('404');
        }
    })->name('home');

    Route::get('/{tag}/menu', function ($tag) {
        $store_info = Store::where('store_meta', $tag)->first();
        if (!empty($store_info)) {
            if ($store_info->status == 1) {
                return view('livewire.menu1.menu_route',['store'=>$store_info]);
            } else {
                return view('desabled');
            }
        } else {
            return view('404');
        }
    });

    Route::get('/contact_us', function () {
        $store_info = Store::where('store_meta', env('STOR_NAME'))->first();
        if (!empty($store_info)) {
            if ($store_info->status == 1) {
                return view('livewire.contact_us.contact_us_route',['store_info'=>$store_info]);
            } else {
                return view('desabled');
            }
        } else {
            return view('404');
        }
    });


    Route::get('/maps', function () {
        $store_info = Store::where('store_meta', env('STOR_NAME'))->first();
        if (!empty($store_info)) {
            if ($store_info->status == 1) {
                return view('livewire.maps.maps_route');
            } else {
                return view('desabled');
            }
        } else {
            return view('404');
        }
    });


    Route::get('/competition/{id?}', function ($id = null) {
        return view('livewire.competition.competition_route', ['id' => $id]);
    });

    Route::get('/login', 'Auth\LoginController@showLoginForm')->name('show-login');
    Route::post('/login', 'Auth\LoginController@login')->name('login');
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
    Route::get('/password/reset', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
    Route::post('/password/email', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
    Route::get('/password/reset/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
    Route::post('/password/reset', [ResetPasswordController::class, 'reset'])->name('password.update');
    // Route::get('/register', [RegisterController::class, 'RegisterForm'])->name('register');
    Route::get('/register', function () {

        return redirect('/');

    });
    Route::post('/register', [RegisterController::class, 'Register'])->name('register.post');

    // Route::post('/cient_login', [ClientAuthController::class, 'login'])->name('client.login.post');
    // Route::post('/cient_register', [ClientRegisterController::class, 'clientRegister'])->name('client.register.post');
    Route::get('/staf_login', [StafAuthController::class, 'showLoginForm'])->name('staf-show-login');
    Route::post('/staf_login', [StafAuthController::class, 'login'])->name('staf_login');
    Route::post('/staf_logout', [StafAuthController::class, 'logout'])->name('staf_logout');


});



//////////////////////////////////////////// super admin

Route::group(['prefix' => 'staf', 'middleware' => ['auth:staf', 'fw-block-blacklisted', 'fw-block-attacks']], function () {

    Route::get('/', function () {

        return redirect('/staf/dashboard');

    })->name('staf.home');

    Route::post('/change_lang', function (Request $request) {
        $lang = $request->input('lang');
        if ($lang == 'ma') {
            $lang = 'ar';
        }
        Cache::put('locale_admin', $lang, 86400);
        return back();
    })->name('staf_change_lang');


    Route::get('/linkStorage', [apksController::class, 'linkstorage']);

    Route::get('/products/{page?}/{id?}', function ($page = null, $id = null) {
        return view('livewire.staf.products.products_route', ['page' => $page ?? null, 'id' => $id ?? null]);
    })->name('staf.products');

    Route::get('/offers/{page?}/{id?}', function ($page = null, $id = null) {
        return view('livewire.admin.offers.offers_route', ['page' => $page ?? null, 'id' => $id ?? null]);
    });

    Route::get('/header_images', function () {
        return view('livewire.staf.header_images.header_images_route' );
    });


    Route::get('/dashboard', function () {
        return view('livewire.admin.dashboard.dashboard_route');
    })->name('staf.dashboard');


    Route::get('/clients', [ClientsController::class, 'index'])->name('staf_clients.index');
    Route::get('/clients/details/{id}', function ($id) {
        $client = Client::join('client_stores', 'client_stores.client_id', 'clients.id')
            ->select('clients.id', 'clients.firstname', 'clients.lastname', 'clients.email', 'clients.phone', 'client_stores.status', 'client_stores.trusted'
                , DB::raw("DATE_FORMAT(client_stores.created_at, '%Y-%m-%d') as join_date"))
            ->where('client_stores.store_id', Auth::user()->store->id)
            ->where('clients.id', $id)
            ->withCount('orders')
            ->first();
        if (!empty($client)) {
            return view('livewire.admin.clients.clients_route', ['client' => $client, 'type' => 'details']);
        } else {
            return view('404');
        }
    });

    Route::get('/qr_code', function () {
        return view('livewire.staf.qr_code.qr_code_route' );
    });
    Route::get('/shipping_companies', function () {
        return view('livewire.staf.shipping_companies.shipping_companies_route',['type'=>'list'] );
    });
    Route::get('/shipping_companies/add', function () {
        return view('livewire.staf.shipping_companies.shipping_companies_route',['type'=>'add'] );
    });
    Route::get('/shipping_companies/edit/{id}', function ($id) {
        return view('livewire.staf.shipping_companies.shipping_companies_route',['type'=>'edit','id'=>$id] );
    });
    route::post('/datatables/shipping_companies/list', ['as' => 'datatables.shipping_companies.list', 'uses' => 'ShippingCompaniesDataTable@ShippingCompaniesList']);

});
