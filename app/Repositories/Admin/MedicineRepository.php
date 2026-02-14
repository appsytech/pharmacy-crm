<?php

namespace App\Repositories\Admin;

use App\Models\Medicine;
use App\Repositories\Admin\Interfaces\MedicineRepositoryInterface;
use Illuminate\Pagination\LengthAwarePaginator;

class MedicineRepository implements MedicineRepositoryInterface
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }


    /* ============================================================================
    | Create a new Medicine record in the database and returns the created record.
    ==============================================================================*/
    public function create(array $data): ?Medicine
    {
        return Medicine::create($data);
    }

    /* ============================================================================
    |   Fetch a single Medicine record by its primary ID.
    ==============================================================================*/
    public function find(int $id, ?array $selectedColumns = null): ?Medicine
    {
        return Medicine::where('id', $id)
            ->when(
                isset($selectedColumns) && count($selectedColumns) >= 1,
                function ($query) use ($selectedColumns) {
                    return $query->select($selectedColumns);
                }
            )
            ->first();
    }


    /* ============================================================================
    |  Fetch Medicine with optional filters and selected columns.
    ==============================================================================*/
    public function getMedicines(?array $filterData = null, ?array $selectedcolumns = null): ?LengthAwarePaginator
    {
        return Medicine::when(
            isset($filterData['name']),
            function ($query) use ($filterData) {
                $query->where('name', 'LIKE', '%' . $filterData['name'] . '%');
            }
        )
            ->when(
                isset($filterData['category']),
                function ($query) use ($filterData) {
                    $query->where('category', 'LIKE', '%' . $filterData['category'] . '%');
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
    |Update specific columns of an existing Medicine record.
    ==============================================================================*/
    public function updateColumns(int $id, array $data): bool
    {
        return Medicine::where('id', $id)->update($data);
    }

    /* ================================================
     |Delete existing Medicine record by its id.
     ==================================================*/
    public function delete(int $id): bool
    {
        return Medicine::where('id', $id)->delete();
    }
}
