<?php

namespace App\Repositories\Admin\Interfaces;

use App\Models\Expense;
use Illuminate\Pagination\LengthAwarePaginator;

interface ExpenseRepositoryInterface
{
    /* ============================================================================
    | Create a new  expense record in the database and returns the created record.
    ==============================================================================*/
    public function create(array $data): ?Expense;

    /* ============================================================================
    |   Fetch a single  expense record by its primary ID.
    ==============================================================================*/
    public function find(int $id, ?array $selectedColumns = null): ?Expense;

    /* ============================================================================
    |  Fetch  expense with optional filters and selected columns.
    ==============================================================================*/
    public function getExpenses(?array $filterData = null, ?array $selectedcolumns = null): ?LengthAwarePaginator;

    /* ============================================================================
    |Update specific columns of an existing  expense record.
    ==============================================================================*/
    public function updateColumns(int $id, array $data): bool;
}
