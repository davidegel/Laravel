<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Library\Services\FooService;
use App\Library\Services\BarService;
use App\Library\Services\FooInterface;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        /* $this->app->bind(FooInterface::class, function ($env) {
            return new FooService($env);
        }); */

        $this->app->bind(FooInterface::class, function($app, array $param) {
            return new FooService($param[0]);
        });
    }
}
