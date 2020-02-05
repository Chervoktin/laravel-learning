<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use IPostRepository;
use ArrayRepository;
use PostRepository;
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
        $this->app->bind(IPostRepository::class, PostRepository::class );
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
