<?php

namespace App\Services\Admin;

use App\Models\Patient;
use App\Repositories\Admin\Interfaces\DoctorRepositoryInterface;
use App\Repositories\Admin\Interfaces\PatientRepositoryInterface;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Auth;

class PatientService
{
    /**
     * Create a new class instance.
     */
    public function __construct(
        protected PatientRepositoryInterface $patientRepo,
        protected DoctorRepositoryInterface $doctorRepo
    ) {}



    /* =============================================================
    | Create a new patient record.
    ================================================================*/
    public function create($request): array
    {

        $doctorName =  null;

        if (!empty($request->doctor_id)) {
            $doctorName = $this->doctorRepo->find((int) $request->doctor_id, ['full_name'])?->full_name;
        }

        $data = [
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'date_of_birth' => $request->date_of_birth,
            'gender' => $request->gender,
            'blood_group' => $request->blood_group  ?? null,
            'phone' => $request->phone ?? null,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'address' => $request->address ?? null,
            'city' => $request->city ?? null,
            'state' => $request->state ?? null,
            'doctor_id' => $request->doctor_id ?? null,
            'doctor_name' => $doctorName ?? null,
            'medical_conditions' => $request->medical_conditions ?? null,
            'insurance_provider' => $request->insurance_provider ?? null,
            'insurance_policy_number' => $request->insurance_policy_number ?? null,
            'status' => $request->status ?? null,
            'treatment_status' => $request->treatment_status ?? null,
            'created_at' => Carbon::now()
        ];

        $createdPatient = $this->patientRepo->create($data);

        if ($createdPatient) {
            return [
                'status' => true,
                'message' => ['Patient Created successfully']
            ];
        }

        return [
            'status' => false,
            'message' => ['Something went wrong']
        ];
    }




    /* ============================================================================
    |   Fetch a single patient record by its primary ID.
    ==============================================================================*/
    public function find(int $id, ?array $selectedColumns = null): ?Patient
    {
        return $this->patientRepo->find($id, $selectedColumns);
    }

    /* ============================================================================
    |  Fetch patient with optional filters and selected columns.
    ==============================================================================*/
    public function getPatients(?array $filterData = null, ?array $selectedcolumns = null): ?LengthAwarePaginator
    {
        return $this->patientRepo->getPatients($filterData, $selectedcolumns);
    }


    /* ============================================================================
    |  Fetch patient collections with optional filters and selected columns.
    ==============================================================================*/
    public function getPatientCollections(?array $filterData = null, ?array $selectedcolumns = null): ?Collection
    {
        return $this->patientRepo->getPatientCollections($filterData, $selectedcolumns);
    }


    /* ============================================================================
    | Update an existing patient record .
    ==============================================================================*/
    public function update($request): array
    {
        $patientId = $request->id;

        $doctorName =  null;

        if (!empty($request->doctor_id)) {
            $doctorName = $this->doctorRepo->find((int) $request->doctor_id, ['full_name'])?->full_name;
        }

        $data = [
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'date_of_birth' => $request->date_of_birth,
            'gender' => $request->gender,
            'blood_group' => $request->blood_group  ?? null,
            'phone' => $request->phone ?? null,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'address' => $request->address ?? null,
            'city' => $request->city ?? null,
            'state' => $request->state ?? null,
            'doctor_id' => $request->doctor_id ?? null,
            'doctor_name' => $doctorName ?? null,
            'medical_conditions' => $request->medical_conditions ?? null,
            'insurance_provider' => $request->insurance_provider ?? null,
            'insurance_policy_number' => $request->insurance_policy_number ?? null,
            'status' => $request->status ?? null,
            'treatment_status' => $request->treatment_status ?? null,
            'updated_at' => Carbon::now(),
        ];


        if (! empty($request->password)) {
            $data['password'] = bcrypt($request->password); // Hash it before saving
        }

        $isUpdated =  $this->patientRepo->updateColumns($patientId, $data);

        if ($isUpdated) {
            return [
                'status' => true,
                'message' => ['Patient Updated successfully']
            ];
        }

        return [
            'status' => false,
            'message' => ['Something went wrong']
        ];
    }



    /* ============================================================================
    | Permanently delete an patient.
    ==============================================================================*/
    public function delete(int $id): bool
    {
        return $this->patientRepo->delete($id);
    }


    public function getIndexPageData($request): array
    {
        $patients = null;
        $doctors = null;

        if (Auth::guard('web')->check() || Auth::guard('staffs')->check()) {

            $patients =  $this->patientRepo->getPatients([
                'firstName' => $request->first_name ?? null,
                'email' => $request->email ?? null,
            ]);

            $doctors = $this->doctorRepo->getDoctorsCollection([], ['id', 'full_name']);
        } elseif (Auth::guard('doctors')->check()) {

            $patients =  $this->patientRepo->getPatients([
                'firstName' => $request->first_name ?? null,
                'email' => $request->email ?? null,
                'doctorId' => Auth::user()->id
            ]);
        }

        $data =  [
            'patients' => $patients,
            'doctors' => $doctors,
            'oldInputs' => $request->all(),
        ];

        return $data;
    }
}
