<?php

namespace App\Providers;

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\ServiceProvider;

class TranslationServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {

    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // $translations = json_decode(file_get_contents(storage_path('app/Public/translate.json')), true);
        // $translations_resto = json_decode(file_get_contents(storage_path('app/Public/translate_resto.json')), true);
        // // Cache::put('locale_user', 'en', 1440);
        // // Cache::clear('locale_user');

        // // if (Cache::has('locale_user')) {
        // //     $currentLocale = Cache::get('locale_user');
        // // } else {
        // //     $currentLocale = 'en';
        // // }

        // if (Session::has('locale_user')) {
        //     $currentLocale = Session::get('locale_user', config('app.locale'));
        // } else {
        //     $currentLocale = 'en';
        // }

        // app()->setLocale($currentLocale);


        // $Lang_ranslations = collect($translations)
        //     ->mapWithKeys(function ($translation, $key) use ($currentLocale) {
        //         return [$key => $translation[$currentLocale] ?? $translation['en']];
        //     })
        //     ->toArray();

        // $Lang_ranslations_resto = collect($translations_resto)
        //     ->mapWithKeys(function ($translation, $key) use ($currentLocale) {
        //         return [$key => $translation[$currentLocale] ?? $translation['en']];
        //     })
        //     ->toArray();
        // $this->app->singleton('translations', function () use ($Lang_ranslations, $Lang_ranslations_resto) {
        //     return array(
        //         'system' => $Lang_ranslations,
        //         'resto' => $Lang_ranslations_resto,
        //     );
        // });
    }
}
