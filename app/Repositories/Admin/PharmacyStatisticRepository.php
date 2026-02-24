<?php

namespace App\Repositories\Admin;

use App\Models\PharmacyStatistic;
use App\Repositories\Admin\Interfaces\PharmacyStatisticRepositoryInterface;
use Illuminate\Pagination\LengthAwarePaginator;

class PharmacyStatisticRepository implements PharmacyStatisticRepositoryInterface
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }



    /* ============================================================================
    | Create a new pharmacy statistics record in the database and returns the created record.
    ==============================================================================*/
    public function create(array $data): ?PharmacyStatistic
    {
        return PharmacyStatistic::create($data);
    }

    /* ============================================================================
    |   Fetch a single pharmacy statistics record by its primary ID.
    ==============================================================================*/
    public function find(int $id, ?array $selectedColumns = null): ?PharmacyStatistic
    {
        return PharmacyStatistic::where('id', $id)
            ->when(
                isset($selectedColumns) && count($selectedColumns) >= 1,
                function ($query) use ($selectedColumns) {
                    return $query->select($selectedColumns);
                }
            )
            ->first();
    }

    /* ============================================================================
    |   Fetch a single pharmacy statistics record by its Type.
    ==============================================================================*/
    public function findByType(string $type, ?array $selectedColumns = null): ?PharmacyStatistic
    {
        return PharmacyStatistic::where('type', $type)
            ->when(
                isset($selectedColumns) && count($selectedColumns) >= 1,
                function ($query) use ($selectedColumns) {
                    return $query->select($selectedColumns);
                }
            )
            ->first();
    }

    /* ============================================================================
    |  Fetch pharmacy statisticss with optional filters and selected columns.
    ==============================================================================*/
    public function getPharmacyStatistics(?array $filterData = null, ?array $selectedcolumns = null): ?LengthAwarePaginator
    {
        return PharmacyStatistic::when(
            isset($filterData['type']),
            function ($query) use ($filterData) {
                $query->where('type', 'LIKE', '%' . $filterData['type'] . '%');
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
            ->paginate($filterData['paginateLimit'] ?? 10);
    }

    /* ============================================================================
    |Update specific columns of an existing pharmacy statistics record.
    ==============================================================================*/
    public function updateColumns(int $id, array $data): bool
    {
        return PharmacyStatistic::where('id', $id)->update($data);
    }

    /* ============================================================================
    | Increment the value counter by 1 based on the given type.  types:- 1 = Teacher , 2 = Award , 3 = student
    ==============================================================================*/
    public function incrementTotalForType(string $type): bool
    {
        return PharmacyStatistic::where([
            ['type', $type],
            ['status', true],
        ])
            ->increment('value');
    }

    /* ============================================================================
    | Decrement the value counter by 1 based on the given type.  types:- 1 = Teacher , 2 = Award , 3 = student
    ==============================================================================*/
    public function decrementTotalForType(string $type): bool
    {
        return PharmacyStatistic::where([
            ['type', $type],
            ['status', true],
        ])
            ->where('value', '>', 0)
            ->decrement('value');
    }
}
