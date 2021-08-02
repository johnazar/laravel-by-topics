<?php

namespace App\Providers;

use App\Billing\PaymentGatway;
use Illuminate\Support\ServiceProvider;
use App\Http\Middleware\TerminatingMiddleware;

class AppServiceProvider extends ServiceProvider
{
        /**
     * All of the container bindings that should be registered.
     *
     * @var array
     */
    public $bindings = [
        // ServerProvider::class => DigitalOceanServerProvider::class,
    ];
    /**
     * All of the container singletons that should be registered.
     *
     * @var array
     */
    public $singletons = [
        // DowntimeNotifier::class => PingdomDowntimeNotifier::class,
        // ServerProvider::class => ServerToolsProvider::class,
    ];
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(TerminatingMiddleware::class);
        $this->app->bind(PaymentGatway::class, function($app){
            return new PaymentGatway('usd');
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
