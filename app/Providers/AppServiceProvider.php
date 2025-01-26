<?php

namespace App\Providers;

use App\Interfaces\PlanteInterface;
use App\Interfaces\PlanteUserInterface;
use App\Interfaces\UserInterface;
use App\Repositories\PlanteRepository;
use App\Repositories\PlanteUserRepository;
use App\Repositories\UserRepository;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(UserInterface::class, UserRepository::class);
        $this->app->bind(PlanteInterface::class, PlanteRepository::class);
        $this->app->bind(PlanteUserInterface::class, PlanteUserRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
