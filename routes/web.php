<?php

use App\Http\Controllers\Controller;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\Language;
use App\Models\Advertisement;
use Illuminate\Support\Facades\Auth;
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

Auth::routes();

Route::middleware(Language::class)->group(function () {

    Route::get('/', [Controller::class, 'welcome']);
    Route::post('/serach', [Controller::class, 'search'])->name('search');
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::resource('customer', CustomerController::class);

    Route::resource('reservation', ReservationController::class);
    Route::post('reservation/filter', [ReservationController::class, 'filter'])->name('reservation.filter');

    Route::prefix('place')->name('place.')
        ->controller(UserController::class)->group(function () {
            Route::get('/edit', 'edit')->name('edit');
            Route::put('/update', 'update')->name('update');
            Route::get('/{id}', 'show')->name('show');
        });

    Route::prefix('image')->name('image.')
        ->controller(ImageController::class)->group(function () {
            Route::post('/store', 'imageRequest')->name('store');
            Route::get('{name}', 'getImage')->name('show');
        });

    Route::prefix('ad')->name('ad.')
        ->controller(Advertisement::class)->group(function () {
            Route::post('/create', 'create')->name('create');
            Route::post('/store', 'store')->name('store');
        });
});
