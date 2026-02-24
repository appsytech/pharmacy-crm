<?php

namespace App\Repositories\Admin\Interfaces;

use App\Models\Award;
use Illuminate\Pagination\LengthAwarePaginator;

interface AwardRepositoryInterface
{
    /* ============================================================================
    | Create a new award record in the database and returns the created record.
    ==============================================================================*/
    public function create(array $data): ?Award;

    /* ============================================================================
    |   Fetch a single award record by its primary ID.
    ==============================================================================*/
    public function find(int $id, ?array $selectedColumns = null): ?Award;

    /* ============================================================================
    |  Fetch awards with optional filters and selected columns.
    ==============================================================================*/
    public function getAwards(?array $filterData = null, ?array $selectedcolumns = null): ?LengthAwarePaginator;

    /* ============================================================================
    |Update specific columns of an existing award record.
    ==============================================================================*/
    public function updateColumns(int $id, array $data): bool;

    /* ================================================
     |Delete existing award record by its id.
     ==================================================*/
    public function delete(int $id): bool;
}
