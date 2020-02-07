<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use IWordRepository;
use WordRepository;
class WordRepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(IWordRepository::class, WordRepository::class);
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
