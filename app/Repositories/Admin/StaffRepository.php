<?php

namespace App\Repositories\Admin;

use App\Models\Staff;
use App\Repositories\Admin\Interfaces\StaffRepositoryInterface;
use Illuminate\Pagination\LengthAwarePaginator;

class StaffRepository implements StaffRepositoryInterface
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }


    
    /* ============================================================================
    | Create a new staff record in the database and returns the created record.
    ==============================================================================*/
    public function create(array $data): ?Staff
    {
        return Staff::create($data);

    }

    /* ============================================================================
    |   Fetch a single staff record by its primary ID.
    ==============================================================================*/
    public function find(int $id, ?array $selectedColumns = null): ?Staff
    {
        
        return Staff::where('id', $id)
            ->when(
                isset($selectedColumns) && count($selectedColumns) >= 1,
                function ($query) use ($selectedColumns) {
                    return $query->select($selectedColumns);
                }
            )
            ->first();
    }

    /* ============================================================================
    |  Fetch staff with optional filters and selected columns.
    ==============================================================================*/
    public function getStaffs(?array $filterData = null, ?array $selectedcolumns = null): ?LengthAwarePaginator
    {
          return Staff::when(
            isset($filterData['fullName']),
            function ($query) use ($filterData) {
                $query->where('full_name', 'LIKE', '%' . $filterData['fullName'] . '%');
            }
        )
            ->when(
                isset($filterData['email']),
                function ($query) use ($filterData) {
                    $query->where('email', 'LIKE', '%' . $filterData['email'] . '%');
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
    |Update specific columns of an existing staff record.
    ==============================================================================*/
    public function updateColumns(int $id, array $data): bool
    {
        return Staff::where("id", $id)->update($data);

    }

    /* ================================================
     |Delete existing staff record by its id.
     ==================================================*/
    public function delete(int $id): bool
    {
        return Staff::where('id', $id)->delete();

    }
}
