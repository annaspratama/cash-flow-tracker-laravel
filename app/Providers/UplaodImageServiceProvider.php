<?php

namespace App\Providers;

use App\Services\UploadImageService;
use App\Services\Implements\UploadImageServiceImplement;
use Illuminate\Support\ServiceProvider;

class UplaodImageServiceProvider extends ServiceProvider
{
    public array $singletons = [
        UploadImageService::class => UploadImageServiceImplement::class
    ];

    /**
     * Register services.
     * 
     * @return array
     */
    public function register(): array
    {
        return [UploadImageService::class];
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
