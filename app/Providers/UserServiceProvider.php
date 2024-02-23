<?php

namespace App\Providers;

use App\Services\Implements\UserServiceImplement;
use App\Services\UserService;
use Illuminate\Support\ServiceProvider;

class UserServiceProvider extends ServiceProvider
{
    public array $singletons = [
        UserService::class => UserServiceImplement::class
    ];

    /**
     * Register services.
     * 
     * @return array
     */
    public function register(): array
    {
        return [UserService::class];
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
