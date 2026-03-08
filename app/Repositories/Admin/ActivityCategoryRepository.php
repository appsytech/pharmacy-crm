<?php

namespace App\Repositories\Admin;

use App\Models\ActivityCategory;
use App\Repositories\Admin\Interfaces\ActivityCategoryRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class ActivityCategoryRepository implements ActivityCategoryRepositoryInterface
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    /* ============================================================================
    | Create a new Activity Category record in the database and returns the created record.
    ==============================================================================*/
    public function create(array $data): ?ActivityCategory
    {
        return ActivityCategory::create($data);
    }

    /* ============================================================================
    |   Fetch a single Activity Category record by its primary ID.
    ==============================================================================*/
    public function find(int $id, ?array $selectedColumns = null): ?ActivityCategory
    {
        return ActivityCategory::where('id', $id)
            ->when(
                isset($selectedColumns) && count($selectedColumns) >= 1,
                function ($query) use ($selectedColumns) {
                    return $query->select($selectedColumns);
                }
            )
            ->first();
    }

    /* ============================================================================
    |  Fetch Activity Category with optional filters and selected columns.
    ==============================================================================*/
    public function getActivityCategories(?array $filterData = null, ?array $selectedcolumns = null): ?LengthAwarePaginator
    {

        return ActivityCategory::when(
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
            ->orderBy('sort', 'asc')
            ->paginate($filterData['paginateLimit'] ?? 10);
    }

    /* ============================================================================
    |  Fetch Activity Category Collection with optional filters and selected columns.
    ==============================================================================*/
    public function getActivityCategoriesCollection(?array $filterData = null, ?array $selectedcolumns = null): ?Collection
    {
        return ActivityCategory::when(
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
    |Update specific columns of an existing Activity Category record.
    ==============================================================================*/
    public function updateColumns(int $id, array $data): bool
    {
        return ActivityCategory::where('id', $id)->update($data);
    }

    /* ================================================
     |Delete existing Activity Category record by its id.
     ==================================================*/
    public function delete(int $id): bool
    {
        return ActivityCategory::where('id', $id)->delete();
    }
}
