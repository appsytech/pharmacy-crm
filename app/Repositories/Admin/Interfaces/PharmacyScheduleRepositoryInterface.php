<?php

namespace App\Repositories\Admin\Interfaces;

use App\Models\PharmacySchedule;
use Illuminate\Pagination\LengthAwarePaginator;

interface PharmacyScheduleRepositoryInterface
{
    /* ============================================================================
    | Create a new pharmacy schedule record in the database and returns the created record.
    ==============================================================================*/
    public function create(array $data): ?PharmacySchedule;

    /* ============================================================================
    |   Fetch a single pharmacy schedule record by its primary ID.
    ==============================================================================*/
    public function find(int $id, ?array $selectedColumns = null): ?PharmacySchedule;

  
    /* ============================================================================
    |  Fetch pharmacy schedule with optional filters and selected columns.
    ==============================================================================*/
    public function getPharmacySchedules(?array $filterData = null, ?array $selectedcolumns = null): ?LengthAwarePaginator;

    /* ============================================================================
    |Update specific columns of an existing pharmacy schedule record.
    ==============================================================================*/
    public function updateColumns(int $id, array $data): bool;

    /* ================================================
     |Delete existing pharmacy schedule record by its id.
     ==================================================*/
    public function delete(int $id): bool;
}
