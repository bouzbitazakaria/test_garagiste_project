<?php

use App\Http\Controllers\ClientController;
use App\Http\Controllers\MecanicienController;
use App\Http\Controllers\ProfilContoller;
use App\Http\Controllers\VehiculeController;
use App\Models\Mecanicien;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/



Route::get('/', function () {
    return view('login');
});



Route::group(['namespace' => 'App\Http\Controllers'], function()
{   
    /**
     * Home Routes
     */
    Route::get('/', 'HomeController@index')->name('home.index');

    Route::group(['middleware' => ['guest']], function() {
        /**
         * Login Routes
         */
        Route::get('/login', 'LoginController@show')->name('login.show');
        Route::post('/login', 'LoginController@login')->name('login.perform');

    });

    Route::group(['middleware' => ['auth']], function() {
        /**
         * Logout Routes
         */
        Route::resource('clients', ClientController::class);
        Route::resource('vehicles' , VehiculeController::class);
        Route::resource('mecaniciens',MecanicienController::class);
        Route::resource('profil',ProfilContoller::class);
        Route::get('/logout', 'LogoutController@perform')->name('logout.perform');
    });
});