<?php

namespace App\Providers;

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\ServiceProvider;

class TranslationServiceProvider extends ServiceProvider
{


    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        if(config('app.env') === 'dev') {
            Cache::flush(); // only in development mode
        }
        Cache::rememberForever('translations', function () {
            $translations = collect();

            foreach (config('app.locales') as $locale) {

                $langPath = resource_path('lang/' . $locale);

                $translations[$locale] = collect(File::allFiles($langPath))->flatMap(function ($file) use ($locale) {
                    return [
                        ($translation = $file->getBasename('.php')) => trans($translation, [], $locale),
                    ];
                });
            }

            return $translations->toJson();
        });

    }
}
