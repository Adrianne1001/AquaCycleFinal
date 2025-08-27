<?php

use App\Http\Controllers\ApiUserDataController;
use App\Http\Controllers\NodeMCUDataController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Group routes that need API token authentication
Route::middleware('static.api.token')->group(function () {
    Route::post('/mcu-data', [NodeMCUDataController::class, 'store']);
    Route::get('/user-data', [ApiUserDataController::class, 'fetchUserData']);
});