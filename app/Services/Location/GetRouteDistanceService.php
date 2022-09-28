<?php
namespace App\Services\Location;

use App\Repositories\LocationRepository;

class GetRouteDistanceService
{
    /**
     * @var LocationRepository
     */
    protected $repository;

    /**
     * GetRouteDistanceService constructor.
     *
     * @param LocationRepository $repository
     */
    public function __construct(LocationRepository $repository)
    {
        $this->repository = $repository;
    }

    public function execute(array $input)
    {
        return $this->repository->getRouteDistance($input);
    }
}
