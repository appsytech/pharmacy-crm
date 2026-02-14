<?php

namespace App\Services\Admin;

use App\Models\Supplier;
use App\Repositories\Admin\Interfaces\SupplierRepositoryInterface;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class SupplierService
{
    /**
     * Create a new class instance.
     */
    public function __construct(
        protected SupplierRepositoryInterface $supplierRepo
    ) {}




    /* =============================================================
    | Create a new supplier record.
    ================================================================*/
    public function create($request): array
    {
        $data = [
            'supplier_name'           => $request->supplier_name,
            'contact_person'          => $request->contact_person ?? null,
            'phone'                   => $request->phone,
            'email'                   => $request->email ?? null,
            'address'                 => $request->address ?? null,
            'city'                    => $request->city ?? null,
            'state'                   => $request->state ?? null,
            'country'                 => $request->country ?? null,
            'supplier_business_number' => $request->supplier_business_number ?? null,
            'payment_terms'           => $request->payment_terms ?? null,
            'status'                  => $request->status ?? 'ACTIVE',
            'created_at'  => Carbon::now()

        ];

        $createdSupplier = $this->supplierRepo->create($data);

        if ($createdSupplier) {
            return [
                'status' => true,
                'message' => ['Supplier Created successfully']
            ];
        }


        return [
            'status' => false,
            'message' => ['Something went wrong']
        ];
    }

    /* ============================================================================
    |   Fetch a single supplier record by its primary ID.
    ==============================================================================*/
    public function find(int $id, ?array $selectedColumns = null): ?Supplier
    {
        return $this->supplierRepo->find($id, $selectedColumns);
    }

    /* ============================================================================
    |  Fetch suppliers with optional filters and selected columns.
    ==============================================================================*/
    public function getSuppliers(?array $filterData = null, ?array $selectedcolumns = null): ?LengthAwarePaginator
    {
        return $this->supplierRepo->getSuppliers($filterData, $selectedcolumns);
    }

    /* ============================================================================
    |  Fetch Supplier collections with optional filters and selected columns.
    ==============================================================================*/
    public function getSuppliersCollection(?array $filterData = null, ?array $selectedcolumns = null): ?Collection
    {
        return $this->supplierRepo->getSuppliersCollection($filterData, $selectedcolumns);
    }

    /* ============================================================================
    | Update an existing supplier record .
    ==============================================================================*/
    public function update($request): array
    {
        $supplierId = $request->id;

        $data = [
            'supplier_name'           => $request->supplier_name,
            'contact_person'          => $request->contact_person ?? null,
            'phone'                   => $request->phone,
            'email'                   => $request->email ?? null,
            'address'                 => $request->address ?? null,
            'city'                    => $request->city ?? null,
            'state'                   => $request->state ?? null,
            'country'                 => $request->country ?? null,
            'supplier_business_number' => $request->supplier_business_number ?? null,
            'payment_terms'           => $request->payment_terms ?? null,
            'status'                  => $request->status ?? 'ACTIVE',
            'updated_at' => Carbon::now(),
        ];


        $isUpdated =  $this->supplierRepo->updateColumns($supplierId, $data);

        if ($isUpdated) {
            return [
                'status' => true,
                'message' => ['Supplier Updated successfully']
            ];
        }

        return [
            'status' => false,
            'message' => ['Something went wrong']
        ];
    }



    /* ============================================================================
    | Permanently delete an supplier.
    ==============================================================================*/
    public function delete(int $id): bool
    {
        return $this->supplierRepo->delete($id);
    }
}
