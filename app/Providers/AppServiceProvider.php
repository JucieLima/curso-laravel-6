<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;

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
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);

        \PagSeguro\Library::initialize();
        \PagSeguro\Library::cmsVersion()->setName("MarketplaceL6")->setRelease("1.0.0");
        \PagSeguro\Library::moduleVersion()->setName("MarketplaceL6")->setRelease("1.0.0");
    }
}
