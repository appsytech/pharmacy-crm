<?php

namespace App\Repositories\Admin;

use App\Models\PatientReport;
use App\Repositories\Admin\Interfaces\PatientReportRepositoryInterface;
use Illuminate\Pagination\LengthAwarePaginator;

class PatientReportRepository implements PatientReportRepositoryInterface
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }


    /* ============================================================================
    | Create a new patient report record in the database and returns the created record.
    ==============================================================================*/
    public function create(array $data): ?PatientReport
    {
        return PatientReport::create($data);
    }

    /* ============================================================================
    |   Fetch a single patient report record by its primary ID.
    ==============================================================================*/
    public function find(int $id, ?array $selectedColumns = null): ?PatientReport
    {
        return PatientReport::where('id', $id)
            ->when(
                isset($selectedColumns) && count($selectedColumns) >= 1,
                function ($query) use ($selectedColumns) {
                    return $query->select($selectedColumns);
                }
            )
            ->first();
    }

    /* ============================================================================
    |  Fetch patient report with optional filters and selected columns.
    ==============================================================================*/
    public function getPatientReports(?array $filterData = null, ?array $selectedcolumns = null): ?LengthAwarePaginator
    {
        return PatientReport::when(
            isset($filterData['reportType']),
            function ($query) use ($filterData) {
                $query->where('report_type', 'LIKE', '%' . $filterData['reportType'] . '%');
            }
        )
            ->when(
                isset($filterData['reportStatus']),
                function ($query) use ($filterData) {
                    $query->where('report_status', $filterData['reportStatus']);
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
    |Update specific columns of an existing patient report record.
    ==============================================================================*/
    public function updateColumns(int $id, array $data): bool
    {
        return PatientReport::where("id", $id)->update($data);
    }

    /* ================================================
     |Delete existing patient report record by its id.
     ==================================================*/
    public function delete(int $id): bool
    {
        return PatientReport::where('id', $id)->delete();
    }
}
