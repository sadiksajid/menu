<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;

class SetLocale
{
    public function handle($request, Closure $next)
    {
        if(Request()->route()->getPrefix() == '/admin'){

            $locale = Session::get('locale_admin', config('app.locale'));
            App::setLocale($locale);

            $translations = json_decode(file_get_contents(storage_path('app/Public/translate_admin.json')), true);

   
            $Lang_ranslations = collect($translations)
                ->mapWithKeys(function ($translation, $key) use ($locale) {
                    return [$key => $translation[$locale] ?? $translation['en']];
                })
                ->toArray();
                App::singleton('translations_admin', function () use ($Lang_ranslations) {
                return $Lang_ranslations;
            });


        }else{

            $locale = Session::get('locale_user', config('app.locale'));
            App::setLocale($locale);
    
            $translations = json_decode(file_get_contents(storage_path('app/Public/translate.json')), true);
            $translations_resto = json_decode(file_get_contents(storage_path('app/Public/translate_resto.json')), true);
    
 
            $Lang_ranslations = collect($translations)
                ->mapWithKeys(function ($translation, $key) use ($locale) {
                    return [$key => $translation[$locale] ?? $translation['en']];
                })
                ->toArray();
    
            $Lang_ranslations_resto = collect($translations_resto)
                ->mapWithKeys(function ($translation, $key) use ($locale) {
                    return [$key => $translation[$locale] ?? $translation['en']];
                })
                ->toArray();
                App::singleton('translations', function () use ($Lang_ranslations, $Lang_ranslations_resto) {
                return array(
                    'system' => $Lang_ranslations,
                    'resto' => $Lang_ranslations_resto,
                );
            });
    


        }
       


        return $next($request);
    }
}