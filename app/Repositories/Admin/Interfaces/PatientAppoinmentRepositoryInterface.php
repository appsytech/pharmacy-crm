<?php

namespace App\Repositories\Admin\Interfaces;

use App\Models\PatientAppoinment;
use Illuminate\Pagination\LengthAwarePaginator;

interface PatientAppoinmentRepositoryInterface
{

    /* ============================================================================
    | Create a new patient Appoinment record in the database and returns the created record.
    ==============================================================================*/
    public function create(array $data): ?PatientAppoinment;

    /* ============================================================================
    |   Fetch a single patient Appoinment record by its primary ID.
    ==============================================================================*/
    public function find(int $id, ?array $selectedColumns = null): ?PatientAppoinment;

    /* ============================================================================
    |  Fetch patient Appoinment with optional filters and selected columns.
    ==============================================================================*/
    public function getPatientAppoinments(?array $filterData = null, ?array $selectedcolumns = null): ?LengthAwarePaginator;

    /* ============================================================================
    |Update specific columns of an existing patient Appoinment record.
    ==============================================================================*/
    public function updateColumns(int $id, array $data): bool;

    /* ================================================
     |Delete existing patient Appoinment record by its id.
     ==================================================*/
    public function delete(int $id): bool;
}
