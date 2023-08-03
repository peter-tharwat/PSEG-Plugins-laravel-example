<?php

namespace Moamalat\Payment\Providers;


use Illuminate\Support\ServiceProvider;
use Moamalat\Payment\Moamalat;


class MoamalatPaymentServiceProvider extends ServiceProvider
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

        $this->loadViewsFrom(__DIR__ . '/../Moamalat/views', 'moamalat');

        $this->publishes([
            __DIR__.'/../Config/moamalat.php' => config_path('moamalat.php'),
        ]);

        $this->app->singleton('moamalat', function () {
            return new Moamalat;
        });
    }
}
