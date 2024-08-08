<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Event;
use App\Services\InvoiceAchiveService;
use App\Services\BranchService;
use App\Events\FireEvent;
use App\Listeners\FireListener;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register()
    {
        $this->app->singleton(InvoiceAchiveService::class, function ($app) {
            return new InvoiceAchiveService();
        });
        $this->app->singleton(BranchService::class, function ($app) {
            return new BranchService();
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {

    }
}

