<?php

namespace App\Repositories\Admin;

use App\Models\Doctor;
use App\Repositories\Admin\Interfaces\DoctorRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class DoctorRepository implements DoctorRepositoryInterface
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }




    /* ============================================================================
    | Create a new Doctor record in the database and returns the created record.
    ==============================================================================*/
    public function create(array $data): ?Doctor
    {
        return Doctor::create($data);
    }

    /* ============================================================================
    |   Fetch a single Doctor record by its primary ID.
    ==============================================================================*/
    public function find(int $id, ?array $selectedColumns = null): ?Doctor
    {
        return Doctor::where('id', $id)
            ->when(
                isset($selectedColumns) && count($selectedColumns) >= 1,
                function ($query) use ($selectedColumns) {
                    return $query->select($selectedColumns);
                }
            )
            ->first();
    }


    /* ============================================================================
    |  Fetch doctor with optional filters and selected columns.
    ==============================================================================*/
    public function getDoctors(?array $filterData = null, ?array $selectedcolumns = null): ?LengthAwarePaginator
    {
        return Doctor::when(
            isset($filterData['fullName']),
            function ($query) use ($filterData) {
                $query->where('full_name', 'LIKE', '%' . $filterData['fullName'] . '%');
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
            ->paginate($filterData['paginateLimit'] ?? 10);
    }


    /* ============================================================================
    |  Fetch doctor Collection with optional filters and selected columns.
    ==============================================================================*/
    public function getDoctorsCollection(?array $filterData = null, ?array $selectedcolumns = null): ?Collection
    {

        return Doctor::when(
            isset($filterData['fullName']),
            function ($query) use ($filterData) {
                $query->where('full_name', 'LIKE', '%' . $filterData['fullName'] . '%');
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
    |Update specific columns of an existing doctor record.
    ==============================================================================*/
    public function updateColumns(int $id, array $data): bool
    {
        return Doctor::where('id', $id)->update($data);
    }

    /* ================================================
     |Delete existing doctor record by its id.
     ==================================================*/
    public function delete(int $id): bool
    {
        return Doctor::where('id', $id)->delete();
    }
}
