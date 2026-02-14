<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\Admin\ManufacturerService;
use App\Services\Admin\MedicineService;
use App\Services\Admin\SupplierService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\View\View;

class MedicineController extends Controller
{
    public function __construct(
        protected MedicineService $medicineService,
        protected SupplierService $supplierService,
        protected ManufacturerService $manufacturerService
    ) {}


    public function index(Request $request): View
    {
        $request->validate([
            'name' => 'nullable|string|max:100',
            'category' => 'nullable|string|max:100',
        ]);

        $data = [
            'medicines' => $this->medicineService->getMedicines([
                'name' => $request->name ?? null,
                'category' => $request->category,
            ]),
            'suppliers' => $this->supplierService->getSuppliersCollection([], ['id', 'supplier_name']),
            'manufacturers' => $this->manufacturerService->getManufacturersCollection([], ['id', 'manufacturer_name']),
            'oldInputs' => $request->all(),
        ];

        return view('admin.pages.medicine.index', compact('data'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'supplier_id'       => 'required|integer|exists:suppliers,id',
            'manufacturer_id'   => 'required|integer|exists:manufacturers,id',
            'name'              => 'required|string|max:150',
            'generic_name'      => 'nullable|string|max:150',
            'brand_name'        => 'nullable|string|max:150',
            'category'          => 'nullable|string|max:100',
            'dosage_form'       => 'nullable|string|max:100',
            'strength'          => 'nullable|string|max:50',
            'batch_number'      => 'required|string|max:100',
            'manufacturing_date' => 'nullable|date',
            'expiry_date'       => 'nullable|date|after:manufacturing_date',
            'purchase_price'    => 'required|numeric|min:0',
            'selling_price'     => 'required|numeric|min:0|gte:purchase_price',
            'stock_quantity'    => 'nullable|integer|min:0',
            'alert_quantity'    => 'nullable|integer|min:0',
            'storage_type'      => 'nullable|in:ROOM-TEMPERATURE,REFRIGERATED,FROZEN,PROTECT-FROM-LIGHT,KEEP-IN-DRY-PLACE',
            'shelf_location'    => 'nullable|string|max:50',
            'rack_number'       => 'nullable|string|max:50',
            'description'       => 'nullable|string',
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

        $response = $this->medicineService->create($request);

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
            'medicine' => $this->medicineService->find((int) decrypt($request->id)),
             'suppliers' => $this->supplierService->getSuppliersCollection([], ['id', 'supplier_name']),
            'manufacturers' => $this->manufacturerService->getManufacturersCollection([], ['id', 'manufacturer_name']),
            
        ];

        return view('admin.pages.medicine.edit', compact('data'));
    }

    public function update(Request $request): RedirectResponse
    {
        $request->validate([
            'id' => 'required|integer',
            'supplier_id'       => 'required|integer|exists:suppliers,id',
            'manufacturer_id'   => 'required|integer|exists:manufacturers,id',
            'name'              => 'required|string|max:150',
            'generic_name'      => 'nullable|string|max:150',
            'brand_name'        => 'nullable|string|max:150',
            'category'          => 'nullable|string|max:100',
            'dosage_form'       => 'nullable|string|max:100',
            'strength'          => 'nullable|string|max:50',
            'batch_number'      => 'required|string|max:100',
            'manufacturing_date' => 'nullable|date',
            'expiry_date'       => 'nullable|date|after:manufacturing_date',
            'purchase_price'    => 'required|numeric|min:0',
            'selling_price'     => 'required|numeric|min:0|gte:purchase_price',
            'stock_quantity'    => 'nullable|integer|min:0',
            'alert_quantity'    => 'nullable|integer|min:0',
            'storage_type'      => 'nullable|in:ROOM-TEMPERATURE,REFRIGERATED,FROZEN,PROTECT-FROM-LIGHT,KEEP-IN-DRY-PLACE',
            'shelf_location'    => 'nullable|string|max:50',
            'rack_number'       => 'nullable|string|max:50',
            'description'       => 'nullable|string',
        ]);

        $response = $this->medicineService->update($request);

        if ($response['status']) {
            return redirect()->route('medicine.index')->with('success', 'Medicine Updated Successfully');
        } else {
            return redirect()->back()->withErrors($response['message']);
        }
    }

    public function delete(Request $request): RedirectResponse
    {
        $request->validate([
            'id' => 'required|int',
        ]);

        $isDeleted = $this->medicineService->delete($request->id);

        if ($isDeleted) {
            return redirect()->back()->with('success', 'Medicine Deleted Successfully');
        } else {
            return redirect()->back()->withErrors('Something went wrong!');
        }
    }
}
