<?php

namespace App\Providers;

use App\Http\Controllers\Api\TestController;
use App\Http\Repositories\IRepository;
use App\Http\Repositories\TestRepository;
use App\Http\Repositories\UserRepository;
use App\Http\Services\TestService;
use App\Http\Services\UserService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // Bind repositories to services
        $this->app->when(TestService::class)
            ->needs(IRepository::class)
            ->give(function () {
                return app(TestRepository::class);
            });

        $this->app->when(UserService::class)
            ->needs(IRepository::class)
            ->give(function () {
                return app(UserRepository::class);
            });

        $this->app->bind(TestController::class, function ($app) {
            return new TestController(
                $app->make(UserService::class),
                $app->make(TestService::class)
            );
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
