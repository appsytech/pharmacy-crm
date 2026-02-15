<?php

namespace App\Repositories\Admin;

use App\Models\SupplierPayment;
use App\Repositories\Admin\Interfaces\SupplierPaymentRepositoryInterface;
use Illuminate\Pagination\LengthAwarePaginator;

class SupplierPaymentRepository implements SupplierPaymentRepositoryInterface
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }


    /* ============================================================================
    | Create a new Supplier payment record in the database and returns the created record.
    ==============================================================================*/
    public function create(array $data): ?SupplierPayment
    {
        return SupplierPayment::create($data);
    }

    /* ============================================================================
    |   Fetch a single Supplier  payment record by its primary ID.
    ==============================================================================*/
    public function find(int $id, ?array $selectedColumns = null): ?SupplierPayment
    {
        return SupplierPayment::where('id', $id)
            ->when(
                isset($selectedColumns) && count($selectedColumns) >= 1,
                function ($query) use ($selectedColumns) {
                    return $query->select($selectedColumns);
                }
            )
            ->first();
    }


    /* ============================================================================
    |  Fetch Supplier  payment with optional filters and selected columns.
    ==============================================================================*/
    public function getSupplierPayments(?array $filterData = null, ?array $selectedcolumns = null): ?LengthAwarePaginator
    {
        return SupplierPayment::when(
            isset($filterData['voucherNumber']),
            function ($query) use ($filterData) {
                $query->where('voucher_number', 'LIKE', '%' . $filterData['voucherNumber'] . '%');
            }
        )
            ->when(
                isset($filterData['status']),
                function ($query) use ($filterData) {
                    $query->where('status', 'LIKE', '%' . $filterData['status'] . '%');
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
    |Update specific columns of an existing Supplier  payment record.
    ==============================================================================*/
    public function updateColumns(int $id, array $data): bool
    {
        return SupplierPayment::where('id', $id)->update($data);
    }

    /* ================================================
     |Delete existing Supplier  payment record by its id.
     ==================================================*/
    public function delete(int $id): bool
    {
        return SupplierPayment::where('id', $id)->delete();
    }
}
