<?php

namespace App\Services\Web;

use App\Models\Service;
use App\Repositories\Web\Interfaces\ServiceRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class ServiceService
{
    /**
     * Create a new class instance.
     */
    public function __construct(
        protected ServiceRepositoryInterface $serviceRepo
    ) {
        //
    }

    /* ============================================================================
    |   Fetch a single Service record by its primary ID.
    ==============================================================================*/
    public function find(string $encryptedId, ?array $selectedColumns = null): ?Service
    {
        $id = (int) decrypt($encryptedId);
        return $this->serviceRepo->find($id, $selectedColumns);
    }

    /* ============================================================================
    |  Fetch Service with optional filters and selected columns.
    ==============================================================================*/
    public function getServices(?array $filterData = null, ?array $selectedcolumns = null): ?Collection
    {
        return $this->serviceRepo->getServices($filterData, $selectedcolumns);
    }
}
