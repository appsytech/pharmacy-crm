<?php

namespace App\Repositories\Admin;

use App\Models\PharmacyBranch;
use App\Repositories\Admin\Interfaces\PharmacyBranchRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class PharmacyBranchRepository implements PharmacyBranchRepositoryInterface
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }



    /* ============================================================================
    | Create a new Pharmacy Branches record in the database and returns the created record.
    ==============================================================================*/
    public function create(array $data): ?PharmacyBranch
    {
        return PharmacyBranch::create($data);
    }

    /* ============================================================================
    |   Fetch a single Pharmacy Branches record by its primary ID.
    ==============================================================================*/
    public function find(int $id, ?array $selectedColumns = null): ?PharmacyBranch
    {
        return PharmacyBranch::where('id', $id)
            ->when(
                isset($selectedColumns) && count($selectedColumns) >= 1,
                function ($query) use ($selectedColumns) {
                    return $query->select($selectedColumns);
                }
            )
            ->first();
    }


    /* ============================================================================
    |  Fetch Pharmacy Branches with optional filters and selected columns.
    ==============================================================================*/
    public function getPharmacyBranches(?array $filterData = null, ?array $selectedcolumns = null): ?LengthAwarePaginator
    {
        return PharmacyBranch::when(
            isset($filterData['name']),
            function ($query) use ($filterData) {
                $query->where('name', 'LIKE', '%' . $filterData['name'] . '%');
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
            ->paginate($filterData['paginateLimit'] ?? 10);
    }

    /* ============================================================================
    |  Fetch Pharmacy Branches collection with optional filters and selected columns.
    ==============================================================================*/
    public function getPharmacyBranchesCollection(?array $filterData = null, ?array $selectedcolumns = null): ?Collection
    {
        return PharmacyBranch::when(
            isset($filterData['name']),
            function ($query) use ($filterData) {
                $query->where('name', 'LIKE', '%' . $filterData['name'] . '%');
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
            ->get();
    }

    /* ============================================================================
    |Update specific columns of an existing Pharmacy Branches record.
    ==============================================================================*/
    public function updateColumns(int $id, array $data): bool
    {
        return PharmacyBranch::where('id', $id)->update($data);
    }

    /* ================================================
     |Delete existing Pharmacy Branches record by its id.
     ==================================================*/
    public function delete(int $id): bool
    {
        return PharmacyBranch::where('id', $id)->delete();
    }
}
