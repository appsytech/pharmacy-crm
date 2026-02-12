<?php

namespace App\Repositories\Admin\Interfaces;

use App\Models\Patient;
use Illuminate\Pagination\LengthAwarePaginator;

interface PatientRepositoryInterface
{

    /* ============================================================================
    | Create a new patient record in the database and returns the created record.
    ==============================================================================*/
    public function create(array $data): ?Patient;

    /* ============================================================================
    |   Fetch a single patient record by its primary ID.
    ==============================================================================*/
    public function find(int $id, ?array $selectedColumns = null): ?Patient;

    /* ============================================================================
    |  Fetch patient with optional filters and selected columns.
    ==============================================================================*/
    public function getPatients(?array $filterData = null, ?array $selectedcolumns = null): ?LengthAwarePaginator;

    /* ============================================================================
    |Update specific columns of an existing patient record.
    ==============================================================================*/
    public function updateColumns(int $id, array $data): bool;

    /* ================================================
     |Delete existing patient record by its id.
     ==================================================*/
    public function delete(int $id): bool;
}
