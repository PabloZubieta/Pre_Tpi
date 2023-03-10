<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use \App\Http\Controllers\ScheduleController;
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
    return view('home');
});

Route::get('/carpooling',function () {
    return view('home');
});

Route::get('/profile', [UserController::class, 'profile'] );

Route::get('/schedule', [ScheduleController::class, 'display']);

Route::get('/login', [UserController::class, 'login']);

Route::get('/signin', [UserController::class, 'signin']);

Route::put('/users', [UserController::class, 'activate']);

route::post('/logout', [UserController::class,'logout']);

route::post('/log',[UserController::class,'log']);





