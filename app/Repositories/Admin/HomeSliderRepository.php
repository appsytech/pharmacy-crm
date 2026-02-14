<?php

namespace App\Repositories\Admin;

use App\Models\HomeSlider;
use App\Repositories\Admin\Interfaces\HomeSliderRepositoryInterface;
use Illuminate\Pagination\LengthAwarePaginator;

class HomeSliderRepository implements HomeSliderRepositoryInterface
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    /* ============================================================================
    | Create a new HomeSlider record in the database and returns the created record.
    ==============================================================================*/
    public function create(array $data): ?HomeSlider
    {
        return HomeSlider::create($data);
    }

    /* ============================================================================
    |   Fetch a single HomeSlider record by its primary ID.
    ==============================================================================*/
    public function find(int $id, ?array $selectedColumns = null): ?HomeSlider
    {
        return HomeSlider::where('id', $id)
            ->when(
                isset($selectedColumns) && count($selectedColumns) >= 1,
                function ($query) use ($selectedColumns) {
                    return $query->select($selectedColumns);
                }
            )
            ->first();
    }

    /* ============================================================================
    |  Fetch HomeSlider with optional filters and selected columns.
    ==============================================================================*/
    public function getHomeSliders(?array $filterData = null, ?array $selectedcolumns = null): ?LengthAwarePaginator
    {
        return HomeSlider::when(
            isset($filterData['type']),
            function ($query) use ($filterData) {
                $query->where('type', 'LIKE', '%'.$filterData['type'].'%');
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
    |Update specific columns of an existing HomeSlider record.
    ==============================================================================*/
    public function updateColumns(int $id, array $data): bool
    {
        return HomeSlider::where('id', $id)->update($data);

    }

    /* ================================================
     |Delete existing HomeSlider record by its id.
     ==================================================*/
    public function delete(int $id): bool
    {
        return HomeSlider::where('id', $id)->delete();

    }
}
