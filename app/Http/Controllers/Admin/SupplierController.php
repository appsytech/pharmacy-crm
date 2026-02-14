<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\Admin\SupplierService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\View\View;

class SupplierController extends Controller
{
    public function __construct(
        protected SupplierService $supplierService
    ) {}



    public function index(Request $request): View
    {
        $request->validate([
            'supplier_name' => 'nullable|string|max:100',
            'phone' => 'nullable|string|max:100',
        ]);

        $data = [
            'suppliers' => $this->supplierService->getSuppliers([
                'supplierName' => $request->supplier_name ?? null,
                'phone' => $request->phone,
            ]),
            'oldInputs' => $request->all(),
        ];

        return view('admin.pages.supplier.index', compact('data'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'supplier_name' => 'required|string|max:150|unique:suppliers,supplier_name',
            'phone'         => 'required|string|max:20',
            'contact_person' => 'nullable|string|max:150',
            'email'         => 'nullable|email|max:150',
            'address'       => 'nullable|string|max:255',
            'city'          => 'nullable|string|max:100',
            'state'         => 'nullable|string|max:100',
            'country'       => 'nullable|string|max:100',
            'supplier_business_number' => 'nullable|string|max:50',
            'payment_terms' => 'nullable|string|max:100',
            'status'        => 'required|in:ACTIVE,INACTIVE',
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

        $response = $this->supplierService->create($request);

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
            'supplier' => $this->supplierService->find((int) decrypt($request->id)),
        ];

        return view('admin.pages.supplier.edit', compact('data'));
    }

    public function update(Request $request): RedirectResponse
    {
        $request->validate([
            'id' => 'required|integer',
            'supplier_name' => 'required|string|max:150|unique:suppliers,supplier_name,' . $request->id,
            'phone'         => 'required|string|max:20',
            'contact_person' => 'nullable|string|max:150',
            'email'         => 'nullable|email|max:150',
            'address'       => 'nullable|string|max:255',
            'city'          => 'nullable|string|max:100',
            'state'         => 'nullable|string|max:100',
            'country'       => 'nullable|string|max:100',
            'supplier_business_number' => 'nullable|string|max:50',
            'payment_terms' => 'nullable|string|max:100',
            'status'        => 'required|in:ACTIVE,INACTIVE',
        ]);

        $response = $this->supplierService->update($request);

        if ($response['status']) {
            return redirect()->route('supplier.index')->with('success', 'Supplier Updated Successfully');
        } else {
            return redirect()->back()->withErrors($response['message']);
        }
    }

    public function delete(Request $request): RedirectResponse
    {
        $request->validate([
            'id' => 'required|int',
        ]);

        $isDeleted = $this->supplierService->delete($request->id);

        if ($isDeleted) {
            return redirect()->back()->with('success', 'Supplier Deleted Successfully');
        } else {
            return redirect()->back()->withErrors('Something went wrong!');
        }
    }
}
