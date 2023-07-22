<?php

namespace App\Providers;
use App\Models\User;
use App\Repositories\Eloquent\EloquentUserRepository;
use App\Repositories\Interfaces\UserRepository;
use Illuminate\Support\ServiceProvider;

class RepositoriesServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        /**
         * Repository
         */
        // $this->app->bind();


        /**
         * Repository User
         */
        $this->app->bind(
            UserRepository::class,
            function(){
                $repository = new EloquentUserRepository(new User());
                return $repository;
            }
        );

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
