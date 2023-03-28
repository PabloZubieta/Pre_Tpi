<?php

use App\Http\Controllers\CarpoolingController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use \App\Http\Controllers\ScheduleController;
use App\Http\Middleware\Authenticate;

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

Route::put('/validate',[CarpoolingController::class, 'validate_carpool'])->middleware(Authenticate::class);

Route::get('/carpooling',[CarpoolingController::class, 'display'])->middleware(Authenticate::class);

Route::get('/profile', [UserController::class, 'profile'] )->middleware(Authenticate::class);

Route::get('/schedule', [ScheduleController::class, 'display'])->middleware(Authenticate::class);

Route::put('/actualise', [UserController::class, 'actualise'])->middleware(Authenticate::class);

Route::get('/login', [UserController::class, 'login'])->name('login');

Route::get('/signin', [UserController::class, 'signin']);

Route::put('/users', [UserController::class, 'activate'])->middleware(Authenticate::class);

route::post('/logout', [UserController::class,'logout'])->middleware(Authenticate::class);

route::post('/log',[UserController::class,'log']);





