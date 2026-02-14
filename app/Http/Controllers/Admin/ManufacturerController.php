<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\Admin\ManufacturerService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\View\View;

class ManufacturerController extends Controller
{
    public function __construct(
        protected ManufacturerService $manuFacturerService
    ) {}



    public function index(Request $request): View
    {
        $request->validate([
            'manufacturer_name' => 'nullable|string|max:100',
            'phone' => 'nullable|string|max:100',
        ]);

        $data = [
            'manufacturers' => $this->manuFacturerService->getManufacturers([
                'manufacturerName' => $request->manufacturer_name ?? null,
                'phone' => $request->phone,
            ]),
            'oldInputs' => $request->all(),
        ];

        return view('admin.pages.manufacturer.index', compact('data'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'manufacturer_name' => 'required|string|max:100|unique:manufacturers,manufacturer_name',
            'contact_person'    => 'nullable|string|max:50',
            'phone'             => 'nullable|string|max:20',
            'email'             => 'nullable|email|max:50',
            'address'           => 'nullable|string|max:155',
            'city'              => 'nullable|string|max:50',
            'state'             => 'nullable|string|max:50',
            'country'           => 'nullable|string|max:30',
            'license_number'    => 'nullable|string|max:30',
            'status'            => 'required|in:ACTIVE,INACTIVE',
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

        $response = $this->manuFacturerService->create($request);

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
            'manufacturer' => $this->manuFacturerService->find((int) decrypt($request->id)),
        ];

        return view('admin.pages.manufacturer.edit', compact('data'));
    }

    public function update(Request $request): RedirectResponse
    {
        $request->validate([
            'id' => 'required|integer',
            'manufacturer_name' => 'required|string|max:100|unique:manufacturers,manufacturer_name,' . $request->id,
            'contact_person'    => 'nullable|string|max:50',
            'phone'             => 'nullable|string|max:20',
            'email'             => 'nullable|email|max:50',
            'address'           => 'nullable|string|max:155',
            'city'              => 'nullable|string|max:50',
            'state'             => 'nullable|string|max:50',
            'country'           => 'nullable|string|max:30',
            'license_number'    => 'nullable|string|max:30',
            'status'            => 'required|in:ACTIVE,INACTIVE',
        ]);

        $response = $this->manuFacturerService->update($request);

        if ($response['status']) {
            return redirect()->route('manufacturer.index')->with('success', 'Manufacturer Updated Successfully');
        } else {
            return redirect()->back()->withErrors($response['message']);
        }
    }

    public function delete(Request $request): RedirectResponse
    {
        $request->validate([
            'id' => 'required|int',
        ]);

        $isDeleted = $this->manuFacturerService->delete($request->id);

        if ($isDeleted) {
            return redirect()->back()->with('success', 'Manufacturer Deleted Successfully');
        } else {
            return redirect()->back()->withErrors('Something went wrong!');
        }
    }
}
