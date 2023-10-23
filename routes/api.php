<?php

use App\Http\Controllers\api\ApiComplaintController;
use App\Http\Controllers\api\ApiDefectController;
use App\Http\Controllers\api\ApiDepartementController;
use App\Http\Controllers\api\ApiUserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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


Route::post('/register', [ApiUserController::class, 'register']);
Route::post('/login', [ApiUserController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', [ApiUserController::class, 'readAll']);

Route::get('/departement', [ApiDepartementController::class, 'readAll']);
Route::get('/defect', [ApiDefectController::class, 'readAll']);
Route::get('/complaint', [ApiComplaintController::class, 'readComplaint']);

Route::get('/complaint/result/{complaint}', [ApiComplaintController::class, 'resultComplaint']);


});

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
