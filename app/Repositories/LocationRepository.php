<?php

namespace App\Repositories;

use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Interface LocationRepository.
 *
 * @package namespace App\Repositories;
 */
interface LocationRepository extends RepositoryInterface
{
    public function createWayPoints(array $input);
    public function getNearByDrivers(array $input);
    public function getRoute(array $input);
    public function getRouteDistance(array $input);
}
