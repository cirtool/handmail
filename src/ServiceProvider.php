<?php
 
namespace Cirtool\Handmail;

use Illuminate\Contracts\Foundation\Application;
 
class ServiceProvider extends \Illuminate\Support\ServiceProvider
{
    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $this->loadRoutesFrom(__DIR__.'/../routes/web.php');
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'handmail');
        $this->loadTranslationsFrom(__DIR__.'/../lang', 'handmail');

        $this->publishes([
            __DIR__.'/../config/handmail.php' => config_path('handmail.php'),
        ], 'handmail-config');

        $this->publishes([
            __DIR__.'/../resources/views' => resource_path('views/vendor/courier'),
        ], 'handmail-views');

        $this->publishes([
            __DIR__.'/../public' => public_path('vendor/handmail'),
        ], 'public');
    }

    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__.'/../config/handmail.php', 'handmail');
    }
}
