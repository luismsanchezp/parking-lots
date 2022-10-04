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

//User routes
Route::get('v1/users', 
    [App\Http\Controllers\api\v1\UserController::class,'index'])->name('users.index');
Route::get('v1/users/{user}', 
    [App\Http\Controllers\api\v1\UserController::class,'show'])->name('users.show');

//Customer routes
Route::get('v1/customers', 
    [App\Http\Controllers\api\v1\CustomerController::class,'index'])->name('customers.index');
Route::get('v1/customers/{customer}', 
    [App\Http\Controllers\api\v1\CustomerController::class,'show'])->name('customers.show');

//Parkinglot routes
Route::get('v1/parkinglots', 
    [App\Http\Controllers\api\v1\ParkingLotController::class,'index'])->name('parkinglots.index');
Route::get('v1/parkinglots/{parkinglot}', 
    [App\Http\Controllers\api\v1\ParkingLotController::class,'show'])->name('parkinglots.show');

//Parkingspot routes
Route::get('v1/parkingspots', 
    [App\Http\Controllers\api\v1\ParkingSpotController::class,'index'])->name('parkingspots.index');
Route::get('v1/parkingspots/{parkingspot}', 
    [App\Http\Controllers\api\v1\ParkingSpotController::class,'show'])->name('parkingspots.show');

//Ticket routes
Route::get('v1/tickets', 
    [App\Http\Controllers\api\v1\TicketController::class,'index'])->name('tickets.index');
Route::get('v1/tickets/{ticket}', 
    [App\Http\Controllers\api\v1\TicketController::class,'show'])->name('tickets.show');

//Vehicle routes
Route::get('v1/vehicles', 
    [App\Http\Controllers\api\v1\VehicleController::class,'index'])->name('vehicles.index');
Route::get('v1/vehicles/{vehicle}', 
    [App\Http\Controllers\api\v1\VehicleController::class,'show'])->name('vehicles.show');

//VehicleType routes
Route::get('v1/vehicletypes', 
    [App\Http\Controllers\api\v1\VehicleTypeController::class,'index'])->name('vehicletypes.index');
Route::get('v1/vehicletypes/{vehicletype}', 
    [App\Http\Controllers\api\v1\VehicleTypeController::class,'show'])->name('vehicletypes.show');

Route::post('/v1/login', 
 [App\Http\Controllers\api\v1\AuthController::class,
 'login'])->name('api.login');

Route::middleware(['auth:sanctum'])->group(function() { 
    Route::post('/v1/logout', 
        [App\Http\Controllers\api\v1\AuthController::class, 
        'logout'])->name('api.logout');

    //User routes
    Route::post('v1/users', 
        [App\Http\Controllers\api\v1\UserController::class,'store'])->name('users.store');
    Route::put('v1/users/{user}', 
        [App\Http\Controllers\api\v1\UserController::class,'update'])->name('users.update');

    //Customer routes
    Route::post('v1/customers', 
        [App\Http\Controllers\api\v1\CustomerController::class,'store'])->name('customers.store');
    
    //Parkinglot routes
    Route::post('v1/parkinglots', 
        [App\Http\Controllers\api\v1\ParkingLotController::class,'store'])->name('parkinglots.store');
    Route::put('v1/parkinglots/{parkinglot}', 
        [App\Http\Controllers\api\v1\ParkingLotController::class,'update'])->name('parkinglots.update');

    //Parkingspot routes
    Route::post('v1/parkingspots', 
        [App\Http\Controllers\api\v1\ParkingSpotController::class,'store'])->name('parkingspots.store');

    //Ticket routes
    Route::post('v1/tickets', 
        [App\Http\Controllers\api\v1\TicketController::class,'store'])->name('tickets.store');

    //Vehicle routes
    Route::post('v1/vehicles', 
        [App\Http\Controllers\api\v1\VehicleController::class,'store'])->name('vehicles.store');
    Route::put('v1/vehicles/{vehicle}', 
        [App\Http\Controllers\api\v1\VehicleController::class,'update'])->name('vehicles.update');

    //VehicleType routes
    Route::post('v1/vehicletypes', 
        [App\Http\Controllers\api\v1\VehicleTypeController::class,'store'])->name('vehicletypes.store');
});