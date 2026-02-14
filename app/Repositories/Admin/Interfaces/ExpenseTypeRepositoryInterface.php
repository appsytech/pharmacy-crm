<?php

namespace App\Repositories\Admin\Interfaces;

use App\Models\ExpenseType;
use Illuminate\Pagination\LengthAwarePaginator;

interface ExpenseTypeRepositoryInterface
{
    /* ============================================================================
    | Create a new expense type record in the database and returns the created record.
    ==============================================================================*/
    public function create(array $data): ?ExpenseType;

    /* ============================================================================
    |  Fetch expense type with optional filters and selected columns.
    ==============================================================================*/
    public function getExpenseTypes(?array $filterData = null, ?array $selectedcolumns = null): ?LengthAwarePaginator;

    /* ================================================
     |Delete existing expense type record by its id.
     ==================================================*/
    public function delete(int $id): bool;
}
