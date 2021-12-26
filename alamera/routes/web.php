<?php

use Illuminate\Support\Facades\Route;



use App\Http\Controllers\DepotController;
use App\Http\Controllers\LaboratoryController;
use App\Http\Controllers\CruController;



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
Route::get('/login', function () {
    return redirect('/login')->middleware('auth');
});
Route::get('/', function () {
    return view('/map-alamera/map-alamera');
});






Route::resource('depots', DepotController::class)->middleware('auth');
Route::resource('laboratorys', LaboratoryController::class)->middleware('auth');
Route::resource('crus', CruController::class)->middleware('auth');




Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home')->middleware('auth');
