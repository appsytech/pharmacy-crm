<?php

namespace App\Repositories\Admin;

use App\Models\Patient;
use App\Repositories\Admin\Interfaces\PatientRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class PatientRepository implements PatientRepositoryInterface
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }



    /* ============================================================================
    | Create a new patient record in the database and returns the created record.
    ==============================================================================*/
    public function create(array $data): ?Patient
    {
        return Patient::create($data);
    }

    /* ============================================================================
    |   Fetch a single patient record by its primary ID.
    ==============================================================================*/
    public function find(int $id, ?array $selectedColumns = null): ?Patient
    {
        return Patient::where('id', $id)
            ->when(
                isset($selectedColumns) && count($selectedColumns) >= 1,
                function ($query) use ($selectedColumns) {
                    return $query->select($selectedColumns);
                }
            )
            ->first();
    }

    /* ============================================================================
    |  Fetch patient with optional filters and selected columns.
    ==============================================================================*/
    public function getPatients(?array $filterData = null, ?array $selectedcolumns = null): ?LengthAwarePaginator
    {
        return Patient::when(
            isset($filterData['firstName']),
            function ($query) use ($filterData) {
                $query->where('first_name', 'LIKE', '%' . $filterData['firstName'] . '%');
            }
        )
            ->when(
                isset($filterData['email']),
                function ($query) use ($filterData) {
                    $query->where('email', 'LIKE', '%' . $filterData['email'] . '%');
                }
            )
            ->when(
                isset($filterData['doctorId']),
                function ($query) use ($filterData) {
                    return $query->where('doctor_id', $filterData['doctorId']);
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
    |  Fetch patient collections with optional filters and selected columns.
    ==============================================================================*/
    public function getPatientCollections(?array $filterData = null, ?array $selectedcolumns = null): ?Collection
    {
        return Patient::when(
            isset($filterData['firstName']),
            function ($query) use ($filterData) {
                $query->where('first_name', 'LIKE', '%' . $filterData['firstName'] . '%');
            }
        )
            ->when(
                isset($filterData['email']),
                function ($query) use ($filterData) {
                    $query->where('email', 'LIKE', '%' . $filterData['email'] . '%');
                }
            )
            ->when(
                isset($selectedcolumns) && count($selectedcolumns) >= 1,
                function ($query) use ($selectedcolumns) {
                    return $query->select($selectedcolumns);
                }
            )
            ->get();
    }


    /* ============================================================================
    |Update specific columns of an existing patient record.
    ==============================================================================*/
    public function updateColumns(int $id, array $data): bool
    {
        return Patient::where("id", $id)->update($data);
    }

    /* ================================================
     |Delete existing patient record by its id.
     ==================================================*/
    public function delete(int $id): bool
    {
        return Patient::where('id', $id)->delete();
    }
}
