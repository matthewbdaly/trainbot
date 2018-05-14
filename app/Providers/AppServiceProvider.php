<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Matthewbdaly\TransportApi\Client;

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
        $this->app->singleton('Matthewbdaly\TransportApi\Contracts\Client', function ($app) {
            return new Client(
                config('app.transport.app_id'),
                config('app.transport.app_key')
            );
        });
    }
}
