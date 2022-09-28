<?php
namespace App\Services\Location;

use App\Repositories\LocationRepository;

class GetRouteService
{
    /**
     * @var LocationRepository
     */
    protected $repository;

    /**
     * GetRouteService constructor.
     *
     * @param LocationRepository $repository
     */
    public function __construct(LocationRepository $repository)
    {
        $this->repository = $repository;
    }

    public function execute(array $input)
    {
        return $this->repository->getRoute($input);
    }
}
