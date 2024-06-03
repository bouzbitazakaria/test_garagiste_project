<?php

use App\Http\Controllers\ClientController;
use App\Http\Controllers\ForgotPasswordController;
use App\Http\Controllers\MecanicienController;
use App\Http\Controllers\PiecesRechangeController;
use App\Http\Controllers\ProfilContoller;
use App\Http\Controllers\ReparationController;
use App\Http\Controllers\VehiculeController;
use App\Models\Mecanicien;
use App\Models\PiecesRechange;
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
        Route::get('forget-password', [ForgotPasswordController::class, 'showForgetPasswordForm'])->name('forget.password.get');
        Route::post('forget-password', [ForgotPasswordController::class, 'submitForgetPasswordForm'])->name('forget.password.post');
        Route::get('reset-password/{token}', [ForgotPasswordController::class, 'showResetPasswordForm'])->name('reset.password.get');
        Route::post('reset-password', [ForgotPasswordController::class, 'submitResetPasswordForm'])->name('reset.password.post');

    });

    Route::group(['middleware' => ['auth']], function() {
        /**
         * Logout Routes
         */
        Route::resource('clients', ClientController::class);
        Route::get('clients-export',[ClientController::class, 'export'])->name('clients.export');
        Route::post('clients-import',[ClientController::class, 'import'])->name('clients.import');
        //
        Route::resource('vehicles' , VehiculeController::class);
        //
        Route::resource('mecaniciens',MecanicienController::class);
        Route::get('mecaniciens-export',[MecanicienController::class, 'export'])->name('mecaniciens.export');
        Route::post('mecaniciens-import',[MecanicienController::class, 'import'])->name('mecaniciens.import');
        //
        Route::resource('reparations',ReparationController::class);
        Route::resource('profil',ProfilContoller::class);
        Route::resource('spareParts',PiecesRechangeController::class);
        Route::get('/logout', 'LogoutController@perform')->name('logout.perform');
    });
});