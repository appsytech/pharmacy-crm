<?php

namespace App\Repositories\Web;

use App\Models\Activity;
use App\Repositories\Web\Interfaces\ActivityRepositoryInterface;
use Illuminate\Pagination\LengthAwarePaginator;

class ActivityRepository implements ActivityRepositoryInterface
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }



    /* ============================================================================
     |   Fetch a single Activity record by its primary ID.
     ==============================================================================*/
    public function find(int $id, ?array $selectedColumns = null): ?Activity
    {
        return Activity::where('id', $id)
            ->when(
                isset($selectedColumns) && count($selectedColumns) >= 1,
                function ($query) use ($selectedColumns) {
                    return $query->select($selectedColumns);
                }
            )
            ->first();
    }

    /* ============================================================================
     |Retrieve activities list with optional filters and column selection.
     ==============================================================================*/
    public function getActivities(?array $filterData = null, ?array $selectedColumns = null): ?LengthAwarePaginator
    {
        return Activity::when(
            isset($filterData['limit']) && is_numeric($filterData['limit']),
            function ($query) use ($filterData) {
                return $query->limit($filterData['limit']);
            }
        )
            ->when(
                isset($filterData['title']),
                function ($query) use ($filterData) {
                    $query->where('title', 'LIKE', '%' . $filterData['title'] . '%');
                }
            )
            ->when(
                isset($filterData['author']),
                function ($query) use ($filterData) {
                    $query->where('author', 'LIKE', '%' . $filterData['author'] . '%');
                }
            )
            ->when(
                isset($filterData['type']),
                function ($query) use ($filterData) {
                    $query->where('type', $filterData['type']);
                }
            )
            ->when(
                isset($selectedColumns) && count($selectedColumns) >= 1,
                function ($query) use ($selectedColumns) {
                    return $query->select($selectedColumns);
                }
            )
            ->where('status', true)
            ->orderBy('sort', 'asc')
            ->paginate($filterData['paginateLimit'] ?? 10);
    }
}
