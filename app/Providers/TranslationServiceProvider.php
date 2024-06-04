<?php

namespace App\Providers;

use Illuminate\Support\Facades\Cache;
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
        $translations = json_decode(file_get_contents(storage_path('app/Public/translate.json')), true);
        $translations_resto = json_decode(file_get_contents(storage_path('app/Public/translate_resto.json')), true);
        $translations_home = json_decode(file_get_contents(storage_path('app/Public/translate_home.json')), true);

        if (Cache::has('locale_user')) {
            $currentLocale = Cache::get('locale_user');
        } else {
            $currentLocale = 'en';
        }
        app()->setLocale($currentLocale);


        ////////////////////// admin
        $Lang_ranslations = collect($translations)
            ->mapWithKeys(function ($translation, $key) use ($currentLocale) {
                return [$key => $translation[$currentLocale] ?? $translation['en']];
            })
            ->toArray();

        ////////////////////// resto fueturs 

        $Lang_ranslations_resto = collect($translations_resto)
            ->mapWithKeys(function ($translation, $key) use ($currentLocale) {
                return [$key => $translation[$currentLocale] ?? $translation['en']];
            })
            ->toArray();

        //////////////////////  home
        
        $Lang_ranslations_home = collect($translations_home)
            ->mapWithKeys(function ($translation, $key) use ($currentLocale) {
                return [$key => $translation[$currentLocale] ?? $translation['en']];
            })
            ->toArray();

        $this->app->singleton('translations', function () use ($Lang_ranslations, $Lang_ranslations_resto,$Lang_ranslations_home) {
            return array(
                'system' => $Lang_ranslations,
                'resto' => $Lang_ranslations_resto,
                'home' => $Lang_ranslations_home,
            );
        });
    }
}
