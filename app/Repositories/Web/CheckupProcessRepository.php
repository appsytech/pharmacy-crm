<?php

namespace App\Repositories\Web;

use App\Models\CheckupProcess;
use App\Repositories\Web\Interfaces\CheckupProcessRepositoryInterface;
use Illuminate\Pagination\LengthAwarePaginator;

class CheckupProcessRepository implements CheckupProcessRepositoryInterface
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }



    /* ============================================================================
    |  Fetch checkup process schedule with optional filters and selected columns.
    ==============================================================================*/
    public function getCheckupProcesss(?array $filterData = null, ?array $selectedcolumns = null): ?LengthAwarePaginator
    {
        return CheckupProcess::when(
            isset($selectedcolumns) && count($selectedcolumns) >= 1,
            function ($query) use ($selectedcolumns) {
                return $query->select($selectedcolumns);
            }
        )
            ->where('status', true)
            ->paginate($filterData['paginateLimit'] ?? 4);
    }
}
