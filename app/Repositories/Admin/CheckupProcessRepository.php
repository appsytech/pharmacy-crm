<?php

namespace App\Repositories\Admin;

use App\Models\CheckupProcess;
use App\Repositories\Admin\Interfaces\CheckupProcessRepositoryInterface;
use Illuminate\Pagination\LengthAwarePaginator;

class CheckupProcessRepository implements CheckupProcessRepositoryInterface
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }


    /* ============================================================================
    | Create a new checkup process schedule record in the database and returns the created record.
    ==============================================================================*/
    public function create(array $data): ?CheckupProcess
    {
        return CheckupProcess::create($data);
    }

    /* ============================================================================
    |   Fetch a single checkup process schedule record by its primary ID.
    ==============================================================================*/
    public function find(int $id, ?array $selectedColumns = null): ?CheckupProcess
    {
        return CheckupProcess::where('id', $id)
            ->when(
                isset($selectedColumns) && count($selectedColumns) >= 1,
                function ($query) use ($selectedColumns) {
                    return $query->select($selectedColumns);
                }
            )
            ->first();
    }


    /* ============================================================================
    |  Fetch checkup process schedule with optional filters and selected columns.
    ==============================================================================*/
    public function getCheckupProcesss(?array $filterData = null, ?array $selectedcolumns = null): ?LengthAwarePaginator
    {
        return CheckupProcess::when(
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
            ->paginate($filterData['paginateLimit'] ?? 10);
    }

    /* ============================================================================
    |Update specific columns of an existing checkup process schedule record.
    ==============================================================================*/
    public function updateColumns(int $id, array $data): bool
    {
        return CheckupProcess::where('id', $id)->update($data);
    }

    /* ================================================
     |Delete existing checkup process schedule record by its id.
     ==================================================*/
    public function delete(int $id): bool
    {
        return CheckupProcess::where('id', $id)->delete();
    }
}
