<?php

namespace App\Repositories\Web;

use App\Models\Faq;
use App\Repositories\Web\Interfaces\FaqRepositoryInterface;
use Illuminate\Pagination\LengthAwarePaginator;

class FaqRepository implements FaqRepositoryInterface
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }


    /* ============================================================================
    |  Fetch faq with optional filters and selected columns.
    ==============================================================================*/
    public function getFaqs(?array $filterData = null, ?array $selectedcolumns = null): ?LengthAwarePaginator
    {
        return Faq::when(
            isset($selectedcolumns) && count($selectedcolumns) >= 1,
            function ($query) use ($selectedcolumns) {
                return $query->select($selectedcolumns);
            }
        )
            ->where('is_active', true)
            ->orderBy('sort', 'asc')
            ->paginate($filterData['paginateLimit'] ?? 5);
    }
}
