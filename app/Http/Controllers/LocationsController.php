<?php

namespace App\Http\Controllers;

use App\Http\Requests\GetRouteRequest;
use App\Http\Requests\CreateWayPointRequest;
use App\Http\Requests\GetNearByDriversRequest;
use App\Http\Requests\GetRouteDistanceRequest;

use App\Services\Location\GetRouteService;
use App\Services\Location\CreateWayPointService;
use App\Services\Location\GetNearByDriversService;
use App\Services\Location\GetRouteDistanceService;

/**
 * Class LocationsController.
 *
 * @package namespace App\Http\Controllers;
 */
class LocationsController extends Controller
{
    /**
     * Store a newly created waypoint in storage.
     *
     * @param  CreateWayPointRequest $request
     * @param  CreateWayPointService $service
     *
     * @return json response
     */
    public function createWayPoints(CreateWayPointRequest $request, CreateWayPointService $service)
    {
        $data = $service->execute($request->validated());
        return success_response($data);
    }

    /**
     * Get the drivers that close to a specific location.
     *
     * @param  GetNearByDriversRequest $request
     * @param  GetNearByDriversService $service
     *
     * @return json response
     */
    public function getNearByDrivers(GetNearByDriversRequest $request, GetNearByDriversService $service)
    {
        $data = $service->execute($request->validated());
        return success_response($data);
    }

    /**
     * Get a driver's route in a specific period of time.
     *
     * @param  GetRouteRequest $request
     * @param  GetRouteService $service
     *
     * @return json response
     */
    public function getRoute(GetRouteRequest $request, GetRouteService $service)
    {
        $data = $service->execute($request->validated());
        return success_response($data);
    }

    /**
     * Get a driver's route distance in KM in a specific period of time.
     *
     * @param  GetRouteDistanceRequest $request
     * @param  GetRouteDistanceService $service
     *
     * @return json response
     */
    public function getRouteDistance(GetRouteDistanceRequest $request, GetRouteDistanceService $service)
    {
        $data = $service->execute($request->validated());
        return success_response($data);
    }
}
