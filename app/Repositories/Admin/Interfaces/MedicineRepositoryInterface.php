<?php

namespace App\Repositories\Admin\Interfaces;

use App\Models\Medicine;
use Illuminate\Pagination\LengthAwarePaginator;

interface MedicineRepositoryInterface
{

    /* ============================================================================
    | Create a new Medicine record in the database and returns the created record.
    ==============================================================================*/
    public function create(array $data): ?Medicine;

    /* ============================================================================
    |   Fetch a single Medicine record by its primary ID.
    ==============================================================================*/
    public function find(int $id, ?array $selectedColumns = null): ?Medicine;


    /* ============================================================================
    |  Fetch Medicine with optional filters and selected columns.
    ==============================================================================*/
    public function getMedicines(?array $filterData = null, ?array $selectedcolumns = null): ?LengthAwarePaginator;

    /* ============================================================================
    |Update specific columns of an existing Medicine record.
    ==============================================================================*/
    public function updateColumns(int $id, array $data): bool;

    /* ================================================
     |Delete existing Medicine record by its id.
     ==================================================*/
    public function delete(int $id): bool;
}
