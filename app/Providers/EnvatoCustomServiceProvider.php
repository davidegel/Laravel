<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Library\Services\DemoOne;
use App\Library\Services\SendMail;
use App\Library\Services\Criptx;

class EnvatoCustomServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(DemoOne::class, function ($app) {
            return new DemoOne();
        });

        $this->app->bind(SendMail::class, function ($app) {
            return new SendMail();
        });

        $this->app->singleton('criptx', function () {
            return new Criptx();
        });
    }
}
