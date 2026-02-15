<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\Admin\DoctorService;
use App\Services\Admin\PatientService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\View\View;

class PatientController extends Controller
{
    public function __construct(
        protected PatientService  $patientService,
        protected DoctorService $doctorService
    ) {}

    public function index(Request $request): View
    {
        $request->validate([
            'first_name' => 'nullable|string|max:100',
            'email' => 'nullable|email|max:100',
        ]);

        $data = $this->patientService->getIndexPageData($request);

        return view('admin.pages.patient.index', compact('data'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'first_name' => 'required|string|max:100',
            'last_name' => 'required|string|max:100',
            'date_of_birth' => 'required|date|before:today',
            'gender' => 'required|in:MALE,FEMALE,OTHER',
            'blood_group' => 'nullable|string|max:5',
            'phone' => 'nullable|string|max:20',
            'email' => 'required|email|max:150|unique:patients,email',
            'password' => 'required|string|min:8|confirmed',
            'address' => 'nullable|string|max:255',
            'city' => 'nullable|string|max:100',
            'state' => 'nullable|string|max:100',
            'doctor_id' => 'nullable|integer|exists:doctors,id',
            'medical_conditions' => 'nullable|string',
            'insurance_provider' => 'nullable|string|max:150',
            'insurance_policy_number' => 'nullable|string|max:100',
            'status' => 'required|in:ACTIVE,INACTIVE,SUSPENDED,BLOCKED',
            'treatment_status' => 'required|in:NOT-STARTED,ONGOING,COMPLETED,DISCOUNTED',

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

        $response = $this->patientService->create($request);

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
            'patient' => $this->patientService->find((int) decrypt($request->id)),
            'doctors' => $this->doctorService->getDoctorsCollection([], ['id', 'full_name']),

        ];

        return view('admin.pages.patient.edit', compact('data'));
    }

    public function update(Request $request): RedirectResponse
    {
        $request->validate([
            'id' => 'required|integer',
            'first_name' => 'required|string|max:100',
            'last_name' => 'required|string|max:100',
            'date_of_birth' => 'required|date|before:today',
            'gender' => 'required|in:MALE,FEMALE,OTHER',
            'blood_group' => 'nullable|string|max:5',
            'phone' => 'nullable|string|max:20',
            'email' => 'required|email|max:150|unique:patients,email,' . $request->id,
            'password' => 'nullable|string|min:8|confirmed',
            'address' => 'nullable|string|max:255',
            'city' => 'nullable|string|max:100',
            'state' => 'nullable|string|max:100',
            'doctor_id' => 'nullable|integer|exists:doctors,id',
            'medical_conditions' => 'nullable|string',
            'insurance_provider' => 'nullable|string|max:150',
            'insurance_policy_number' => 'nullable|string|max:100',
            'status' => 'nullable|in:ACTIVE,INACTIVE,SUSPENDED,BLOCKED',
            'treatment_status' => 'nullable|in:NOT-STARTED,ONGOING,COMPLETED,DISCOUNTED',
        ]);

        $response = $this->patientService->update($request);

        if ($response['status']) {
            return redirect()->route('patient.index')->with('success', 'Patient Updated Successfully');
        } else {
            return redirect()->back()->withErrors($response['message']);
        }
    }

    public function delete(Request $request): RedirectResponse
    {
        $request->validate([
            'id' => 'required|int',
        ]);

        $isDeleted = $this->patientService->delete($request->id);

        if ($isDeleted) {
            return redirect()->back()->with('success', 'Patient Deleted Successfully');
        } else {
            return redirect()->back()->withErrors('Something went wrong!');
        }
    }
}
