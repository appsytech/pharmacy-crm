<?php

namespace App\Services\Admin;

use App\Models\PatientReport;
use App\Repositories\Admin\Interfaces\DoctorRepositoryInterface;
use App\Repositories\Admin\Interfaces\PatientReportRepositoryInterface;
use App\Repositories\Admin\Interfaces\PatientRepositoryInterface;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Storage;

class PatientReportService
{
    /**
     * Create a new class instance.
     */
    public function __construct(
        protected PatientReportRepositoryInterface $patientReportRepo,
        protected DoctorRepositoryInterface $doctorRepo,
        protected PatientRepositoryInterface $PatientRepo
    ) {}




    /* =============================================================
    | Create a new patient report record.
    ================================================================*/
    public function create($request): array
    {

        $doctorName =  null;
        $doctorId =  (int) $request->doctor_id;
        $patientId =  (int) $request->patient_id;

        $doctorName = $this->doctorRepo->find($doctorId, ['full_name'])?->full_name;
        $patient = $this->PatientRepo->find($patientId, ['first_name', 'last_name']);

        $patientName = implode(' ', array_filter([
            $patient->first_name ?? null,
            $patient->last_name ?? null,
        ]));


        $data = [
            'patient_id'    => $patientId,
            'patient_name'  => $patientName,
            'doctor_id'     => $doctorId,
            'doctor_name'   => $doctorName,
            'report_type'   => $request->report_type,
            'diagnosis'     => $request->diagnosis,
            'symptoms'      => $request->symptoms,
            'report_date'   => $request->report_date,
            'report_status' => $request->report_status ?? 'PENDING',
            'notes'         => $request->notes,

        ];

        if ($request->hasFile('pdf_file')) {
            $data['pdf_file_path'] = $request->file('pdf_file')->store('assets/images/patients/report', 'public');
        }

        $createdPatientReport = $this->patientReportRepo->create($data);

        if ($createdPatientReport) {
            return [
                'status' => true,
                'message' => ['Patient Report Created successfully']
            ];
        }

        return [
            'status' => false,
            'message' => ['Something went wrong']
        ];
    }




    /* ============================================================================
    |   Fetch a single patient report record by its primary ID.
    ==============================================================================*/
    public function find(int $id, ?array $selectedColumns = null): ?PatientReport
    {
        return $this->patientReportRepo->find($id, $selectedColumns);
    }

    /* ============================================================================
    |  Fetch patient reports with optional filters and selected columns.
    ==============================================================================*/
    public function getPatientReports(?array $filterData = null, ?array $selectedcolumns = null): ?LengthAwarePaginator
    {
        return $this->patientReportRepo->getPatientReports($filterData, $selectedcolumns);
    }


    /* ============================================================================
    | Update an existing patient report record .
    ==============================================================================*/
    public function update($request): array
    {
        $reportId =  (int) $request->id;
        $report = $this->find($reportId, ['id', 'pdf_file_path']);

        $doctorName =  null;
        $doctorId =  (int) $request->doctor_id;
        $patientId =  (int) $request->patient_id;

        $doctorName = $this->doctorRepo->find($doctorId, ['full_name'])?->full_name;
        $patient = $this->PatientRepo->find($patientId, ['first_name', 'last_name']);

        $patientName = implode(' ', array_filter([
            $patient->first_name ?? null,
            $patient->last_name ?? null,
        ]));


        $data = [
            'patient_id'    => $patientId,
            'patient_name'  => $patientName,
            'doctor_id'     => $doctorId,
            'doctor_name'   => $doctorName,
            'report_type'   => $request->report_type,
            'diagnosis'     => $request->diagnosis,
            'symptoms'      => $request->symptoms,
            'report_date'   => $request->report_date,
            'report_status' => $request->report_status ?? 'PENDING',
            'notes'         => $request->notes,

        ];

        if ($request->hasFile('pdf_file')) {

            if (isset($report->pdf_file_path) && Storage::disk('public')->exists($report->pdf_file_path)) {
                Storage::disk('public')->delete($report->pdf_file_path);
            }
            $data['pdf_file_path'] = $request->file('pdf_file')->store('assets/images/patients/report', 'public');
        }

        $isUpdated =  $this->patientReportRepo->updateColumns($reportId, $data);

        if ($isUpdated) {
            return [
                'status' => true,
                'message' => ['Patient Report Updated successfully']
            ];
        }

        return [
            'status' => false,
            'message' => ['Something went wrong']
        ];
    }



    /* ============================================================================
    | Permanently delete an patient report data.
    ==============================================================================*/
    public function delete(int $id): bool
    {
        $report = $this->patientReportRepo->find($id, ['pdf_file_path']);

        if (! empty($report->pdf_file_path) && Storage::disk('public')->exists($report->pdf_file_path)) {
            Storage::disk('public')->delete($report->pdf_file_path);
        }

        return $this->patientReportRepo->delete($id);
    }
}
