<?php

namespace PaySky\Payment\Providers;


use Illuminate\Support\ServiceProvider;
use PaySky\Payment\PaySky;


class PaySkyPaymentServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        
        $this->publishes([
            __DIR__ . '/../Resources/assets' => public_path('assets'),
        ], 'paysky');

        $this->loadViewsFrom(__DIR__ . '/../Paysky/views', 'paysky');

        $this->publishes([
            __DIR__.'/../Config/paysky.php' => config_path('paysky.php'),
        ]);

        $this->app->singleton('paysky', function () {
            return new PaySky;
        });
    }
}
