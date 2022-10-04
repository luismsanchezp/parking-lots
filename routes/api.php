<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\api\v1\CustomerController;
use App\Http\Controllers\api\v1\ParkingLotController;
use App\Http\Controllers\api\v1\ParkingSpotController;
use App\Http\Controllers\api\v1\TicketController;
use App\Http\Controllers\api\v1\UserController;
use App\Http\Controllers\api\v1\VehicleController;
use App\Http\Controllers\api\v1\VehicleTypeController;

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
Route::apiResource('v1/customers', CustomerController::class);
Route::apiResource('v1/parkinglots', ParkingLotController::class);
Route::apiResource('v1/parkingspots', ParkingSpotController::class);
Route::apiResource('v1/tickets', TicketController::class);
Route::apiResource('v1/users', UserController::class);
Route::apiResource('v1/vehicles', VehicleController::class);
Route::apiResource('v1/vehicletypes', VehicleTypeController::class);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
