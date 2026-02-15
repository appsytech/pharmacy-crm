<?php

namespace App\Repositories\Admin\Interfaces;

use App\Models\SupplierPayment;
use Illuminate\Pagination\LengthAwarePaginator;

interface SupplierPaymentRepositoryInterface
{
    
    /* ============================================================================
    | Create a new Supplier payment record in the database and returns the created record.
    ==============================================================================*/
    public function create(array $data): ?SupplierPayment;

    /* ============================================================================
    |   Fetch a single Supplier  payment record by its primary ID.
    ==============================================================================*/
    public function find(int $id, ?array $selectedColumns = null): ?SupplierPayment;


    /* ============================================================================
    |  Fetch Supplier  payment with optional filters and selected columns.
    ==============================================================================*/
    public function getSupplierPayments(?array $filterData = null, ?array $selectedcolumns = null): ?LengthAwarePaginator;

   
    /* ============================================================================
    |Update specific columns of an existing Supplier  payment record.
    ==============================================================================*/
    public function updateColumns(int $id, array $data): bool;

    /* ================================================
     |Delete existing Supplier  payment record by its id.
     ==================================================*/
    public function delete(int $id): bool;
}
