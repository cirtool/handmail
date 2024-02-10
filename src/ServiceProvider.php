<?php
 
namespace Cirtool\Handmail;

use Cirtool\Handmail\Livewire\Form\FileUploader;
use Cirtool\Handmail\Livewire\Templates\ShowAllTemplates;
use Cirtool\Handmail\Livewire\Templates\CreateTemplate;
use Cirtool\Handmail\Livewire\Templates\EditTemplate;
use Livewire\Livewire;
use Illuminate\Contracts\Foundation\Application;
 
class ServiceProvider extends \Illuminate\Support\ServiceProvider
{
    /**
     * Bootstrap any application services.
     */
    public function boot(Handmail $handmail): void
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
        Livewire::component('handmail::edit-template', EditTemplate::class);

        Livewire::component('handmail::file-uploader', FileUploader::class);

        $handmail->discoverBlocks(config('handmail.blocks.path'));
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
