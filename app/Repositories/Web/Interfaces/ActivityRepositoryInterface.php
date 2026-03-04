<?php

namespace App\Repositories\Web\Interfaces;

use App\Models\Activity;
use Illuminate\Pagination\LengthAwarePaginator;

interface ActivityRepositoryInterface
{

    /* ============================================================================
     |   Fetch a single Activity record by its primary ID.
    ==============================================================================*/
    public function find(int $id, ?array $selectedColumns = null): ?Activity;

    /* ============================================================================
     |Retrieve activities list with optional filters and column selection.
     ==============================================================================*/
    public function getActivities(?array $filterData = null, ?array $selectedColumns = null): ?LengthAwarePaginator;
}
