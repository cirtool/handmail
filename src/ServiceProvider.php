<?php
 
namespace Cirtool\Handmail;

use Livewire\Livewire;
use Illuminate\Contracts\Foundation\Application;
use Cirtool\Handmail\Livewire\Templates\ShowAllTemplates;
use Cirtool\Handmail\Livewire\Templates\CreateTemplate;
 
class ServiceProvider extends \Illuminate\Support\ServiceProvider
{
    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $this->loadRoutesFrom(__DIR__.'/../routes/web.php');
        $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
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

        Livewire::component('handmail::show-all-template', ShowAllTemplates::class);
        Livewire::component('handmail::create-template', CreateTemplate::class);
    }

    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__.'/../config/handmail.php', 'handmail');

        $this->app->singleton(Handmail::class, function (Application $app) {
            return new Handmail;
        });
        $this->app->alias(Handmail::class, 'cirtool.handmail');
    }
}
