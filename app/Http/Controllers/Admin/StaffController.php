<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\Admin\StaffService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\View\View;

class StaffController extends Controller
{
    public function __construct(
        protected StaffService $staffService
    ) {}



    public function index(Request $request): View
    {
        $request->validate([
            'full_name' => 'nullable|string|max:50',
            'email' => 'nullable|email|max:100',
        ]);

        $data = [
            'staffs' => $this->staffService->getStaffs([
                'fullName' => $request->full_name ?? null,
                'email' => $request->email ?? null,
            ]),
            'oldInputs' => $request->all(),
        ];

        return view('admin.pages.staff.index', compact('data'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'full_name'     => 'required|string|max:50',
            'email'         => 'required|email|max:50|unique:staffs,email',
            'password' => 'required|string|min:8|max:40|confirmed',
            'phone'         => 'nullable|string|max:20',
            'gender'        => 'required|in:MALE,FEMALE,OTHER',
            'role'          => 'required|string|max:100',
            'date_of_birth' => 'nullable|date|before:today',
            'join_date'     => 'required|date',
            'job_title'     => 'nullable|string|max:50',
            'department'    => 'nullable|string|max:100',
            'salary'        => 'nullable|numeric|min:0',
            'status'        => 'required|in:ACTIVE,INACTIVE,ONLEAVE',
            'address'       => 'nullable|string',
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

        $response = $this->staffService->create($request);

        $code = $response['status'] ? 200 : 500;

        return response()->json([
            'status' => $response['status'],
            'code' => $code,
            'messages' => $response['message'],
            'errors' => null,
            'data' => null,
        ], $code);
    }

    public function edit(Request $request): View
    {
        $data = [
            'staff' => $this->staffService->find((int) decrypt($request->id))
        ];

        return view('admin.pages.staff.edit', compact('data'));
    }

    public function update(Request $request): RedirectResponse
    {
        $request->validate([
            'id' => 'required|integer',
            'full_name'     => 'required|string|max:50',
            'email'         => 'required|email|max:50|unique:staffs,email,' . $request->id,
            'password' => 'nullable|string|min:8|max:40|confirmed',
            'phone'         => 'nullable|string|max:20',
            'gender'        => 'required|in:MALE,FEMALE,OTHER',
            'date_of_birth' => 'nullable|date|before:today',
            'join_date'     => 'required|date',
            'role'          => 'required|string|max:100',
            'job_title'     => 'nullable|string|max:50',
            'department'    => 'nullable|string|max:100',
            'salary'        => 'nullable|numeric|min:0',
            'status'        => 'required|in:ACTIVE,INACTIVE,ONLEAVE',
            'address'       => 'nullable|string',
        ]);

        $response = $this->staffService->update($request);

        if ($response['status']) {
            return redirect()->route('staff.index')->with('success', 'Staff Updated Successfully');
        } else {
            return redirect()->back()->withErrors($response['message']);
        }
    }

    public function delete(Request $request): RedirectResponse
    {
        $request->validate([
            'id' => 'required|int',
        ]);

        $isDeleted = $this->staffService->delete($request->id);

        if ($isDeleted) {
            return redirect()->back()->with('success', 'Staff Deleted Successfully');
        } else {
            return redirect()->back()->withErrors('Something went wrong!');
        }
    }
}
