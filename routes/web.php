<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DeliveryController;
use App\Http\Controllers\HomeController;

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

Route::get('/', [DeliveryController::class ,'index'])->name('delivery.index');
Route::get('/preparation', [DeliveryController::class ,'preparation'])->name('delivery.preparation');
Route::post('/start', [DeliveryController::class ,'start'])->name('delivery.start');
Route::post('/finish', [DeliveryController::class ,'finish'])->name('delivery.finish');

Route::get('/scan', [DeliveryController::class ,'scan'])->name('delivery.scan');
Route::get('/pulling', [DeliveryController::class ,'pulling'])->name('delivery.pulling');
Route::post('/done', [DeliveryController::class ,'done'])->name('delivery.done');

Route::group(['namespace' => 'Admin', 'as' => 'admin.', 'prefix' => 'admin'], function() {
    Route::get('login', [AuthController::class ,'login'])->name('auth.login');
    Route::post('authenticate', [AuthController::class ,'authenticate'])->name('auth.authenticate');
    Route::get('logout', [AuthController::class ,'logout'])->name('auth.logout');

    Route::middleware('auth')->group(function () {
        Route::get('/', [HomeController::class ,'home'])->name('home');
    });
    
});

