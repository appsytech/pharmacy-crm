<?php

namespace App\Repositories\Admin;

use App\Models\Activity;
use App\Repositories\Admin\Interfaces\ActivityRepositoryInterface;
use Carbon\Carbon;
use Illuminate\Pagination\LengthAwarePaginator;

class ActivityRepository implements ActivityRepositoryInterface
{
    /**
     * Create a new class instance.
     */
    public function __construct() {}

    /* ============================================================================
     | Create a new activity record in the database and returns the created record.
     ==============================================================================*/
    public function create(array $data): ?Activity
    {
        return Activity::create([
            'title' => $data['title'],
            'type' => $data['type'],
            'author' => $data['author'],
            'images' => $data['images'],
            'status' => $data['status'],
            'description' => $data['description'],
            'sort' => $data['sort'],
            'created_at' => Carbon::now(),
        ]);
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
                    $query->where('title', 'LIKE', '%'.$filterData['title'].'%');
                }
            )
            ->when(
                isset($filterData['author']),
                function ($query) use ($filterData) {
                    $query->where('author', 'LIKE', '%'.$filterData['author'].'%');
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
            ->paginate($filterData['paginateLimit'] ?? 10);

    }

    /* ============================================================================
     |Update specific columns of an existing activity record.
     ==============================================================================*/
    public function updateColumns(int $id, array $data): bool
    {
        return Activity::where('id', $id)->update($data);
    }

    /* ================================================
     |Delete existing activity record by its id.
     ==================================================*/
    public function delete(int $id): bool
    {
        return Activity::where('id', $id)->delete();
    }
}
