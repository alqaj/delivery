<?php

use App\Http\Controllers\DeliveryController;
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

Route::get('/', [DeliveryController::class ,'index'])->name('delivery.index');
Route::get('/preparation', [DeliveryController::class ,'preparation'])->name('delivery.preparation');
Route::post('/start', [DeliveryController::class ,'start'])->name('delivery.start');
Route::post('/finish', [DeliveryController::class ,'finish'])->name('delivery.finish');

