<?php

namespace App\Services\Admin;

use App\Models\ExpenseType;
use App\Repositories\Admin\Interfaces\ExpenseTypeRepositoryInterface;
use Carbon\Carbon;
use Illuminate\Pagination\LengthAwarePaginator;

class ExpenseTypeService
{
    /**
     * Create a new class instance.
     */
    public function __construct(
        protected ExpenseTypeRepositoryInterface $expenseTypeRepo
    ) {
        //
    }

    /* ============================================================================
    | Create a new expense type record in the database and returns the created record.
    ==============================================================================*/
    public function create($request): ?ExpenseType
    {
        $data = [
            'name' => $request->name,
            'status' => $request->status,
            'created_at' => Carbon::now(),
        ];

        return $this->expenseTypeRepo->create($data);
    }

    /* ============================================================================
    |  Fetch expense type with optional filters and selected columns.
    ==============================================================================*/
    public function getExpenseTypes(?array $filterData = null, ?array $selectedcolumns = null): ?LengthAwarePaginator
    {
        return $this->expenseTypeRepo->getExpenseTypes($filterData, $selectedcolumns);
    }

    /* ============================================================================
    | Permanently delete an expense type.
    ==============================================================================*/
    public function delete(int $id): bool
    {
        return $this->expenseTypeRepo->delete($id);
    }
}
