<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\Admin\DoctorService;
use App\Services\Admin\PatientAppoinmentService;
use App\Services\Admin\PatientService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\View\View;

class PatientAppoinmentController extends Controller
{
    public function __construct(
        protected PatientAppoinmentService $patientAppoinmentService,
        protected PatientService $patientService,
        protected DoctorService $doctorService
    ) {}




    public function index(Request $request): View
    {
        $request->validate([
            'patient_name' => 'nullable|string|max:100',
            'phone' => 'nullable|string|max:100',
        ]);

        $data = [
            'appointments' => $this->patientAppoinmentService->getPatientAppoinments([
                'patientName' => $request->patient_name ?? null,
                'phone' => $request->phone,
            ]),
            'patients' => $this->patientService->getPatientCollections([], ['id', 'first_name', 'last_name']),
            'doctors' => $this->doctorService->getDoctorsCollection([], ['id', 'full_name']),
            'oldInputs' => $request->all(),
        ];

        return view('admin.pages.patient-appoinment.index', compact('data'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'patient_id' => 'required|integer|exists:patients,id',
            'doctor_id' => 'required|integer|exists:doctors,id',
            'appointment_date' => 'required|date',
            'appointment_mode' => 'required|string|in:ONLINE,OFFLINE,INPERSON',
            'phone' => 'nullable|string|max:20',
            'status' => 'required|string|in:APPLIED,APPROVED,IN_LINE,IN_CHECKING,CHECKED',
            'priority' => 'required|string|in:HIGH,MEDIUM,LOW',
            'notes' => 'nullable|string',
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

        $response = $this->patientAppoinmentService->create($request);

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
            'appointment' => $this->patientAppoinmentService->find((int) decrypt($request->id)),
            'patients' => $this->patientService->getPatientCollections([], ['id', 'first_name', 'last_name']),
            'doctors' => $this->doctorService->getDoctorsCollection([], ['id', 'full_name']),
        ];

        return view('admin.pages.patient-appoinment.edit', compact('data'));
    }

    public function update(Request $request): RedirectResponse
    {
        $request->validate([
            'id' => 'required|integer',
            'patient_id' => 'required|integer|exists:patients,id',
            'doctor_id' => 'required|integer|exists:doctors,id',
            'appointment_date' => 'required|date',
            'appointment_mode' => 'required|string|in:ONLINE,OFFLINE,INPERSON',
            'phone' => 'nullable|string|max:20',
            'status' => 'required|string|in:APPLIED,APPROVED,IN_LINE,IN_CHECKING,CHECKED',
            'priority' => 'required|string|in:HIGH,MEDIUM,LOW',
            'notes' => 'nullable|string',
        ]);

        $response = $this->patientAppoinmentService->update($request);

        if ($response['status']) {
            return redirect()->route('patient-appointment.index')->with('success', 'Appoinment Updated Successfully');
        } else {
            return redirect()->back()->withErrors($response['message']);
        }
    }

    public function delete(Request $request): RedirectResponse
    {
        $request->validate([
            'id' => 'required|int',
        ]);

        $isDeleted = $this->patientAppoinmentService->delete($request->id);

        if ($isDeleted) {
            return redirect()->back()->with('success', 'Appoinment Deleted Successfully');
        } else {
            return redirect()->back()->withErrors('Something went wrong!');
        }
    }
}
