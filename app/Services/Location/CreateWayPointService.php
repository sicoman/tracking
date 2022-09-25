<?php
namespace App\Services\Location;

use App\Repositories\LocationRepository;

class CreateWayPointService
{
    /**
     * @var LocationRepository
     */
    protected $repository;

    /**
     * CreateWayPointService constructor.
     *
     * @param LocationRepository $repository
     */
    public function __construct(LocationRepository $repository)
    {
        $this->repository = $repository;
    }

    public function execute(array $input)
    {
        return $this->repository->createWayPoints($input);
    }
}
