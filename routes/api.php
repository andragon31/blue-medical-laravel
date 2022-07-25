<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VehicleParkingController;

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

Route::get('/get_contracts', [VehicleParkingController::class, 'getContracts']);
Route::get('/get_vehicle/{plate}', [VehicleParkingController::class, 'getVehicle']);
Route::post('/check_in', [VehicleParkingController::class, 'checkInVehicle']);
Route::post('/check_out', [VehicleParkingController::class, 'checkOutVehicle']);
Route::post('/start_month', [VehicleParkingController::class, 'startMonth']);
Route::post('/update_contract_vehicle', [VehicleParkingController::class, 'updateContractVehicule']);


