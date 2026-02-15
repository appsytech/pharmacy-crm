<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\Admin\PharmacyBranchService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\View\View;

class PharmacyBranchController extends Controller
{
    public function __construct(
        protected PharmacyBranchService $pharmacyBranchService
    ) {}



    public function index(Request $request): View
    {
        $request->validate([
            'name'        => 'nullable|string|max:150',
            'status'      => 'nullable|in:ACTIVE,INACTIVE',
        ]);

        $data = [
            'branches' => $this->pharmacyBranchService->getPharmacyBranches([
                'name' => $request->name ?? null,
                'status' => $request->status,
            ]),
            'oldInputs' => $request->all(),
        ];

        return view('admin.pages.pharmacy-branch.index', compact('data'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'code'        => 'required|string|max:10|unique:pharmacy_branches,code',
            'name'        => 'required|string|max:150',
            'address'     => 'nullable|string',
            'phone'       => 'nullable|string|max:20',
            'email'       => 'nullable|email|max:150',
            'manager_id'  => 'nullable|integer|min:1',
            'status'      => 'required|in:ACTIVE,INACTIVE',
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

        $response = $this->pharmacyBranchService->create($request);

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
            'branch' => $this->pharmacyBranchService->find((int) decrypt($request->id)),
        ];

        return view('admin.pages.pharmacy-branch.edit', compact('data'));
    }

    public function update(Request $request): RedirectResponse
    {
        $request->validate([
            'id' => 'required|integer',
            'code'        => 'required|string|max:10|unique:pharmacy_branches,code,' . $request->id,
            'name'        => 'required|string|max:150',
            'address'     => 'nullable|string',
            'phone'       => 'nullable|string|max:20',
            'email'       => 'nullable|email|max:150',
            'manager_id'  => 'nullable|integer|min:1',
            'status'      => 'required|in:ACTIVE,INACTIVE',
        ]);

        $response = $this->pharmacyBranchService->update($request);

        if ($response['status']) {
            return redirect()->route('pharmacy-branch.index')->with('success', 'Pharmacy Branch Updated Successfully');
        } else {
            return redirect()->back()->withErrors($response['message']);
        }
    }

    public function delete(Request $request): RedirectResponse
    {
        $request->validate([
            'id' => 'required|int',
        ]);

        $isDeleted = $this->pharmacyBranchService->delete($request->id);

        if ($isDeleted) {
            return redirect()->back()->with('success', 'Pharmacy Branch Deleted Successfully');
        } else {
            return redirect()->back()->withErrors('Something went wrong!');
        }
    }
}
