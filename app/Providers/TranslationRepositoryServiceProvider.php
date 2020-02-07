<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use TranslationRepository;
use ITranslationRepository;
class TranslationRepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(ITranslationRepository::class, \TranslationRepository::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
