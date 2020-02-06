<?php

namespace App\Providers;

use CardRepository;
use ICardRepository;
use Illuminate\Support\ServiceProvider;

class CardRepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(ICardRepository::class, CardRepository::class);
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
