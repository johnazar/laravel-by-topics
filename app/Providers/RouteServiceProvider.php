<?php

namespace App\Providers;


use App\Models\User;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * The path to the "home" route for your application.
     *
     * This is used by Laravel authentication to redirect users after login.
     *
     * @var string
     */
    public const HOME = '/dashboard';

    /**
     * The controller namespace for the application.
     *
     * When present, controller route declarations will automatically be prefixed with this namespace.
     *
     * @var string|null
     */
    // protected $namespace = 'App\\Http\\Controllers';

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot()
    {

        // Localizing Resource URIs
        Route::resourceVerbs([
            'create' => 'crear',
            'edit' => 'editar',
        ]);

        // Global Constraints
        Route::pattern('id', '[0-9]+');

        // Customizing The Resolution Logic
        Route::bind('user', function ($value) {
            return User::where('name', $value)->firstOrFail();
        });
        $this->configureRateLimiting();

        $this->routes(function () {
            Route::prefix('api')
                ->middleware('api')
                ->namespace($this->namespace)
                ->group(base_path('routes/api.php'));

            Route::middleware('web')
                ->namespace($this->namespace)
                ->group(base_path('routes/web.php'));
        });
    }

    /**
     * Configure the rate limiters for the application.
     *
     * @return void
     */
    protected function configureRateLimiting()
    {
        /* 
        * limit access to the route to 100 times per minute per authenticated user ID
        * or 10 times per minute per IP address for guests
        */
        RateLimiter::for('uploads', function (Request $request) {
            return $request->user()
                        ? Limit::perMinute(100)->by($request->user()->id)
                        : Limit::perMinute(10)->by($request->ip()); 
        });
        
        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(60)->by(optional($request->user())->id ?: $request->ip());
        });
    }
}
