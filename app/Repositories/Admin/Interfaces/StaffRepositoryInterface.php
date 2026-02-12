<?php

namespace App\Repositories\Admin\Interfaces;

use App\Models\Staff;
use Illuminate\Pagination\LengthAwarePaginator;

interface StaffRepositoryInterface
{

    /* ============================================================================
    | Create a new staff record in the database and returns the created record.
    ==============================================================================*/
    public function create(array $data): ?Staff;

    /* ============================================================================
    |   Fetch a single staff record by its primary ID.
    ==============================================================================*/
    public function find(int $id, ?array $selectedColumns = null): ?Staff;

    /* ============================================================================
    |  Fetch staff with optional filters and selected columns.
    ==============================================================================*/
    public function getStaffs(?array $filterData = null, ?array $selectedcolumns = null): ?LengthAwarePaginator;

    /* ============================================================================
    |Update specific columns of an existing staff record.
    ==============================================================================*/
    public function updateColumns(int $id, array $data): bool;

    /* ================================================
     |Delete existing staff record by its id.
     ==================================================*/
    public function delete(int $id): bool;
}
