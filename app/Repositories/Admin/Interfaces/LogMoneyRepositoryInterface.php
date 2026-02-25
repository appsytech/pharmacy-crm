<?php

namespace App\Repositories\Admin\Interfaces;

use App\Models\LogMoney;
use Illuminate\Pagination\LengthAwarePaginator;

interface LogMoneyRepositoryInterface
{
    /*============================================================================
    | Create a new log money record in the database and returns the created record.
    ==============================================================================*/
    public function create(array $data): ?LogMoney;

    /* ============================================================================
    |  Fetch log money records with optional filters and selected columns.
    ==============================================================================*/
    public function getMoneyLogs(?array $filterData = null, ?array $selectedcolumns = null): ?LengthAwarePaginator;
}
