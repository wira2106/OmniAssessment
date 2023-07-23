<?php

namespace App\Providers;
use App\Models\User;
use App\Models\UserToken;
use App\Repositories\Eloquent\EloquentUserRepository;
use App\Repositories\Eloquent\EloquentUserTokenRepository;
use App\Repositories\Interfaces\UserRepository;
use App\Repositories\Interfaces\UserTokenRepository;
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
        /**
         * Repository User Token
         */
        $this->app->bind(
            UserTokenRepository::class,
            function(){
                $repository = new EloquentUserTokenRepository(new UserToken());
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
