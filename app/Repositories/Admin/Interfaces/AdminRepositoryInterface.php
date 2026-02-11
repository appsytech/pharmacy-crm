<?php

namespace App\Repositories\Admin\Interfaces;

use App\Models\Admin;
use Illuminate\Pagination\LengthAwarePaginator;

interface AdminRepositoryInterface
{
    /* ============================================================================
    | Create a new admin record in the database and returns the created record.
    ==============================================================================*/
    public function create(array $data): ?Admin;

    /* ============================================================================
    |   Fetch a single admin record by its primary ID.
    ==============================================================================*/
    public function find(int $id, ?array $selectedColumns = null): ?Admin;


    /* ============================================================================
    |   Fetch a single admin record by its credentials like email, phone etc.
    ==============================================================================*/
    public function findByCredential(string $credential, ?array $selectedColumns = null): ?Admin;

    /* ============================================================================
    |  Fetch admin with optional filters and selected columns.
    ==============================================================================*/
    public function getAdmins(?array $filterData = null, ?array $selectedcolumns = null): ?LengthAwarePaginator;

    /* ============================================================================
    |Update specific columns of an existing admin record.
    ==============================================================================*/
    public function updateColumns(int $id, array $data): bool;

    /* ================================================
     |Delete existing admin record by its id.
     ==================================================*/
    public function delete(int $id): bool;
}
