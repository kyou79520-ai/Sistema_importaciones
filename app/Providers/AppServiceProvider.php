<?php

namespace App\Providers;

use App\Models\Importacion;
use App\Observers\ImportacionObserver;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        Paginator::useBootstrap();

        // Registrar observer para auditoría automática
        Importacion::observe(ImportacionObserver::class);
    }
}