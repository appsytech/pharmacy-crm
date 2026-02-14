<?php

namespace App\Repositories\Admin;

use App\Models\Expense;
use App\Repositories\Admin\Interfaces\ExpenseRepositoryInterface;
use Illuminate\Pagination\LengthAwarePaginator;

class ExpenseRepository implements ExpenseRepositoryInterface
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    /* ============================================================================
    | Create a new  expense record in the database and returns the created record.
    ==============================================================================*/
    public function create(array $data): ?Expense
    {
        return Expense::create($data);
    }

    /* ============================================================================
    |   Fetch a single  expense record by its primary ID.
    ==============================================================================*/
    public function find(int $id, ?array $selectedColumns = null): ?Expense
    {
        return Expense::where('id', $id)
            ->when(
                isset($selectedColumns) && count($selectedColumns) >= 1,
                function ($query) use ($selectedColumns) {
                    return $query->select($selectedColumns);
                }
            )
            ->first();
    }

    /* ============================================================================
    |  Fetch  expense with optional filters and selected columns.
    ==============================================================================*/
    public function getExpenses(?array $filterData = null, ?array $selectedcolumns = null): ?LengthAwarePaginator
    {
        return Expense::when(
            isset($filterData['expenseTypeName']),
            function ($query) use ($filterData) {
                $query->where('expense_type_name', 'LIKE', '%' . $filterData['expenseTypeName'] . '%');
            }
        )
            ->when(
                isset($filterData['status']),
                function ($query) use ($filterData) {
                    $query->where('status', $filterData['status']);
                }
            )
            ->when(
                isset($selectedcolumns) && count($selectedcolumns) >= 1,
                function ($query) use ($selectedcolumns) {
                    return $query->select($selectedcolumns);
                }
            )
            ->orderBy('created_at', 'desc')
            ->paginate($filterData['paginateLimit'] ?? 10);
    }

    /* ============================================================================
    |Update specific columns of an existing  expense record.
    ==============================================================================*/
    public function updateColumns(int $id, array $data): bool
    {
        return Expense::where('id', $id)->update($data);
    }
}
