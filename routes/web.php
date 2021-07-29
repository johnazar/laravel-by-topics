<?php

use Illuminate\Support\Facades\Route;
use Azarj\mypackage\Hello;

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
    define('LARAVEL_END', microtime(true));
    // $hello = new Hello();
    // echo $hello->hi();
    // load time
    // echo LARAVEL_END - LARAVEL_START;
    // check loaded services
    // dd(app());
    // return view('welcome');
});
