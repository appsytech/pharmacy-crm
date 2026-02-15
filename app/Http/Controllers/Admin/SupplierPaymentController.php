<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\Admin\PharmacyBranchService;
use App\Services\Admin\SupplierPaymentServices;
use App\Services\Admin\SupplierService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\View\View;

class SupplierPaymentController extends Controller
{
    public function __construct(
        protected SupplierPaymentServices $supplierPaymentService,
        protected PharmacyBranchService $pharmacyBranchService,
        protected SupplierService $supplierService
    ) {}



    public function index(Request $request): View
    {
        $request->validate([
            'voucher_number' => 'nullable|string|max:50',
            'status'        => 'nullable|in:PENDING,COMPLETED,FAILED,CANCELLED',
        ]);

        $data = [
            'payments' => $this->supplierPaymentService->getSupplierPayments([
                'voucherNumber' => $request->voucher_number ?? null,
                'status' => $request->status,
            ]),
            'pharmacyBranches' => $this->pharmacyBranchService->getPharmacyBranchesCollection([], ['id', 'name']),
            'suppliers' => $this->supplierService->getSuppliersCollection([], ['id', 'supplier_name']),
            'oldInputs' => $request->all(),
        ];

        return view('admin.pages.supplier-payment.index', compact('data'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'voucher_number'     => 'required|string|max:50|unique:supplier_payments,voucher_number',
            'supplier_id'        => 'required|integer|exists:suppliers,id',
            'pharmacy_branch_id' => 'nullable|integer|exists:pharmacy_branches,id',
            'payment_date'       => 'required|date',
            'amount'             => 'required|numeric|min:0|max:9999999999.99',
            'payment_method'     => 'required|in:CASH,BANK_TRANSFER,CHEQUE,UPI,CARD',
            'payment_reference'  => 'nullable|string|max:100',
            'status'             => 'required|in:PENDING,COMPLETED,FAILED,CANCELLED',
            'description'        => 'nullable|string',
            'payment_due_date'   => 'nullable|date',
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

        $response = $this->supplierPaymentService->create($request);

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
            'payment' => $this->supplierPaymentService->find((int) decrypt($request->id)),
            'pharmacyBranches' => $this->pharmacyBranchService->getPharmacyBranchesCollection([], ['id', 'name']),
            'suppliers' => $this->supplierService->getSuppliersCollection([], ['id', 'supplier_name']),
        ];

        return view('admin.pages.supplier-payment.edit', compact('data'));
    }

    public function update(Request $request): RedirectResponse
    {
        $request->validate([
            'id' => 'required|integer',
            'voucher_number'     => 'required|string|max:50|unique:supplier_payments,voucher_number,' . $request->id,
            'supplier_id'        => 'required|integer|exists:suppliers,id',
            'pharmacy_branch_id' => 'nullable|integer|exists:pharmacy_branches,id',
            'payment_date'       => 'required|date',
            'amount'             => 'required|numeric|min:0|max:9999999999.99',
            'payment_method'     => 'required|in:CASH,BANK_TRANSFER,CHEQUE,UPI,CARD',
            'payment_reference'  => 'nullable|string|max:100',
            'status'             => 'required|in:PENDING,COMPLETED,FAILED,CANCELLED',
            'description'        => 'nullable|string',
            'payment_due_date'   => 'nullable|date',
        ]);

        $response = $this->supplierPaymentService->update($request);

        if ($response['status']) {
            return redirect()->route('supplier-payment.index')->with('success', 'Supplier Payment Updated Successfully');
        } else {
            return redirect()->back()->withErrors($response['message']);
        }
    }

    public function delete(Request $request): RedirectResponse
    {
        $request->validate([
            'id' => 'required|int',
        ]);

        $isDeleted = $this->supplierPaymentService->delete($request->id);

        if ($isDeleted) {
            return redirect()->back()->with('success', 'Supplier Payment Deleted Successfully');
        } else {
            return redirect()->back()->withErrors('Something went wrong!');
        }
    }
}
