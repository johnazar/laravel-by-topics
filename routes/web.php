<?php

use App\MyFacades\PostCardSendingService;
use App\MyFacades\Postcard;
use App\Http\Controllers\ChannelController;
use App\Http\Controllers\PayOrderController;
use App\Http\Controllers\PostController;
use App\Models\User;
use Illuminate\Support\Facades\Route;
use Azarj\mypackage\Hello;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Cookie;
use PhpParser\Node\Expr\FuncCall;

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
Route::get('/postcard',function(){
    $postcardservice = new PostCardSendingService('US','10','12');
    dd($postcardservice->hey('ok','test@test.com'));
});
Route::get('/postcardfacade',function(){
    dd(Postcard::hey('ok','test@test.com'));
});


Route::get('/charge',[PayOrderController::class,'store']);
Route::get('/channels',[ChannelController::class,'index']);
Route::get('/post/create', [PostController::class,'create']);

Route::get('/search/{search}', function ($search) {
    return $search;
})->where('search', '.*');
Route::get('/users/{user}', [User::class, 'show'])->name('user.index');

Route::get('/users/{user}', [User::class, 'show'])
        ->name('user.view')
        ->missing(function (Request $request) {
            return Redirect::route('user.index');
        });
Route::get('/{local}', function () {
    Cookie::queue('cookiesNotEncrypted', 'theRealValue', 60);
    Cookie::queue('cookiesEncrypted', 'theRealValue', 60);
    // load time
    define('LARAVEL_END', microtime(true));
    Log::info("Load time ".LARAVEL_END - LARAVEL_START);
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


Route::fallback(function () {
    //
});
