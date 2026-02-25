<?php

namespace App\Repositories\Admin;

use App\Models\PharmacySchedule;
use App\Repositories\Admin\Interfaces\PharmacyScheduleRepositoryInterface;
use Illuminate\Pagination\LengthAwarePaginator;

class PharmacyScheduleRepository implements PharmacyScheduleRepositoryInterface
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }


    /* ============================================================================
    | Create a new pharmacy schedule record in the database and returns the created record.
    ==============================================================================*/
    public function create(array $data): ?PharmacySchedule
    {
        return PharmacySchedule::create($data);
    }

    /* ============================================================================
    |   Fetch a single pharmacy schedule record by its primary ID.
    ==============================================================================*/
    public function find(int $id, ?array $selectedColumns = null): ?PharmacySchedule
    {
        return PharmacySchedule::where('id', $id)
            ->when(
                isset($selectedColumns) && count($selectedColumns) >= 1,
                function ($query) use ($selectedColumns) {
                    return $query->select($selectedColumns);
                }
            )
            ->first();
    }


    /* ============================================================================
    |  Fetch pharmacy schedule with optional filters and selected columns.
    ==============================================================================*/
    public function getPharmacySchedules(?array $filterData = null, ?array $selectedcolumns = null): ?LengthAwarePaginator
    {
        return PharmacySchedule::when(
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
    |Update specific columns of an existing pharmacy schedule record.
    ==============================================================================*/
    public function updateColumns(int $id, array $data): bool
    {
        return PharmacySchedule::where('id', $id)->update($data);
    }

    /* ================================================
     |Delete existing pharmacy schedule record by its id.
     ==================================================*/
    public function delete(int $id): bool
    {
        return PharmacySchedule::where('id', $id)->delete();
    }
}
