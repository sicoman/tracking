<?php

namespace App\Repositories;

use Carbon\Carbon;

use App\Models\Tracking;
use App\Exceptions\CustomException;

class TrackingRepository
{
    /**
     * @var Tracking
     */
    protected $model;

    /**
     * TrackingRepository constructor.
     *
     * @param Model $model
     */
    public function __construct(Tracking $model)
    {
        $this->model = $model;
    }

    /**
     * Store a newly created waypoint in storage.
     *
     * @param  array  $input
     * @return App\Models\Tracking
     */
    public function createWayPoints(array $input)
    {
        $now = date('Y-m-d H:i:s');
        foreach($input['locations'] as $key => $location) {
            $input['locations'][$key] = [
                'driver_id' => $input['driver_id'],
                'location' => $location,
                'created_at' => $now,
                'updated_at' => $now,
            ];
        }
        return Tracking::insert($input);
    }

    /**
     * Get the drivers that close to a specific location.
     *
     * @param  array  $input
     * @return array $drivers_ids
     */
    public function getDriversNearBy(array $input)
    {
        $where = [
            'location' => [
                '$near' => [
                    '$geometry' => [
                        'type' => 'Point',
                        'coordinates' => [
                            $input['lat']+0,
                            $input['lng']+0,
                        ]
                    ],
                    '$minDistance' => $input['min_distance']+0,
                    '$maxDistance' => $input['max_distance']+0,
                ]
            ]
        ];

        return Tracking::where($where)->get()->pluck('driver_id');
    }

    /**
     * Get a driver's route in a specific period of time.
     *
     * @param  array  $input
     * @return array $locations
     */
    public function getRoute(array $input)
    {
        $start_time = Carbon::createFromFormat('Y-m-d H:i:s', $input['start_time']);
        $end_time = Carbon::createFromFormat('Y-m-d H:i:s', $input['end_time']);

        return Tracking::select('location')->where('driver_id', $input['driver_id'])
            ->whereBetween('created_at', [$start_time, $end_time])
            ->get()
            ->pluck('location');
    }

    /**
     * Get a driver's route distance in KM in a specific period of time.
     *
     * @param  array  $input
     * @return double $distance
     */
    public function getRouteDistance(array $input)
    {
        $location = $this->getRoute($input);

        $where = 'db.trackings.aggregate([
            {
              $geoNear: {
                 near: { type: "Point", coordinates: [ -73.99279 , 40.719296 ] },
                 distanceField: "dist.calculated",
                 maxDistance: 2,
                 query: { category: "Parks" },
                 includeLocs: "dist.location",
                 spherical: true
              }
            }
         ])';
        return Tracking::where($where)->get();
    }
}
