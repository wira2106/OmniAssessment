<?php

namespace App\Providers;

use App\Models\Company;
use App\Models\KoreksiFiskal;
use App\Models\Neraca;
use App\Models\Pegawai;
use App\Models\PerhitunganPPh21;
use App\Models\StatusPegawai;
use App\Models\User;
use App\Repositories\Eloquent\EloquentCompanyRepository;
use App\Repositories\Eloquent\EloquentKoreksiFiskalRepository;
use App\Repositories\Eloquent\EloquentNeracaRepository;
use App\Repositories\Eloquent\EloquentPegawaiRepository;
use App\Repositories\Eloquent\EloquentPerhitunganPPh21Repository;
use App\Repositories\Eloquent\EloquentStatusPegawaiRepository;
use App\Repositories\Eloquent\EloquentUserRepository;
use App\Repositories\Interfaces\CompanyRepository;
use App\Repositories\Interfaces\KoreksiFiskalRepository;
use App\Repositories\Interfaces\NeracaRepository;
use App\Repositories\Interfaces\PegawaiRepository;
use App\Repositories\Interfaces\PerhitunganPPh21Repository;
use App\Repositories\Interfaces\StatusPegawaiRepository;
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

        /**
         * Repository Company
         */
        $this->app->bind(
            CompanyRepository::class,
            function(){
                $repository = new EloquentCompanyRepository(new Company());
                return $repository;
            }
        );

        /**
         * Repository Pegawai
         */
        $this->app->bind(
            PegawaiRepository::class,
            function(){
                $repository = new EloquentPegawaiRepository(new Pegawai());
                return $repository;
            }
        );

        /**
         * Repository StatusPegawai
         */
        $this->app->bind(
            StatusPegawaiRepository::class,
            function(){
                $repository = new EloquentStatusPegawaiRepository(new StatusPegawai());
                return $repository;
            }
        );

        /**
         * Repository PerhitunganPPh21
         */
        $this->app->bind(
            PerhitunganPPh21Repository::class,
            function(){
                $repository = new EloquentPerhitunganPPh21Repository(new PerhitunganPPh21());
                return $repository;
            }
        );
        /**
         * Repository Koreksi Fiskal
         */
        $this->app->bind(
            KoreksiFiskalRepository::class,
            function(){
                $repository = new EloquentKoreksiFiskalRepository(new KoreksiFiskal());
                return $repository;
            }
        );

        /**
         * Repository Neraca
         */
        $this->app->bind(
            NeracaRepository::class,
            function(){
                $repository = new EloquentNeracaRepository(new Neraca());
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
