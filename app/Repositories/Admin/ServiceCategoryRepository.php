<?php

namespace App\Repositories\Admin;

use App\Models\ServiceCategory;
use App\Repositories\Admin\Interfaces\ServiceCategoryRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class ServiceCategoryRepository implements ServiceCategoryRepositoryInterface
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }


    /* ============================================================================
    | Create a new Service Category record in the database and returns the created record.
    ==============================================================================*/
    public function create(array $data): ?ServiceCategory
    {
        return ServiceCategory::create($data);
    }

    /* ============================================================================
    |   Fetch a single Service Category record by its primary ID.
    ==============================================================================*/
    public function find(int $id, ?array $selectedColumns = null): ?ServiceCategory
    {

        return ServiceCategory::where('id', $id)
            ->when(
                isset($selectedColumns) && count($selectedColumns) >= 1,
                function ($query) use ($selectedColumns) {
                    return $query->select($selectedColumns);
                }
            )
            ->first();
    }

    /* ============================================================================
    |  Fetch Service Category with optional filters and selected columns.
    ==============================================================================*/
    public function getServiceCategories(?array $filterData = null, ?array $selectedcolumns = null): ?LengthAwarePaginator
    {
        return ServiceCategory::when(
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
    |  Fetch Service Category Collection with optional filters and selected columns.
    ==============================================================================*/
    public function getServiceCategoriesCollection(?array $filterData = null, ?array $selectedcolumns = null): ?Collection
    {

        return ServiceCategory::when(
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
            ->get();
    }

    /* ============================================================================
    |Update specific columns of an existing Service Category record.
    ==============================================================================*/
    public function updateColumns(int $id, array $data): bool
    {
        return ServiceCategory::where('id', $id)->update($data);
    }

    /* ================================================
     |Delete existing Service Category record by its id.
     ==================================================*/
    public function delete(int $id): bool
    {
        return ServiceCategory::where('id', $id)->delete();
    }
}
