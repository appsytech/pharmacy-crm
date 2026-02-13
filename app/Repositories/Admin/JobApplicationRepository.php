<?php

namespace App\Repositories\Admin;

use App\Models\JobApplication;
use App\Repositories\Admin\Interfaces\JobApplicationRepositoryInterface;
use Illuminate\Pagination\LengthAwarePaginator;

class JobApplicationRepository implements JobApplicationRepositoryInterface
{
    public function __construct() {}

    /* ============================================================================
    |   Fetch a single Job Application record by its primary ID.
    ==============================================================================*/
    public function find(int $id, ?array $selectedColumns = null): ?JobApplication
    {
        return JobApplication::where('id', $id)
            ->when(
                isset($selectedColumns) && count($selectedColumns) >= 1,
                function ($query) use ($selectedColumns) {
                    return $query->select($selectedColumns);
                }
            )
            ->first();
    }

    /* ============================================================================
    |  Fetch Job Application with optional filters and selected columns.
    ==============================================================================*/
    public function getJobApplications(?array $filterData = null, ?array $selectedcolumns = null): ?LengthAwarePaginator
    {
        return JobApplication::when(
            isset($filterData['status']),
            function ($query) use ($filterData) {
                $query->where('application_status', $filterData['status']);
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
    |Update specific columns of an existing Job Application record.
    ==============================================================================*/
    public function updateColumns(int $id, array $data): bool
    {
        return JobApplication::where('id', $id)->update($data);
    }

    /* ================================================
     |Delete existing Job Application record by its id.
     ==================================================*/
    public function delete(int $id): bool
    {
        return JobApplication::where('id', $id)->delete();
    }
}
