<?php
namespace App\Services\Location;

use App\Repositories\LocationRepository;

class GetNearByDriversService
{
    /**
     * @var LocationRepository
     */
    protected $repository;

    /**
     * GetNearByDriversService constructor.
     *
     * @param LocationRepository $repository
     */
    public function __construct(LocationRepository $repository)
    {
        $this->repository = $repository;
    }

    public function execute(array $input)
    {
        return $this->repository->getNearByDrivers($input);
    }
}
