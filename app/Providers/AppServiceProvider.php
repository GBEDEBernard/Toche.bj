<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    
    public function register(): void
    {
        //
        $loader = \Illuminate\Foundation\AliasLoader::getInstance();
        $loader->alias('Debugbar', \Barryvdh\Debugbar\Facades\Debugbar::class);
    }

    public const HOME = '/login';

    /**
     * Bootstrap any application services.
     */
    public function boot()
{
    // vient du fait que tu utilises http:// au lieu de https://.  correction pour forcer à chaque formulaire
    if (env('APP_ENV') === 'production') {
        URL::forceScheme('https');
    }
}
   
}
