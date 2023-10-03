<?php

use Illuminate\Support\Facades\Route;
use Cirtool\Handmail\Livewire\Templates\ShowAllTemplates;
use Cirtool\Handmail\Livewire\Templates\EditTemplate;
use Cirtool\Handmail\Livewire\Emails\ShowAllEmails;

if (config('handmail.panel.is_active', false)) {
    Route::prefix('handmail')
        ->name('handmail.')
        ->middleware(config('handmail.panel.middlewares', 'web'))
        ->group(function () {
            Route::get('/templates', ShowAllTemplates::class)->name('templates');
            Route::get('/templates/{template}/edit', EditTemplate::class)->name('edit-template');
            Route::get('/emails', ShowAllEmails::class)->name('emails');
        });
}
