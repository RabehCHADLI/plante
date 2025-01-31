<?php

namespace App\Providers;

use App\Interfaces\PlanteApiDataInterface;
use App\Interfaces\PlanteInterface;
use App\Interfaces\PlanteUserInterface;
use App\Interfaces\UserInterface;
use App\Repositories\PlanteApiDataRepository;
use App\Repositories\PlanteRepository;
use App\Repositories\PlanteUserRepository;
use App\Repositories\UserRepository;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{

    public function register(): void
    {
        $this->app->bind(UserInterface::class, UserRepository::class);
        $this->app->bind(PlanteInterface::class, PlanteRepository::class);
        $this->app->bind(PlanteUserInterface::class, PlanteUserRepository::class);
        $this->app->bind(PlanteApiDataInterface::class, PlanteApiDataRepository::class);
    }


    public function boot(): void
    {
        //
    }
}
