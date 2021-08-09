<?php

namespace App\Providers;

use App\MyFacades\PostCardSendingService;
use App\Billing\PaymentGatewayContract;
use App\Billing\BankPaymentGateway;
use App\Billing\CreditPaymentGateway;
use Illuminate\Support\ServiceProvider;
use App\Http\Middleware\TerminatingMiddleware;
use App\Http\View\Composer\ChannelsComposer;
use App\Models\Channel;
use Illuminate\Routing\ResponseFactory;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Str;
use App\Mixins\StrMixins;
use App\Mixins\ResponseMixins;

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
        Blade::directive('mydatetimeformat', function ($expression) {
            return "<?php echo ($expression)->format('d/m/Y H:i'); ?>";
        });
        Blade::if('locale', function ($value) {
            return config('app.locale') === $value;
        });
        // Macros
        Str::mixin(new (StrMixins::class));
        ResponseFactory::mixin(new (ResponseMixins::class));

        // shared data across all views - not good - using db
        // \View::share('channel',Channel::orderBy('name')->get());

        // a better way to share data
        // \View::composer(['post.create','channel.index'], function ($view) {
        //     $view->with('channels',Channel::orderBy('name')->get());
        // });
    
        // a better way to share data with wildcard
        // \View::composer(['post.*','channel.*'], function ($view) {
        //     $view->with('channels',Channel::orderBy('name')->get());
        // });

        // using view composer
        View::composer(['partials.channels.*'],ChannelsComposer::class);

        // Facade
        $this->app->singleton('Postcard',function($app){
            return new PostCardSendingService('US','10','12');
        });
    }
}
