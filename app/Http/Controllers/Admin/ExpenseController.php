<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\Admin\ExpenseTypeService;
use App\Services\Admin\ExpenseService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\View\View;

class ExpenseController extends Controller
{
    public function __construct(
        protected ExpenseService $expenseService,
        protected ExpenseTypeService $expenseTypeService
    ) {}

    public function index(Request $request): View
    {
        $request->validate([
            'expense_type_name' => 'nullable|string|max:50',
            'status' => 'nullable|in:PENDING,APPROVED,PAID,REJECTED,CANCELLED',
        ]);

        $data = [
            'expenses' => $this->expenseService->getExpenses([
                'expenseTypeName' => $request->expense_type_name ?? null,
                'status' => $request->status,
            ]),
            'oldInputs' => $request->all(),
            'expenseTypes' => $this->expenseTypeService->getexpenseTypes([], ['id', 'name']),
        ];

        return view('admin.pages.expense.index', compact('data'));
    }

    public function store(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'expense_type_name' => 'required|string|max:50',
            'amount' => 'required|numeric|min:0',
            'payment_method' => 'required|in:CASH,BANK,ONLINE,CHEQUE',
            'description' => 'nullable|string',
            'paid_to' => 'nullable|string|max:50',
            'expense_date' => 'required|date',
            // 'status' => 'required|in:PENDING,APPROVED,PAID,REJECTED,CANCELLED',
            'image' => 'nullable|file',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'code' => 422,
                'messages' => ['Validation Error'],
                'errors' => $validator->errors()->all(),
                'data' => null,
            ], 422);
        }

        $isCreated = $this->expenseService->create($request);

        if ($isCreated) {

            return response()->json([
                'status' => true,
                'code' => 200,
                'messages' => ['Expense Created Successfully'],
                'errors' => null,
                'data' => null,
            ], 200);
        } else {

            return response()->json([
                'status' => false,
                'code' => 500,
                'messages' => ['Something went wrong'],
                'errors' => ['Something went wrong'],
                'data' => null,
            ], 500);
        }
    }

    public function edit(Request $request): View
    {
        $data = [
            'expense' => $this->expenseService->find((int) decrypt($request->id), ['id', 'status']),
        ];

        return view('admin.pages.expense.edit', compact('data'));
    }

    public function update(Request $request): RedirectResponse
    {
        $request->validate([
            'id' => 'required|integer',
            'status' => 'required|in:PENDING,APPROVED,PAID,REJECTED,CANCELLED',
            'image' => 'nullable|file',
        ]);

        $isUpdated = $this->expenseService->update($request);

        if ($isUpdated) {
            return redirect()->route('expense.index')->with('success', 'Expense Updated Successfully');
        } else {
            return redirect()->back()->withErrors('Something went wrong!');
        }
    }
}
