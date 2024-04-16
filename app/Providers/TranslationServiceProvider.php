<?php

namespace App\Providers;

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
        $translations = json_decode(file_get_contents(storage_path('app/Public/translate.json')), true);
        $translations_resto = json_decode(file_get_contents(storage_path('app/Public/translate_resto.json')), true);

        $this->app->singleton('translations', function () use ($translations, $translations_resto) {
            return array(
                'system' => $translations,
                'resto' => $translations_resto,
            );
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
