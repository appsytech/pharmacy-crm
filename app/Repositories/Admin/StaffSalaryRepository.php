<?php

namespace App\Repositories\Admin;

use App\Models\StaffSalary;
use App\Repositories\Admin\Interfaces\StaffSalaryRepositoryInterface;
use Illuminate\Pagination\LengthAwarePaginator;

class StaffSalaryRepository implements StaffSalaryRepositoryInterface
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    /* ============================================================================
    | Create a new staff salary record in the database and returns the created record.
    ==============================================================================*/
    public function create(array $data): ?StaffSalary
    {
        return StaffSalary::create($data);
    }

    /* ============================================================================
    |   Fetch a single staff salary  record by its primary ID.
    ==============================================================================*/
    public function find(int $id, ?array $selectedColumns = null): ?StaffSalary
    {
        return StaffSalary::where('id', $id)
            ->when(
                isset($selectedColumns) && count($selectedColumns) >= 1,
                function ($query) use ($selectedColumns) {
                    return $query->select($selectedColumns);
                }
            )
            ->first();
    }

    /* ============================================================================
    |   Fetch a latest staff payment record by staff ID.
    ==============================================================================*/
    public function findLatestByStaffId(int $staffId, ?array $selectedColumns = null): ?StaffSalary
    {
        return StaffSalary::where('staff_id', $staffId)
            ->orderByDesc('created_at')
            ->when(
                isset($selectedColumns) && count($selectedColumns) >= 1,
                function ($query) use ($selectedColumns) {
                    return $query->select($selectedColumns);
                }
            )
            ->first();
    }

    /* ============================================================================
    |  Fetch staff salaries with optional filters and selected columns.
    ==============================================================================*/
    public function getStaffSalaries(?array $filterData = null, ?array $selectedcolumns = null): ?LengthAwarePaginator
    {

        return StaffSalary::when(
            isset($filterData['status']),
            function ($query) use ($filterData) {
                $query->where('status', $filterData['status']);
            }
        )
            ->when(
                isset($filterData['staffId']),
                function ($query) use ($filterData) {
                    return $query->where('staff_id', $filterData['staffId']);
                }
            )
            ->when(
                isset($filterData['academicYear']),
                function ($query) use ($filterData) {
                    return $query->where('academic_year', $filterData['academicYear']);
                }
            )
            ->when(
                isset($filterData['month']),
                function ($query) use ($filterData) {
                    return $query->where('month', $filterData['month']);
                }
            )
            ->when(
                isset($selectedcolumns) && count($selectedcolumns) >= 1,
                function ($query) use ($selectedcolumns) {
                    return $query->select($selectedcolumns);
                }
            )
            ->orderBy('created_at', 'desc')
            ->paginate($filterData['paginateLimit'] ?? 10);
    }

    /* ============================================================================
    |Update specific columns of an existing staff salary record.
    ==============================================================================*/
    public function updateColumns(int $id, array $data): bool
    {
        return StaffSalary::where('id', $id)->update($data);
    }

    /* ================================================
     |Delete existing staff salary record by its id.
     ==================================================*/
    public function delete(int $id): bool
    {
        return StaffSalary::where('id', $id)->delete();
    }
}
