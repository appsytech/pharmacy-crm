<?php

namespace App\Services\Admin;

use App\Models\PatientAppoinment;
use App\Repositories\Admin\Interfaces\DoctorRepositoryInterface;
use App\Repositories\Admin\Interfaces\PatientAppoinmentRepositoryInterface;
use App\Repositories\Admin\Interfaces\PatientRepositoryInterface;
use Carbon\Carbon;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Auth;

class PatientAppoinmentService
{
    /**
     * Create a new class instance.
     */
    public function __construct(
        protected PatientAppoinmentRepositoryInterface $patientAppoinmentRepo,
        protected PatientRepositoryInterface $patientRepo,
        protected DoctorRepositoryInterface $doctorRepo
    ) {}



    /* =============================================================
    | Create a new patient appoinment record.
    ================================================================*/
    public function create($request): array
    {
        $patientId = (int) $request->patient_id;
        $doctorId =  (int) $request->doctor_id;

        $patient = $this->patientRepo->find($patientId, ['first_name', 'last_name']);
        $doctorName =  $this->doctorRepo->find($doctorId, ['full_name'])?->full_name;


        $patientName = implode(' ', array_filter([
            $patient->first_name ?? null,
            $patient->last_name ?? null,
        ]));

        $data = [
            'patient_id' => $patientId,
            'patient_name' => $patientName,
            'doctor_id' => $doctorId,
            'doctor_name' => $doctorName,
            'appointment_date' => $request->appointment_date,
            'appointment_mode' => $request->appointment_mode,
            'phone' => $request->phone ?? null,
            'status' => $request->status,
            'priority' => $request->priority,
            'notes' => $request->notes,
            'created_by' => Auth::user()->name,
            'created_at' => Carbon::now(),
        ];


        $createdAppoinment = $this->patientAppoinmentRepo->create($data);

        if ($createdAppoinment) {
            return [
                'status' => true,
                'message' => ['Appoinment Created successfully']
            ];
        }


        return [
            'status' => false,
            'message' => ['Something went wrong']
        ];
    }

    /* ============================================================================
    |   Fetch a single patient appoinment record by its primary ID.
    ==============================================================================*/
    public function find(int $id, ?array $selectedColumns = null): ?PatientAppoinment
    {
        return $this->patientAppoinmentRepo->find($id, $selectedColumns);
    }

    /* ============================================================================
    |  Fetch patient appoinment with optional filters and selected columns.
    ==============================================================================*/
    public function getPatientAppoinments(?array $filterData = null, ?array $selectedcolumns = null): ?LengthAwarePaginator
    {
       
        return $this->patientAppoinmentRepo->getPatientAppoinments($filterData, $selectedcolumns);
    }

    /* ============================================================================
    | Update an existing patient appoinment record .
    ==============================================================================*/
    public function update($request): array
    {

        $patientAppoinmentId =  (int) $request->id;

        $patientId = (int) $request->patient_id;
        $doctorId =  (int) $request->doctor_id;

        $patient = $this->patientRepo->find($patientId, ['first_name', 'last_name']);
        $doctorName =  $this->doctorRepo->find($doctorId, ['full_name'])?->full_name;


        $patientName = implode(' ', array_filter([
            $patient->first_name ?? null,
            $patient->last_name ?? null,
        ]));

        $data = [
            'patient_id' => $patientId,
            'patient_name' => $patientName,
            'doctor_id' => $doctorId,
            'doctor_name' => $doctorName,
            'appointment_date' => $request->appointment_date,
            'appointment_mode' => $request->appointment_mode,
            'phone' => $request->phone ?? null,
            'status' => $request->status,
            'priority' => $request->priority,
            'notes' => $request->notes,
            'updated_by' => Auth::user()->name,
            'updated_at' => Carbon::now(),
        ];


        $isUpdated =  $this->patientAppoinmentRepo->updateColumns($patientAppoinmentId, $data);

        if ($isUpdated) {
            return [
                'status' => true,
                'message' => ['Appoinment Updated successfully']
            ];
        }

        return [
            'status' => false,
            'message' => ['Something went wrong']
        ];
    }



    /* ============================================================================
    | Permanently delete an patient appoinment.
    ==============================================================================*/
    public function delete(int $id): bool
    {
        return $this->patientAppoinmentRepo->delete($id);
    }
}
