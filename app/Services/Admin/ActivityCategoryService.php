<?php

namespace App\Services\Admin;

use App\Models\ActivityCategory;
use App\Repositories\Admin\Interfaces\ActivityCategoryRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class ActivityCategoryService
{
    /**
     * Create a new class instance.
     */
    public function __construct(
        protected ActivityCategoryRepositoryInterface $activityCategoryRepo
    ) {}




    /* =============================================================
    | Create a new Activity category record.
    ================================================================*/
    public function create($request)
    {
        $data = [
            'name'               => $request->name,
            'status'              => $request->status ?? 1,
            'sort'               => (int) $request->sort,
        ];

        $isCreated = $this->activityCategoryRepo->create($data);

        if ($isCreated) {

            return response()->json([
                'status' => true,
                'code' => 200,
                'messages' => ['Activity Category Created Successfully'],
                'errors' => null,
                'data' => null,
            ], 200);
        } else {

            return response()->json([
                'status' => false,
                'code' => 500,
                'messages' => ['Something went wrong'],
                'errors' => ['Something went wrong'],
                'data' => null,
            ], 500);
        }
    }

    /* ============================================================================
    |   Fetch a single Activity category record by its primary ID.
    ==============================================================================*/
    public function find(int $id, ?array $selectedColumns = null): ?ActivityCategory
    {
        return $this->activityCategoryRepo->find($id, $selectedColumns);
    }

    /* ============================================================================
    |  Fetch Activity category with optional filters and selected columns.
    ==============================================================================*/
    public function getActivityCategories(?array $filterData = null, ?array $selectedcolumns = null): ?LengthAwarePaginator
    {
        return $this->activityCategoryRepo->getActivityCategories($filterData, $selectedcolumns);
    }

    /* ============================================================================
    |  Fetch Activity Category Collection with optional filters and selected columns.
    ==============================================================================*/
    public function getActivityCategoriesCollection(?array $filterData = null, ?array $selectedcolumns = null): ?Collection
    {
        return $this->activityCategoryRepo->getActivityCategoriesCollection($filterData, $selectedcolumns);
    }


    /* ============================================================================
    | Update an existing Activity category record .
    ==============================================================================*/
    public function update($request): bool
    {
        $activityCategoryId = $request->id;

        $data = [
            'name'               => $request->name,
            'status'              => $request->status ?? 1,
            'sort'               => (int) $request->sort,
        ];

        return $this->activityCategoryRepo->updateColumns($activityCategoryId, $data);
    }

    /* ============================================================================
    | Toggle  Activity category status.
    ==============================================================================*/
    public function updateStatus(int $id): bool
    {
        $activityCategory = $this->activityCategoryRepo->find($id, ['id', 'status']);

        if (! $activityCategory) {
            return false;
        }

        return $this->activityCategoryRepo->updateColumns($id, [
            'status' => ! $activityCategory->status,
        ]);
    }

    /* ============================================================================
    | Permanently delete an Activity category.
    ==============================================================================*/
    public function delete(int $id): bool
    {
        return $this->activityCategoryRepo->delete($id);
    }
}
