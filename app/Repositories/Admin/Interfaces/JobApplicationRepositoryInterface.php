<?php

namespace App\Repositories\Admin\Interfaces;

use App\Models\JobApplication;
use Illuminate\Pagination\LengthAwarePaginator;

interface JobApplicationRepositoryInterface
{
    /* ============================================================================
    | Fetch a single job applications record by its primary ID.
    ==============================================================================*/
    public function find(int $id, ?array $selectedColumns = null): ?JobApplication;

    /* ============================================================================
    | Fetch job applications with optional filters and selected columns.
    ==============================================================================*/
    public function getJobApplications(?array $filterData = null, ?array $selectedcolumns = null): ?LengthAwarePaginator;

    /* ============================================================================
    |Update specific columns of an existing job applications record.
    ==============================================================================*/
    public function updateColumns(int $id, array $data): bool;

    /* ================================================
     |Delete existing job applications record by its id.
     ==================================================*/
    public function delete(int $id): bool;
}
