<?php

namespace App\Services\Admin;

use App\Models\Expense;
use App\Repositories\Admin\Interfaces\ExpenseRepositoryInterface;
use App\Repositories\Admin\Interfaces\LogMoneyRepositoryInterface;
use Carbon\Carbon;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ExpenseService
{
    /**
     * Create a new class instance.
     */
    public function __construct(
        protected ExpenseRepositoryInterface $schoolExpenseRepo,
        // protected LogMoneyRepositoryInterface $logMoneyRepo
    ) {}

    /* =============================================================
    | Create a new school expense record.
    ================================================================*/
    public function create($request): ?Expense
    {

        $data = [
            'expense_type_name' => $request->expense_type_name,
            'amount' => $request->amount,
            'payment_method' => $request->payment_method,
            'description' => $request->description ?? null,
            'paid_to' => $request->paid_to ?? null,
            'expense_date' => $request->expense_date,
            'status' => 'PENDING',
            'created_by' => Auth::user()->name,
            'created_at' => Carbon::now(),
        ];

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('assets/images/expenses', 'public');
        }

        return $this->schoolExpenseRepo->create($data);
    }

    /* ============================================================================
    |   Fetch a single school expense record by its primary ID.
    ==============================================================================*/
    public function find(int $id, ?array $selectedColumns = null): ?Expense
    {
        return $this->schoolExpenseRepo->find($id, $selectedColumns);
    }

    /* ============================================================================
    |  Fetch school expense with optional filters and selected columns.
    ==============================================================================*/
    public function getExpenses(?array $filterData = null, ?array $selectedColumns = null): ?LengthAwarePaginator
    {
        return $this->schoolExpenseRepo->getExpenses($filterData, $selectedColumns);
    }

    /* ============================================================================
    | Update an existing school expense record .
    ==============================================================================*/
    public function update($request): bool
    {
        $expenseId = (int) $request->id;
        $expense = $this->schoolExpenseRepo->find($expenseId, ['id', 'image', 'amount', 'payment_method', 'paid_to', 'expense_date']);
        $status = $request->status;

        $data = [
            'status' => $status,
        ];

        if ($status == 'APPROVED') {
            $data['approved_by'] = Auth::user()->name;
            // $this->logMoneyRepo->create([
            //     'type' => 'EXPENSE',
            //     'method_type' => 'EXPENSE',
            //     'amount' => $expense->amount,
            //     'payment_method' => $expense->payment_method,
            //     'user_id' => $expenseId,
            //     'vendor_name' => $expense->paid_to,
            //     'description' => "Paid {$expense->amount} to {$expense->paid_to}",
            //     'transaction_date' => $expense->expense_date ?? Carbon::now(),
            //     'created_by' => Auth::user()->name,
            //     'created_at' => Carbon::now(),
            // ]);
        }

        if ($request->hasFile('image')) {
            if (isset($expense->image) && Storage::disk('public')->exists($expense->image)) {
                Storage::disk('public')->delete($expense->image);
            }
            $data['image'] = $request->file('image')->store('assets/images/expenses', 'public');
        }

        return $this->schoolExpenseRepo->updateColumns($expenseId, $data);
    }
}
