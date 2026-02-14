<?php

namespace App\Repositories\Admin;

use App\Models\Supplier;
use App\Repositories\Admin\Interfaces\SupplierRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class SupplierRepository implements SupplierRepositoryInterface
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }


    /* ============================================================================
    | Create a new Supplier record in the database and returns the created record.
    ==============================================================================*/
    public function create(array $data): ?Supplier
    {
        return Supplier::create($data);
    }

    /* ============================================================================
    |   Fetch a single Supplier record by its primary ID.
    ==============================================================================*/
    public function find(int $id, ?array $selectedColumns = null): ?Supplier
    {
        return Supplier::where('id', $id)
            ->when(
                isset($selectedColumns) && count($selectedColumns) >= 1,
                function ($query) use ($selectedColumns) {
                    return $query->select($selectedColumns);
                }
            )
            ->first();
    }


    /* ============================================================================
    |  Fetch Supplier with optional filters and selected columns.
    ==============================================================================*/
    public function getSuppliers(?array $filterData = null, ?array $selectedcolumns = null): ?LengthAwarePaginator
    {
        return Supplier::when(
            isset($filterData['supplierName']),
            function ($query) use ($filterData) {
                $query->where('supplier_name', 'LIKE', '%' . $filterData['supplierName'] . '%');
            }
        )
            ->when(
                isset($filterData['phone']),
                function ($query) use ($filterData) {
                    $query->where('phone', 'LIKE', '%' . $filterData['phone'] . '%');
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
    |  Fetch Supplier collections with optional filters and selected columns.
    ==============================================================================*/
    public function getSuppliersCollection(?array $filterData = null, ?array $selectedcolumns = null): ?Collection
    {
        return Supplier::when(
            isset($filterData['supplierName']),
            function ($query) use ($filterData) {
                $query->where('supplier_name', 'LIKE', '%' . $filterData['supplierName'] . '%');
            }
        )
            ->when(
                isset($filterData['phone']),
                function ($query) use ($filterData) {
                    $query->where('phone', 'LIKE', '%' . $filterData['phone'] . '%');
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
    |Update specific columns of an existing Supplier record.
    ==============================================================================*/
    public function updateColumns(int $id, array $data): bool
    {
        return Supplier::where('id', $id)->update($data);
    }

    /* ================================================
     |Delete existing Supplier record by its id.
     ==================================================*/
    public function delete(int $id): bool
    {
        return Supplier::where('id', $id)->delete();
    }
}
