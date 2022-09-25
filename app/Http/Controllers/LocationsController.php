<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateWayPointRequest;
use App\Repositories\LocationRepository;
use App\Services\Location\CreateWayPointService;

/**
 * Class LocationsController.
 *
 * @package namespace App\Http\Controllers;
 */
class LocationsController extends Controller
{
    /**
     * @var CreateWayPointService
     */
    protected $createWayPointService;

    /**
     * LocationsController constructor.
     *
     * @param CreateWayPointService $repository
     */
    public function __construct(CreateWayPointService $createWayPointService)
    {
        $this->createWayPointService = $createWayPointService;
    }


    /**
     * Store a newly created waypoint in storage.
     *
     * @param  CreateWayPointRequest $request
     *
     * @return \Illuminate\Http\Response
     */
    public function createWayPoints(CreateWayPointRequest $request)
    {
        $this->createWayPointService->execute($request->validated());
    }
}
