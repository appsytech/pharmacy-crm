<?php

namespace App\Services\Admin;

use App\Repositories\Admin\Interfaces\LogMoneyRepositoryInterface;
use Illuminate\Pagination\LengthAwarePaginator;

class LogMoneyService
{
    /**
     * Create a new class instance.
     */
    public function __construct(
        protected LogMoneyRepositoryInterface $logMoneyRepo
    ) {}

    /* ============================================================================
    |  Fetch log money records with optional filters and selected columns.
    ==============================================================================*/
    public function getMoneyLogs(?array $filterData = null, ?array $selectedcolumns = null): ?LengthAwarePaginator
    {
        return $this->logMoneyRepo->getMoneyLogs($filterData, $selectedcolumns);
    }
}
