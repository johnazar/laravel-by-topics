<?php

use Illuminate\Support\Facades\Route;
use App\MyFacades\PostCardSendingService;
use App\MyFacades\Postcard;
use App\Http\Controllers\ChannelController;
use App\Http\Controllers\PayOrderController;
use App\Http\Controllers\PostController;
use App\Models\User;
use Azarj\mypackage\Hello;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Cookie;
use PhpParser\Node\Expr\FuncCall;

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
// Load time
define('LARAVEL_END', microtime(true));
Log::info("Load time ".LARAVEL_END - LARAVEL_START);
Log::channel('mylogchannel')->info("Load time ".LARAVEL_END - LARAVEL_START);
require __DIR__.'/auth.php';


Route::prefix('/dashboard')->middleware(['auth'])->group(function () {
    Route::get('/', function () {
        return view('dashboard');
    })->name('dashboard');
    
});

Route::get('/charge',[PayOrderController::class,'store']);
Route::get('/channels',[ChannelController::class,'index']);
Route::get('/post/create', [PostController::class,'create']);



Route::get('/{locale?}', function ($locale = null) {
    // Configuring The Locale
    if (! in_array($locale, ['en', 'es', 'ru']) && !is_null($locale)) {
        abort(400);
    }
    App::setLocale($locale);
    Cookie::queue('cookiesNotEncrypted', 'theRealValue', 60);
    Cookie::queue('cookiesEncrypted', 'theRealValue', 60);
    return view('welcome');
});

Route::fallback(function () {
    //
});



