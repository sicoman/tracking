<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TrackingController;

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

Route::group([
    'prefix' => 'tracking',
    //'middleware' => ['auth:admin'],
], function () {

    Route::post('/waypoints', [TrackingController::class, 'createWayPoints']);
    Route::get('/route', [TrackingController::class, 'getRoute']);
    Route::get('/route/distance', [TrackingController::class, 'getRouteDistance']);
    Route::get('/nearby/drivers', [TrackingController::class, 'getDriversNearBy']);

});
