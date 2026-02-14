<?php

namespace App\Repositories\Admin\Interfaces;

use App\Models\PatientReport;
use Illuminate\Pagination\LengthAwarePaginator;

interface PatientReportRepositoryInterface
{

    /* ============================================================================
    | Create a new patient report record in the database and returns the created record.
    ==============================================================================*/
    public function create(array $data): ?PatientReport;

    /* ============================================================================
    |   Fetch a single patient report record by its primary ID.
    ==============================================================================*/
    public function find(int $id, ?array $selectedColumns = null): ?PatientReport;

    /* ============================================================================
    |  Fetch patient report with optional filters and selected columns.
    ==============================================================================*/
    public function getPatientReports(?array $filterData = null, ?array $selectedcolumns = null): ?LengthAwarePaginator;


    /* ============================================================================
    |Update specific columns of an existing patient report record.
    ==============================================================================*/
    public function updateColumns(int $id, array $data): bool;

    /* ================================================
     |Delete existing patient report record by its id.
     ==================================================*/
    public function delete(int $id): bool;
}
