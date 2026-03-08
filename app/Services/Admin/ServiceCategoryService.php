<?php

namespace App\Services\Admin;

use App\Models\ServiceCategory;
use App\Repositories\Admin\Interfaces\ServiceCategoryRepositoryInterface;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Auth;

class ServiceCategoryService
{
    /**
     * Create a new class instance.
     */
    public function __construct(
        protected ServiceCategoryRepositoryInterface $serviceCategoryRepo
    ) {}


    /* =============================================================
    | Create a new service category record.
    ================================================================*/
    public function create($request)
    {
        $data = [
            'title'               => $request->title,
            'created_by'          => Auth::user()->name,
            'created_at'          => Carbon::now(),
            'status'              => $request->status ?? 1,
            'sort'               => (int) $request->sort,
        ];

        $isCreated = $this->serviceCategoryRepo->create($data);

        if ($isCreated) {

            return response()->json([
                'status' => true,
                'code' => 200,
                'messages' => ['Service Category Created Successfully'],
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
    |   Fetch a single service category record by its primary ID.
    ==============================================================================*/
    public function find(int $id, ?array $selectedColumns = null): ?ServiceCategory
    {
        return $this->serviceCategoryRepo->find($id, $selectedColumns);
    }

    /* ============================================================================
    |  Fetch service category with optional filters and selected columns.
    ==============================================================================*/
    public function getServiceCategories(?array $filterData = null, ?array $selectedcolumns = null): ?LengthAwarePaginator
    {
        return $this->serviceCategoryRepo->getServiceCategories($filterData, $selectedcolumns);
    }

    /* ============================================================================
    |  Fetch Service Category Collection with optional filters and selected columns.
    ==============================================================================*/
    public function getServiceCategoriesCollection(?array $filterData = null, ?array $selectedcolumns = null): ?Collection
    {
        return $this->serviceCategoryRepo->getServiceCategoriesCollection($filterData, $selectedcolumns);
    }


    /* ============================================================================
    | Update an existing service category record .
    ==============================================================================*/
    public function update($request): bool
    {
        $serviceCategoryId = $request->id;

        $data = [
            'title'               => $request->title,
            'updated_by'          => Auth::user()->name,
            'updated_at'          => Carbon::now(),
            'status'              => $request->status ?? 1,
            'sort'               => (int) $request->sort,
        ];

        return $this->serviceCategoryRepo->updateColumns($serviceCategoryId, $data);
    }

    /* ============================================================================
    | Toggle  service category status.
    ==============================================================================*/
    public function updateStatus(int $id): bool
    {
        $serviceCategory = $this->serviceCategoryRepo->find($id, ['id', 'status']);

        if (! $serviceCategory) {
            return false;
        }

        return $this->serviceCategoryRepo->updateColumns($id, [
            'status' => ! $serviceCategory->status,
        ]);
    }

    /* ============================================================================
    | Permanently delete an service category.
    ==============================================================================*/
    public function delete(int $id): bool
    {
        return $this->serviceCategoryRepo->delete($id);
    }
}
