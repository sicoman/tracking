<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use App\Repositories\TrackingRepository;

class TrackingController extends Controller
{
    private $trackingRepository;

    public function __construct(TrackingRepository $trackingRepository)
    {
        $this->trackingRepository = $trackingRepository;
    }

    /**
     * Store a newly created waypoint in storage.
     *
     * @param  App\Http\Requests\Request  $request
     * @return Illuminate\Http\Response
     */
    public function createWayPoints(Request $request)
    {
        $input = $request->all();
        $validator = Validator::make($input, [
            'driver_id' => ['required', 'integer'],
            'locations' => ['required']
        ]);

        if ($validator->fails()) {
            $response = [
                'success' => false,
                'message' => $validator->errors()->first(),
            ];
            return response()->json($response, 400);
        }

        return $this->trackingRepository->createWayPoints($input);
    }

    /**
     * Get the drivers that close to a specific location.
     *
     * @param  App\Http\Requests\Request  $request
     * @return Illuminate\Http\Response
     */
    public function getDriversNearBy(Request $request)
    {
        $input = $request->all();
        $validator = Validator::make($input, [
            'lat' => ['required', 'numeric'],
            'lng' => ['required', 'numeric'],
            'min_distance' => ['required', 'numeric'],
            'max_distance' => ['required', 'numeric']
        ]);

        if ($validator->fails()) {
            $response = [
                'success' => false,
                'message' => $validator->errors()->first(),
            ];
            return response()->json($response, 400);
        }

        return $this->trackingRepository->getDriversNearBy($input);
    }

    /**
     * Get a driver's route in a specific period of time.
     *
     * @param  App\Http\Requests\Request  $request
     * @return Illuminate\Http\Response
     */
    public function getRoute(Request $request)
    {
        $input = $request->all();
        $validator = Validator::make($input, [
            'driver_id' => ['required', 'integer'],
            'start_time' => ['required', 'date_format:Y-m-d H:i:s'],
            'end_time' => ['required', 'date_format:Y-m-d H:i:s']
        ]);

        if ($validator->fails()) {
            $response = [
                'success' => false,
                'message' => $validator->errors()->first(),
            ];
            return response()->json($response, 400);
        }

        return $this->trackingRepository->getRoute($input);

    }

    /**
     * Get a driver's route in a specific period of time.
     *
     * @param  App\Http\Requests\Request  $request
     * @return Illuminate\Http\Response
     */
    public function getRouteDistance(Request $request)
    {
        $input = $request->all();
        $validator = Validator::make($input, [
            'driver_id' => ['required', 'integer'],
            'start_time' => ['required', 'date_format:Y-m-d H:i:s'],
            'end_time' => ['required', 'date_format:Y-m-d H:i:s']
        ]);

        if ($validator->fails()) {
            $response = [
                'success' => false,
                'message' => $validator->errors()->first(),
            ];
            return response()->json($response, 400);
        }

        return $this->trackingRepository->getRouteDistance($input);

    }
}
