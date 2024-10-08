<?php

namespace Workbench\App\Providers;

use Illuminate\Support\ServiceProvider;
use Cirtool\Handmail\Handmail;

class WorkbenchServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(Handmail $handmail): void
    {
        // $handmail->discoverBlocks(resource_path('views/handmail'));
    }
}
