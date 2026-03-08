<?php

namespace App\Repositories\Web\Interfaces;

use Illuminate\Database\Eloquent\Collection;

interface ServiceCategoryRepositoryInterface
{
    /* ============================================================================
    |  Fetch Service Category Collection with optional filters and selected columns.
    ==============================================================================*/
    public function getServiceCategoriesCollection(?array $filterData = null, ?array $selectedcolumns = null): ?Collection;
}
