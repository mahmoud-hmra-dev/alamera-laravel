<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DepotApiController;
use App\Http\Controllers\CruApiController;
use App\Http\Controllers\LaboratoryApiController;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get("depot",[DepotApiController::class,'depot']);
Route::get("laboratory",[LaboratoryApiController::class,'laboratory']);
Route::get("cru",[CruApiController::class,'cru']);

