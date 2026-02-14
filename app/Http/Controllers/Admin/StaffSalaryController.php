<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\Admin\StaffSalaryService;
use App\Services\Admin\StaffService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class StaffSalaryController extends Controller
{
    public function __construct(
        protected StaffSalaryService $staffSalaryService,
        protected StaffService $staffService
    ) {}

    public function index(Request $request): View
    {
        $request->validate([
            'status' => 'nullable|in:PAID,PARTIALLY PAID,UNPAID',
            'staff_id' => 'nullable|integer',
            'academic_year' => 'nullable|string|regex:/^\d{4}-\d{4}$/|max:20',
            'month' => 'nullable|integer|in:1,2,3,4,5,6,7,8,9,10,11,12',
        ]);

        $data = [
            'staffSalaries' => $this->staffSalaryService->getStaffSalaries([
                'status' => $request->status ?? null,
                'staffId' => $request->staff_id,
                'academicYear' => $request->academic_year,
                'month' => $request->month,
            ]),
            'staffs' => $this->staffService->getStaffs([], ['id', 'full_name']),
            'oldInputs' => $request->all(),
        ];

        return view('admin.pages.staff-salary.index', compact('data'));
    }

    public function store(Request $request): JsonResponse
    {
        $validator = Validator::make(
            $request->all(),
            [
                'staff_id' => 'required|integer|exists:staffs,id',
                'academic_year' => [
                    'required',
                    'string',
                    'regex:/^\d{4}-\d{4}$/',
                    'max:20',
                    Rule::unique('staff_salary')->where(function ($query) use ($request) {
                        return $query->where('staff_id', $request->staff_id)
                            ->where('month', $request->month);
                    }),
                ],
                'month' => 'required|integer|in:1,2,3,4,5,6,7,8,9,10,11,12',
                'base_salary' => 'required|numeric|min:0',
                'bonuses' => 'nullable|numeric|min:0',
                'tax_percentage' => 'nullable|numeric|min:0|max:100',
                'advances' => 'nullable|numeric|min:0',
                'paid_amount' => 'nullable|numeric|min:0',
                'payment_date' => 'nullable|date',
            ],
            [
                // Custom messages for staff_id
                'staff_id.required' => 'Please select a staff.',
                'staff_id.integer' => 'Staff ID must be a valid number.',
                'staff_id.exists' => 'Selected staff does not exist.',

                // Custom messages for academic_year
                'academic_year.required' => 'Please enter the academic year.',
                'academic_year.string' => 'Academic year must be a valid string.',
                'academic_year.regex' => 'Academic year must be in the format YYYY-YYYY (e.g., 2025-2026).',
                'academic_year.max' => 'Academic year should not exceed 20 characters.',
                'academic_year.unique' => 'This academic year for the selected staff and month already exists.',

                // Custom messages for month
                'month.required' => 'Please select the month.',
                'month.integer' => 'Month must be a valid number between 1 and 12.',
                'month.min' => 'Month must be at least 1.',
                'month.max' => 'Month cannot be greater than 12.',
            ]
        );

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'code' => 422,
                'messages' => ['Validation Error'],
                'errors' => $validator->errors()->all(),
                'data' => null,
            ], 422);
        }

        $isCreated = $this->staffSalaryService->create($request);

        if ($isCreated) {

            return response()->json([
                'status' => true,
                'code' => 200,
                'messages' => ['Staff Salary Created Successfully'],
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
            'staffSalary' => $this->staffSalaryService->find((int) decrypt($request->id)),
            'staffs' => $this->staffService->getStaffs([], ['id', 'full_name']),

        ];

        return view('admin.pages.staff-salary.edit', compact('data'));
    }

    public function update(Request $request): RedirectResponse
    {
        $request->validate(
            [
                'id' => 'required|integer',
                'staff_id' => 'required|integer|exists:staffs,id',
                'academic_year' => [
                    'required',
                    'string',
                    'regex:/^\d{4}-\d{4}$/',
                    'max:20',
                    Rule::unique('staff_salary')->ignore($request->id, 'id')->where(function ($query) use ($request) {
                        return $query->where('staff_id', $request->staff_id)
                            ->where('month', $request->month);
                    }),
                ],
                'month' => 'required|integer|in:1,2,3,4,5,6,7,8,9,10,11,12',
                'base_salary' => 'required|numeric|min:0',
                'bonuses' => 'nullable|numeric|min:0',
                'tax_percentage' => 'nullable|numeric|min:0|max:100',
                'advances' => 'nullable|numeric|min:0',
                'paid_amount' => 'nullable|numeric|min:0',
                'payment_date' => 'nullable|date',
                'remaining_amount' => 'required|numeric',
            ],
            [
                // Custom messages for academic_year
                'academic_year.required' => 'Please enter the academic year.',
                'academic_year.string' => 'Academic year must be a valid string.',
                'academic_year.regex' => 'Academic year must be in the format YYYY-YYYY (e.g., 2025-2026).',
                'academic_year.max' => 'Academic year should not exceed 20 characters.',
                'academic_year.unique' => 'This academic year for the selected staff and month already exists.',

                // Custom messages for month
                'month.required' => 'Please select the month.',
                'month.integer' => 'Month must be a valid number between 1 and 12.',
                'month.min' => 'Month must be at least 1.',
                'month.max' => 'Month cannot be greater than 12.',
            ]
        );

        $isUpdated = $this->staffSalaryService->update($request);

        if ($isUpdated) {
            return redirect()->route('staff-salary.index')->with('success', 'Staff Salary Updated Successfully');
        } else {
            return redirect()->back()->withErrors('Something went wrong!');
        }
    }

    public function delete(Request $request): RedirectResponse
    {
        $request->validate([
            'id' => 'required|int',
        ]);

        $isDeleted = $this->staffSalaryService->delete($request->id);

        if ($isDeleted) {
            return redirect()->back()->with('success', 'Staff Salary Deleted Successfully');
        } else {
            return redirect()->back()->withErrors('Something went wrong!');
        }
    }

    public function getStaffAmountsById(Request $request)
    {

        $validator = Validator::make(
            $request->all(),
            [
                'staff_id' => 'required|integer|exists:staffs,id',
            ],
            [
                'staff_id.exists' => 'Wrong Staff selected.',
            ]
        );

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'code' => 422,
                'messages' => ['Validation Error'],
                'errors' => $validator->errors()->all(),
                'data' => null,
            ], 422);
        }

        $staffSalary = $this->staffSalaryService->findLatestByStaffId((int) $request->staff_id, ['id', 'remaining_amount']);
        $staff = $this->staffService->find($request->staff_id, ['salary']);


        if (!$staffSalary) {
            return response()->json([
                'status'   => false,
                'code'     => 404,
                'messages' => ['No salary record found for selected staff'],
                'errors'   => ['No salary record found for selected staff'],
                'data'     => [
                    'remaining_amount' => 0,
                    'advance_amount'   => 0,
                    'base_salary'      => $staff->salary ?? 0,
                ],
            ], 404);
        }

        $remainingAmount = (float) $staffSalary->remaining_amount;
        $advanceAmount   = $remainingAmount < 0 ? abs($remainingAmount) : 0;


        return response()->json([
            'status' => true,
            'code' => 200,
            'messages' => ['Staff Data Fetched Successfully'],
            'errors' => null,
            'data' => collect([
                'remaining_amount' => $staffSalary->remaining_amount,
                'base_salary' => $staff->salary,
                'advance_amount' => $advanceAmount
            ]),
        ], 200);
    }
}
