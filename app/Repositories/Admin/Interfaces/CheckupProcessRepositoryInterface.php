<?php

namespace App\Repositories\Admin\Interfaces;

use App\Models\CheckupProcess;
use Illuminate\Pagination\LengthAwarePaginator;

interface CheckupProcessRepositoryInterface
{
    
    /* ============================================================================
    | Create a new checkup process schedule record in the database and returns the created record.
    ==============================================================================*/
    public function create(array $data): ?CheckupProcess;

    /* ============================================================================
    |   Fetch a single checkup process schedule record by its primary ID.
    ==============================================================================*/
    public function find(int $id, ?array $selectedColumns = null): ?CheckupProcess;

  
    /* ============================================================================
    |  Fetch checkup process schedule with optional filters and selected columns.
    ==============================================================================*/
    public function getCheckupProcesss(?array $filterData = null, ?array $selectedcolumns = null): ?LengthAwarePaginator;

    /* ============================================================================
    |Update specific columns of an existing checkup process schedule record.
    ==============================================================================*/
    public function updateColumns(int $id, array $data): bool;

    /* ================================================
     |Delete existing checkup process schedule record by its id.
     ==================================================*/
    public function delete(int $id): bool;
}
