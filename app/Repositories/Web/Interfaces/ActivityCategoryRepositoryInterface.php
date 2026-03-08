<?php

namespace App\Repositories\Web\Interfaces;

use Illuminate\Database\Eloquent\Collection;

interface ActivityCategoryRepositoryInterface
{
    /* ============================================================================
    |  Fetch Activity Category Collection with optional filters and selected columns.
    ==============================================================================*/
    public function getActivityCategoriesCollection(?array $filterData = null, ?array $selectedcolumns = null): ?Collection;
}
