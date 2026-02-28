<?php

namespace App\Repositories\Web\Interfaces;

use Illuminate\Pagination\LengthAwarePaginator;

interface FaqRepositoryInterface
{
    /* ============================================================================
    |  Fetch faq with optional filters and selected columns.
    ==============================================================================*/
    public function getFaqs(?array $filterData = null, ?array $selectedcolumns = null): ?LengthAwarePaginator;
}
