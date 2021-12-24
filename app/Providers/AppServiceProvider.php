<?php

namespace App\Providers;

use App\Repository\Contracts\ContractRepository;
use App\Repository\Contracts\ContractRepositoryInterface;
use App\Repository\Users\UserRepository;
use App\Repository\Users\UserRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
        $this->app->bind(ContractRepositoryInterface::class, ContractRepository::class);
    }
}
