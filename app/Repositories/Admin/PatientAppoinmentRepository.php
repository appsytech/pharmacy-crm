<?php

namespace App\Repositories\Admin;

use App\Models\Patient;
use App\Models\PatientAppoinment;
use App\Repositories\Admin\Interfaces\PatientAppoinmentRepositoryInterface;
use Illuminate\Pagination\LengthAwarePaginator;

class PatientAppoinmentRepository implements PatientAppoinmentRepositoryInterface
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }


    /* ============================================================================
    | Create a new patient Appoinment record in the database and returns the created record.
    ==============================================================================*/
    public function create(array $data): ?PatientAppoinment
    {
        return PatientAppoinment::create($data);
    }

    /* ============================================================================
    |   Fetch a single patient Appoinment record by its primary ID.
    ==============================================================================*/
    public function find(int $id, ?array $selectedColumns = null): ?PatientAppoinment
    {
        return PatientAppoinment::where('id', $id)
            ->when(
                isset($selectedColumns) && count($selectedColumns) >= 1,
                function ($query) use ($selectedColumns) {
                    return $query->select($selectedColumns);
                }
            )
            ->first();
    }

    /* ============================================================================
    |  Fetch patient Appoinment with optional filters and selected columns.
    ==============================================================================*/
    public function getPatientAppoinments(?array $filterData = null, ?array $selectedcolumns = null): ?LengthAwarePaginator
    {
        return PatientAppoinment::when(
            isset($filterData['patientId']),
            function ($query) use ($filterData) {
                $query->where('patient_id',  $filterData['patientId']);
            }
        )
            ->when(
                isset($filterData['status']),
                function ($query) use ($filterData) {
                    $query->where('status', $filterData['status']);
                }
            )
            ->when(
                isset($filterData['patientName']),
                function ($query) use ($filterData) {
                    $query->where('patient_name', 'LIKE', '%' . $filterData['patientName'] . '%');
                }
            )
            ->when(
                isset($filterData['doctorId']),
                function ($query) use ($filterData) {
                    return $query->where('doctor_id', $filterData['doctorId']);
                }
            )
            ->when(
                isset($filterData['phone']),
                function ($query) use ($filterData) {
                    $query->where('phone',  'LIKE', '%' . $filterData['phone'] . '%');
                }
            )
            ->when(
                isset($selectedcolumns) && count($selectedcolumns) >= 1,
                function ($query) use ($selectedcolumns) {
                    return $query->select($selectedcolumns);
                }
            )
            ->paginate($filterData['paginateLimit'] ?? 10);
    }

    /* ============================================================================
    |Update specific columns of an existing patient Appoinment record.
    ==============================================================================*/
    public function updateColumns(int $id, array $data): bool
    {
        return PatientAppoinment::where('id', $id)->update($data);
    }

    /* ================================================
     |Delete existing patient Appoinment record by its id.
     ==================================================*/
    public function delete(int $id): bool
    {
        return PatientAppoinment::where('id', $id)->delete();
    }
}
