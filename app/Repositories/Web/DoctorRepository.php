<?php

namespace App\Repositories\Web;

use App\Models\Doctor;
use App\Repositories\Web\Interfaces\DoctorRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

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
                isset($filterData['status']),
                function ($query) use ($filterData) {
                    $query->where('status', $filterData['status']);
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
}
