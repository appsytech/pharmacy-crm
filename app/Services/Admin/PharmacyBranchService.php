<?php

namespace App\Services\Admin;

use App\Models\PharmacyBranch;
use App\Repositories\Admin\Interfaces\PharmacyBranchRepositoryInterface;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class PharmacyBranchService
{
    /**
     * Create a new class instance.
     */
    public function __construct(
        protected PharmacyBranchRepositoryInterface $pharmacyBranchRepo
    ) {}


    /* =============================================================
    | Create a new Pharmacy Branch record.
    ================================================================*/
    public function create($request): array
    {
        $data = [
            'code'        => $request->code,
            'name'        => $request->name,
            'address'     => $request->address ?? null,
            'phone'       => $request->phone ?? null,
            'email'       => $request->email ?? null,
            'manager_id'  => $request->manager_id ?? null,
            'status'      => $request->status ?? 'ACTIVE',
            'created_at'  => Carbon::now()

        ];

        $createdPharmacyBranch = $this->pharmacyBranchRepo->create($data);

        if ($createdPharmacyBranch) {
            return [
                'status' => true,
                'message' => ['Pharmacy Branch Created successfully']
            ];
        }


        return [
            'status' => false,
            'message' => ['Something went wrong']
        ];
    }

    /* ============================================================================
    |   Fetch a single Pharmacy Branchrecord by its primary ID.
    ==============================================================================*/
    public function find(int $id, ?array $selectedColumns = null): ?PharmacyBranch
    {
        return $this->pharmacyBranchRepo->find($id, $selectedColumns);
    }

    /* ============================================================================
    |  Fetch Pharmacy Branch with optional filters and selected columns.
    ==============================================================================*/
    public function getPharmacyBranches(?array $filterData = null, ?array $selectedcolumns = null): ?LengthAwarePaginator
    {
        return $this->pharmacyBranchRepo->getPharmacyBranches($filterData, $selectedcolumns);
    }

    /* ============================================================================
    |  Fetch Supplier collections with optional filters and selected columns.
    ==============================================================================*/
    public function getPharmacyBranchesCollection(?array $filterData = null, ?array $selectedcolumns = null): ?Collection
    {
        return $this->pharmacyBranchRepo->getPharmacyBranchesCollection($filterData, $selectedcolumns);
    }

    /* ============================================================================
    | Update an existing Pharmacy Branchrecord .
    ==============================================================================*/
    public function update($request): array
    {
        $branchId = $request->id;

        $data = [
            'code'        => $request->code,
            'name'        => $request->name,
            'address'     => $request->address ?? null,
            'phone'       => $request->phone ?? null,
            'email'       => $request->email ?? null,
            'manager_id'  => $request->manager_id ?? null,
            'status'      => $request->status ?? 'ACTIVE',
            'updated_at' => Carbon::now(),
        ];


        $isUpdated =  $this->pharmacyBranchRepo->updateColumns($branchId, $data);

        if ($isUpdated) {
            return [
                'status' => true,
                'message' => ['Pharmacy Branch Updated successfully']
            ];
        }

        return [
            'status' => false,
            'message' => ['Something went wrong']
        ];
    }



    /* ============================================================================
    | Permanently delete an Pharmacy Branch
    ==============================================================================*/
    public function delete(int $id): bool
    {
        return $this->pharmacyBranchRepo->delete($id);
    }
}
