<?php

namespace App\Providers;

use App\Billing\PaymentGatewayContract;
use App\Billing\BankPaymentGateway;
use App\Billing\CreditPaymentGateway;
use Illuminate\Support\ServiceProvider;
use App\Http\Middleware\TerminatingMiddleware;
use App\Models\Channel;


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
        $this->app->singleton(PaymentGatewayContract::class, function($app){
            if(request()->has('credit')){
                return new CreditPaymentGateway('usd');
            }
            return new BankPaymentGateway('usd');
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // shared data across all views - not good - using db
        \View::share('channel',Channel::orderBy('name')->get());

        // a better way to share data
        // \View::composer(['post.create','channel.index'], function ($view) {
        //     $view->with('channels',Channel::orderBy('name')->get());
        // });
    
        // a better way to share data with wildcard
        \View::composer(['post.*','channel.*'], function ($view) {
            $view->with('channels',Channel::orderBy('name')->get());
        });
    }
}
