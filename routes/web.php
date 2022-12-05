<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FeelLuckyController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\PlayController;
// use App\Http\Controllers\UrlController;
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
    return view('pages.register');
});


Route::get('register',[RegisterController::class,'index']);
Route::get('/play/{id}/{id_url}',[PlayController::class,'play']);
Route::get('/create/{id}/{user_id}',[PlayController::class,'create']);
Route::get('/deactivate/{id}/{user_id}',[PlayController::class,'deactivate']);
Route::get('/lucky/{id}/{id_url}',[PlayController::class,'lucky']);
Route::get('/history/{id}/{id_url}',[PlayController::class,'history']);
Route::get('/back/{id}/{id_url}',[PlayController::class,'back']);
