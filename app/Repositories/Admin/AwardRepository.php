<?php

namespace App\Repositories\Admin;

use App\Models\Award;
use App\Repositories\Admin\Interfaces\AwardRepositoryInterface;
use Illuminate\Pagination\LengthAwarePaginator;

class AwardRepository implements AwardRepositoryInterface
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }


    /* ============================================================================
    | Create a new award record in the database and returns the created record.
    ==============================================================================*/
    public function create(array $data): ?Award
    {
        return Award::create($data);
    }

    /* ============================================================================
    |   Fetch a single award record by its primary ID.
    ==============================================================================*/
    public function find(int $id, ?array $selectedColumns = null): ?Award
    {
        return Award::where('id', $id)
            ->when(
                isset($selectedColumns) && count($selectedColumns) >= 1,
                function ($query) use ($selectedColumns) {
                    return $query->select($selectedColumns);
                }
            )
            ->first();
    }

    /* ============================================================================
    |  Fetch awards with optional filters and selected columns.
    ==============================================================================*/
    public function getAwards(?array $filterData = null, ?array $selectedcolumns = null): ?LengthAwarePaginator
    {
        return Award::when(
            isset($filterData['awardName']),
            function ($query) use ($filterData) {
                $query->where('award_name', 'LIKE', '%' . $filterData['awardName'] . '%');
            }
        )
            ->when(
                isset($selectedcolumns) && count($selectedcolumns) >= 1,
                function ($query) use ($selectedcolumns) {
                    return $query->select($selectedcolumns);
                }
            )
            ->paginate($filterData['paginate'] ?? 10);
    }

    /* ============================================================================
    |Update specific columns of an existing award record.
    ==============================================================================*/
    public function updateColumns(int $id, array $data): bool
    {
        return Award::where('id', $id)->update($data);
    }

    /* ================================================
     |Delete existing award record by its id.
     ==================================================*/
    public function delete(int $id): bool
    {
        return Award::where('id', $id)->delete();
    }
}
