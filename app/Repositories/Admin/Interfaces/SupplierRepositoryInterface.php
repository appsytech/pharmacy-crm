<?php

namespace App\Repositories\Admin\Interfaces;

use App\Models\Supplier;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

interface SupplierRepositoryInterface
{

    /* ============================================================================
    | Create a new Supplier record in the database and returns the created record.
    ==============================================================================*/
    public function create(array $data): ?Supplier;

    /* ============================================================================
    |   Fetch a single Supplier record by its primary ID.
    ==============================================================================*/
    public function find(int $id, ?array $selectedColumns = null): ?Supplier;


    /* ============================================================================
    |  Fetch Supplier with optional filters and selected columns.
    ==============================================================================*/
    public function getSuppliers(?array $filterData = null, ?array $selectedcolumns = null): ?LengthAwarePaginator;

    /* ============================================================================
    |  Fetch Supplier collection with optional filters and selected columns.
    ==============================================================================*/
    public function getSuppliersCollection(?array $filterData = null, ?array $selectedcolumns = null): ?Collection;

    /* ============================================================================
    |Update specific columns of an existing Supplier record.
    ==============================================================================*/
    public function updateColumns(int $id, array $data): bool;

    /* ================================================
     |Delete existing Supplier record by its id.
     ==================================================*/
    public function delete(int $id): bool;
}
