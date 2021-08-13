<?php

use Illuminate\Support\Facades\Route;
use App\MyFacades\PostCardSendingService;
use App\MyFacades\Postcard;
use App\Http\Controllers\ChannelController;
use App\Http\Controllers\DashController;
use App\Http\Controllers\PayOrderController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\SettingController;
use App\Models\User;
use Azarj\mypackage\Hello;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Cookie;
use PhpParser\Node\Expr\FuncCall;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;


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
Log::info("Load time ".microtime(true) - LARAVEL_START);
Log::channel('mylogchannel')->info("Load time ".microtime(true) - LARAVEL_START);
require __DIR__.'/auth.php';


Route::prefix('/setting')->middleware(['auth'])->group(function () {
    Route::get('/', [SettingController::class,'index'])->name('settings.index');
    Route::resource('posts', PostController::class);
    Route::resource('files', FileController::class);
    // Macros Test
    Route::get('/macro', function () {
        return Response::errorJson('went wrong');
    });
});
Route::prefix('/dashboard')->middleware(['auth'])->group(function () {
    Route::get('/', [DashController::class,'index'])->name('dashboard');
});

Route::get('/charge',[PayOrderController::class,'store']);
Route::get('/channels',[ChannelController::class,'index']);




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

Route::get('/postcard',function(){
    $postcardservice = new PostCardSendingService('US','10','12');
    dd($postcardservice->hey('ok','test@test.com'));
});
Route::get('/postcardfacade',function(){
    dd(Postcard::hey('ok','test@test.com'));
});

Route::fallback(function () {
    //
});



