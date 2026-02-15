<?php

namespace App\Services\Admin;

use App\Models\SupplierPayment;
use App\Repositories\Admin\Interfaces\PharmacyBranchRepositoryInterface;
use App\Repositories\Admin\Interfaces\SupplierPaymentRepositoryInterface;
use App\Repositories\Admin\Interfaces\SupplierRepositoryInterface;
use Carbon\Carbon;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Auth;

class SupplierPaymentServices
{
    /**
     * Create a new class instance.
     */
    public function __construct(
        protected SupplierPaymentRepositoryInterface $supplierPaymentRepo,
        protected SupplierRepositoryInterface $supplierRepo,
        protected PharmacyBranchRepositoryInterface $pharmacyBranchRepo
    ) {}




    /* =============================================================
    | Create a new supplier payment record.
    ================================================================*/
    public function create($request): array
    {
        $loggedInUserName =  Auth::user()->name;
        $supplierId =  (int) $request->supplier_id;
        $pharmacyBranchId  =  (int) $request->pharmacy_branch_id;

        $supplierName = $this->supplierRepo->find($supplierId, ['supplier_name'])?->supplier_name;
        $pharmacyBranchName =  $this->pharmacyBranchRepo->find($pharmacyBranchId, ['name'])?->name;

        $data = [
            'voucher_number'      => $request->voucher_number,
            'supplier_id'         => $supplierId,
            'supplier_name'       => $supplierName,
            'pharmacy_branch_id'  => $pharmacyBranchId,
            'pharmacy_branch_name' => $pharmacyBranchName,
            'payment_date'        => $request->payment_date,
            'amount'              => $request->amount,
            'payment_method'      => $request->payment_method,
            'payment_reference'   => $request->payment_reference,
            'status'              => $request->status ?? 'COMPLETED',
            'description'         => $request->description,
            'payment_due_date'    => $request->payment_due_date,
            'created_by'          => $loggedInUserName ?? null,
            'approved_by'         => $request->approved_by ?? null,
            'created_at'          => Carbon::now(),
        ];

        $createdPayment = $this->supplierPaymentRepo->create($data);

        if ($createdPayment) {
            return [
                'status' => true,
                'message' => ['Supplier Payment Created successfully']
            ];
        }


        return [
            'status' => false,
            'message' => ['Something went wrong']
        ];
    }

    /* ============================================================================
    |   Fetch a single supplier payment record by its primary ID.
    ==============================================================================*/
    public function find(int $id, ?array $selectedColumns = null): ?SupplierPayment
    {
        return $this->supplierPaymentRepo->find($id, $selectedColumns);
    }

    /* ============================================================================
    |  Fetch suppliers payment with optional filters and selected columns.
    ==============================================================================*/
    public function getSupplierPayments(?array $filterData = null, ?array $selectedcolumns = null): ?LengthAwarePaginator
    {
        return $this->supplierPaymentRepo->getSupplierPayments($filterData, $selectedcolumns);
    }



    /* ============================================================================
    | Update an existing supplier payment record .
    ==============================================================================*/
    public function update($request): array
    {
        $paymentId = $request->id;
        $supplierId =  (int) $request->supplier_id;
        $pharmacyBranchId  =  (int) $request->pharmacy_branch_id;


        $supplierName = $this->supplierRepo->find($supplierId, ['supplier_name'])?->supplier_name;
        $pharmacyBranchName =  $this->pharmacyBranchRepo->find($pharmacyBranchId, ['name'])?->name;


        $data = [
            'voucher_number'      => $request->voucher_number,
            'supplier_id'         => $supplierId,
            'supplier_name'       => $supplierName,
            'pharmacy_branch_id'  => $pharmacyBranchId,
            'pharmacy_branch_name' => $pharmacyBranchName,
            'payment_date'        => $request->payment_date,
            'amount'              => $request->amount,
            'payment_method'      => $request->payment_method,
            'payment_reference'   => $request->payment_reference,
            'status'              => $request->status ?? 'COMPLETED',
            'description'         => $request->description,
            'payment_due_date'    => $request->payment_due_date,
            'created_by'          => $loggedInUserName ?? null,
            'approved_by'         => $request->approved_by ?? null,
            'updated_at' => Carbon::now(),
        ];


        $isUpdated =  $this->supplierPaymentRepo->updateColumns($paymentId, $data);

        if ($isUpdated) {
            return [
                'status' => true,
                'message' => ['Supplier  Payment Updated successfully']
            ];
        }

        return [
            'status' => false,
            'message' => ['Something went wrong']
        ];
    }



    /* ============================================================================
    | Permanently delete an supplier payment.
    ==============================================================================*/
    public function delete(int $id): bool
    {
        return $this->supplierPaymentRepo->delete($id);
    }
}
