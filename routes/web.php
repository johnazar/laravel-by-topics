<?php

use App\Models\User;
use Illuminate\Support\Facades\Route;
use Azarj\mypackage\Hello;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
// realtime Facades
// use Facades\Azarj\mypackage\Hello;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    // load time
    define('LARAVEL_END', microtime(true));
    Log::channel('mylogchannel')->info("Load time ".LARAVEL_END - LARAVEL_START);
    // echo LARAVEL_END - LARAVEL_START;
    // $hello = new Hello();
    // echo $hello->hi();
    // check loaded services
    // dd(app());
    
    // realtime Facades
    // echo Hello::hi();
    
    
    
    return view('welcome');
});

Route::get('/search/{search}', function ($search) {
    return $search;
})->where('search', '.*');
Route::get('/users/{user}', [User::class, 'show'])->name('user.index');

Route::get('/users/{user}', [User::class, 'show'])
        ->name('user.view')
        ->missing(function (Request $request) {
            return Redirect::route('user.index');
        });
