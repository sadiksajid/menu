<?php

namespace App\Providers;

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\ServiceProvider;

class TranslationAdminServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {

    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $translations = json_decode(file_get_contents(storage_path('app/Public/translate_admin.json')), true);

        if (Cache::has('locale_admin')) {
            $currentLocale = Cache::get('locale_admin');
        } else {
            $currentLocale = 'en';
        }
        app()->setLocale($currentLocale);

        $Lang_ranslations = collect($translations)
            ->mapWithKeys(function ($translation, $key) use ($currentLocale) {
                return [$key => $translation[$currentLocale] ?? $translation['en']];
            })
            ->toArray();
        $this->app->singleton('translations_admin', function () use ($Lang_ranslations) {
            return $Lang_ranslations;
        });
    }
}
