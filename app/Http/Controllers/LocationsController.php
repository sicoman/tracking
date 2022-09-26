<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateWayPointRequest;
use App\Services\Location\CreateWayPointService;

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
     *
     * @return \Illuminate\Http\Response
     */
    public function createWayPoints(CreateWayPointRequest $request, CreateWayPointService $service)
    {
        $data = $service->execute($request->validated());
        return success_response($data);
    }
}
