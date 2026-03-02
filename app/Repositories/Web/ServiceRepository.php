<?php

namespace App\Repositories\Web;

use App\Models\Service;
use App\Repositories\Web\Interfaces\ServiceRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class ServiceRepository implements ServiceRepositoryInterface
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }


    /* ============================================================================
    |   Fetch a single Service record by its primary ID.
    ==============================================================================*/
    public function find(int $id, ?array $selectedColumns = null): ?Service
    {
        return Service::where('id', $id)
            ->when(
                isset($selectedColumns) && count($selectedColumns) >= 1,
                function ($query) use ($selectedColumns) {
                    return $query->select($selectedColumns);
                }
            )
            ->first();
    }

    /* ============================================================================
    |  Fetch Service with optional filters and selected columns.
    ==============================================================================*/
    public function getServices(?array $filterData = null, ?array $selectedcolumns = null): ?Collection
    {
        return Service::when(
            isset($filterData['title']),
            function ($query) use ($filterData) {
                $query->where('title', 'LIKE', '%' . $filterData['title'] . '%');
            }
        )
            ->when(
                isset($filterData['exceptId']) && is_numeric($filterData['exceptId']),
                function ($query) use ($filterData) {
                    return $query->where('id', '!=', $filterData['exceptId']);
                }
            )
            ->when(
                isset($filterData['status']),
                function ($query) use ($filterData) {
                    $query->where('status', $filterData['status']);
                }
            )
            ->when(
                isset($selectedcolumns) && count($selectedcolumns) >= 1,
                function ($query) use ($selectedcolumns) {
                    return $query->select($selectedcolumns);
                }
            )
            ->orderBy('sort', 'asc')
            ->where('status', true)
            ->get();
    }
}
