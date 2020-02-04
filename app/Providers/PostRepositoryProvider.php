<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use IPostRepository;
use ArrayRepository;
use Post;
class PostRepositoryProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(IPostRepository::class, ArrayRepository::class );
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
