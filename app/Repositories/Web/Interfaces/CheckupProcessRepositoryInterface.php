<?php

namespace App\Repositories\Web\Interfaces;

use App\Models\CheckupProcess;
use Illuminate\Pagination\LengthAwarePaginator;

interface CheckupProcessRepositoryInterface
{
    
    
    /* ============================================================================
    |  Fetch checkup process schedule with optional filters and selected columns.
    ==============================================================================*/
    public function getCheckupProcesss(?array $filterData = null, ?array $selectedcolumns = null): ?LengthAwarePaginator;

}
