<?php

namespace App\Repositories\Admin\Interfaces;

use App\Models\StaffSalary;
use Illuminate\Pagination\LengthAwarePaginator;

interface StaffSalaryRepositoryInterface
{
    /* ============================================================================
    | Create a new staff salary record in the database and returns the created record.
    ==============================================================================*/
    public function create(array $data): ?StaffSalary;

    /* ============================================================================
    |   Fetch a single staff salary  record by its primary ID.
    ==============================================================================*/
    public function find(int $id, ?array $selectedColumns = null): ?StaffSalary;

    /* ============================================================================
    |   Fetch a latest staff payment record by staff ID.
    ==============================================================================*/
    public function findLatestByStaffId(int $staffId, ?array $selectedColumns = null): ?StaffSalary;

    /* ============================================================================
    |  Fetch staff salaries with optional filters and selected columns.
    ==============================================================================*/
    public function getStaffSalaries(?array $filterData = null, ?array $selectedcolumns = null): ?LengthAwarePaginator;

    /* ============================================================================
    |Update specific columns of an existing staff salary record.
    ==============================================================================*/
    public function updateColumns(int $id, array $data): bool;

    /* ================================================
     |Delete existing staff salary record by its id.
     ==================================================*/
    public function delete(int $id): bool;
}
