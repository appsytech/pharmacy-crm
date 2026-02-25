<?php

namespace App\Repositories\Admin;

use App\Models\LogMoney;
use App\Repositories\Admin\Interfaces\LogMoneyRepositoryInterface;
use Illuminate\Pagination\LengthAwarePaginator;

class LogMoneyRepository implements logMoneyRepositoryInterface
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    /*============================================================================
    | Create a new log money record in the database and returns the created record.
    ==============================================================================*/
    public function create(array $data): ?LogMoney
    {
        return LogMoney::create($data);
    }

    /* ============================================================================
    |  Fetch log money records with optional filters and selected columns.
    ==============================================================================*/
    public function getMoneyLogs(?array $filterData = null, ?array $selectedcolumns = null): ?LengthAwarePaginator
    {
        return LogMoney::when(
            isset($filterData['paymentMethod']),
            function ($query) use ($filterData) {
                $query->where('payment_method', $filterData['paymentMethod']);
            }
        )
            ->when(
                isset($filterData['type']),
                function ($query) use ($filterData) {
                    $query->where('type', $filterData['type']);
                }
            )
            ->when(
                isset($selectedcolumns) && count($selectedcolumns) >= 1,
                function ($query) use ($selectedcolumns) {
                    return $query->select($selectedcolumns);
                }
            )
            ->orderBy('created_at', 'desc')
            ->paginate($filterData['paginateLimit'] ?? 10);
    }
}
