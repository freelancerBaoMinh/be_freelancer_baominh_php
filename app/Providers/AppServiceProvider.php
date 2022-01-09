<?php

namespace App\Providers;

use App\Repository\Compensation\CompensationRepository;
use App\Repository\Compensation\CompensationRepositoryInterface;
use App\Repository\Contracts\ContractRepository;
use App\Repository\Contracts\ContractRepositoryInterface;
use App\Repository\Details\DetailRepository;
use App\Repository\Details\DetailRepositoryInterface;
use App\Repository\History\HistoryRepository;
use App\Repository\History\HistoryRepositoryInterface;
use App\Repository\Packages\PackageRepository;
use App\Repository\Packages\PackageRepositoryInterface;
use App\Repository\Packages\PackageUserRepository;
use App\Repository\Packages\PackageUserRepositoryInterface;
use App\Repository\Rules\RuleRepository;
use App\Repository\Rules\RuleRepositoryInterface;
use App\Repository\Users\UserRepository;
use App\Repository\Users\UserRepositoryInterface;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
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
        $this->app->bind(PackageRepositoryInterface::class, PackageRepository::class);
        $this->app->bind(DetailRepositoryInterface::class, DetailRepository::class);
        $this->app->bind(RuleRepositoryInterface::class, RuleRepository::class);
        $this->app->bind(PackageUserRepositoryInterface::class, PackageUserRepository::class);
        $this->app->bind(CompensationRepositoryInterface::class, CompensationRepository::class);
        $this->app->bind(HistoryRepositoryInterface::class, HistoryRepository::class);
    }
    public function boot()
    {
        $count = 0;
        if (env('APP_DEVELOPMENT', false))
        {
            DB::listen(function($query) use (&$count) {
                Log::info(
                    $query->sql,
                    $query->bindings,
                    $query->time
                );
                $count++;
                Log::info("number query $count");
            });
        }
    }
}
