<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\Admin\ExpenseTypeService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\View\View;

class ExpenseTypeController extends Controller
{
    public function __construct(
        protected ExpenseTypeService $expenseTypeService
    ) {}

    public function index(Request $request): View
    {
        $request->validate([
            'name' => 'nullable|string|max:100',
            'status' => 'nullable|integer|in:0,1',
        ]);

        $data = [
            'expenseTypes' => $this->expenseTypeService->getexpenseTypes([
                'name' => $request->name ?? null,
                'status' => $request->status,
            ]),
            'oldInputs' => $request->all(),
        ];

        return view('admin.pages.expense-type.index', compact('data'));
    }

    public function store(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:100',
            'status' => 'nullable|integer|in:0,1',
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

        $isCreated = $this->expenseTypeService->create($request);

        if ($isCreated) {

            return response()->json([
                'status' => true,
                'code' => 200,
                'messages' => ['Expense Type Created Successfully'],
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

    public function delete(Request $request): RedirectResponse
    {
        $request->validate([
            'id' => 'required|int',
        ]);

        $isDeleted = $this->expenseTypeService->delete($request->id);

        if ($isDeleted) {
            return redirect()->back()->with('success', 'Expense Type Deleted Successfully');
        } else {
            return redirect()->back()->withErrors('Something went wrong!');
        }

    }
}
