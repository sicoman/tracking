<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;

use App\Repositories\LocationRepository;
use App\Entities\Location;

use Illuminate\Support\Arr;
use Illuminate\Support\Str;

/**
 * Class LocationRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class LocationRepositoryEloquent extends BaseRepository implements LocationRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Location::class;
    }



    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    /**
     * Store a newly created waypoint in storage.
     *
     * @param  array  $input
     * @return App\Entities\Location[]
     */
    public function createWayPoints(array $input)
    {
        $uuid = Str::orderedUuid()->toString();
        foreach($input['locations'] as $key => $location) {
            $input['locations'][$key] = [
                'driver_id' => $input['driver_id'],
                'status' => $location['status'],
                'location' => Arr::only($location, ['lat', 'lng']),
                'time' => $location['time'],
                'insertion_id' => $uuid,
            ];
        }

        $this->insert($input['locations']);

        return $this->where('insertion_id', $uuid)->get();
    }

    /**
     * Get the drivers that close to a specific location.
     *
     * @param  array  $input
     * @return array $drivers_ids
     */
    public function getNearByDrivers(array $input)
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

        return $this->where($where)->get()->pluck('driver_id')->unique();
    }

    /**
     * Get a driver's route in a specific period of time.
     *
     * @param  array  $input
     * @return array $locations
     */
    public function getRoute(array $input)
    {
        return $this->select('location')
            ->where('driver_id', $input['driver_id'])
            ->whereBetween('time', [$input['start_time'], $input['end_time']])
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

        return $this->where($where)->get();
    }
}
