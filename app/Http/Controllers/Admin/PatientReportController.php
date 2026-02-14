<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\Admin\DoctorService;
use App\Services\Admin\PatientReportService;
use App\Services\Admin\PatientService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\View\View;

class PatientReportController extends Controller
{
    public function __construct(
        protected PatientReportService $patientReportService,
        protected PatientService $patientService,
        protected DoctorService $doctorService
    ) {}



    public function index(Request $request): View
    {
        $request->validate([
            'report_type' => 'nullable|string|max:100',
            'report_status'  => 'nullable|in:PENDING,COMPLETED,REVIEWED',
        ]);

        $data = [
            'reports' => $this->patientReportService->getPatientReports([
                'reportType' => $request->report_type ?? null,
                'reportStatus' => $request->report_status ?? null,
            ]),
            'patients' => $this->patientService->getPatientCollections([], ['id', 'first_name', 'last_name']),
            'doctors' => $this->doctorService->getDoctorsCollection([], ['id', 'full_name']),
            'oldInputs' => $request->all(),
        ];

        return view('admin.pages.patient-report.index', compact('data'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [

            'patient_id'     => 'required|integer|exists:patients,id',
            'doctor_id'      => 'required|integer|exists:doctors,id',
            'report_type'    => 'required|string|max:100',
            'diagnosis'      => 'nullable|string',
            'symptoms'       => 'nullable|string',
            'report_date'    => 'required|date',
            'report_status'  => 'required|in:PENDING,COMPLETED,REVIEWED',
            'notes'          => 'nullable|string',
            'pdf_file'  => 'nullable|file',

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

        $response = $this->patientReportService->create($request);

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
            'report' => $this->patientReportService->find((int) decrypt($request->id)),
            'patients' => $this->patientService->getPatientCollections([], ['id', 'first_name', 'last_name']),
            'doctors' => $this->doctorService->getDoctorsCollection([], ['id', 'full_name']),
        ];

        return view('admin.pages.patient-report.edit', compact('data'));
    }

    public function update(Request $request): RedirectResponse
    {
        $request->validate([
            'id'             => 'required|integer',
            'patient_id'     => 'required|integer|exists:patients,id',
            'doctor_id'      => 'required|integer|exists:doctors,id',
            'report_type'    => 'required|string|max:100',
            'diagnosis'      => 'nullable|string',
            'symptoms'       => 'nullable|string',
            'report_date'    => 'required|date',
            'report_status'  => 'required|in:PENDING,COMPLETED,REVIEWED',
            'notes'          => 'nullable|string',
            'pdf_file'        => 'nullable|file',
        ]);

        $response = $this->patientReportService->update($request);

        if ($response['status']) {
            return redirect()->route('patient-report.index')->with('success', 'Patient  Report Updated Successfully');
        } else {
            return redirect()->back()->withErrors($response['message']);
        }
    }

    public function delete(Request $request): RedirectResponse
    {
        $request->validate([
            'id' => 'required|int',
        ]);

        $isDeleted = $this->patientReportService->delete($request->id);

        if ($isDeleted) {
            return redirect()->back()->with('success', 'Patient Report Deleted Successfully');
        } else {
            return redirect()->back()->withErrors('Something went wrong!');
        }
    }
}
