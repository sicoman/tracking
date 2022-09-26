<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LocationsController;

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

    Route::post('/waypoints', [LocationsController::class, 'createWayPoints']);
    Route::get('/route', [LocationsController::class, 'getRoute']);
    Route::get('/route/distance', [LocationsController::class, 'getRouteDistance']);
    Route::get('/nearby/drivers', [LocationsController::class, 'getDriversNearBy']);

});
