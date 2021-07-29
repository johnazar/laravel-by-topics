<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class TestServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        // pass a variable to ever view
        view()->composer('*',function($view){
            $test = 'This is from our test service provider';
            return $view->with('test',$test);
        });
        
    }
}
