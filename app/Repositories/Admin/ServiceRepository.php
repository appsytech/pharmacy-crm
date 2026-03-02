<?php

namespace App\Repositories\Admin;

use App\Models\Service;
use App\Repositories\Admin\Interfaces\ServiceRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

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
    | Create a new Service record in the database and returns the created record.
    ==============================================================================*/
    public function create(array $data): ?Service
    {

        return Service::create($data);
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
    public function getServices(?array $filterData = null, ?array $selectedcolumns = null): ?LengthAwarePaginator
    {
        return Service::when(
            isset($filterData['title']),
            function ($query) use ($filterData) {
                $query->where('title', 'LIKE', '%' . $filterData['title'] . '%');
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
            ->paginate($filterData['paginateLimit'] ?? 10);
    }

    /* ============================================================================
    |Update specific columns of an existing Service record.
    ==============================================================================*/
    public function updateColumns(int $id, array $data): bool
    {
        return Service::where('id', $id)->update($data);
    }

    /* ================================================
     |Delete existing Service record by its id.
     ==================================================*/
    public function delete(int $id): bool
    {
        return Service::where('id', $id)->delete();
    }
}
