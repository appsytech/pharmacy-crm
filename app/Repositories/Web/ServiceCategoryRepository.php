<?php

namespace App\Repositories\Web;

use App\Models\ServiceCategory;
use App\Repositories\Web\Interfaces\ServiceCategoryRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class ServiceCategoryRepository implements ServiceCategoryRepositoryInterface
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }



    /* ============================================================================
    |  Fetch Service Category Collection with optional filters and selected columns.
    ==============================================================================*/
    public function getServiceCategoriesCollection(?array $filterData = null, ?array $selectedcolumns = null): ?Collection
    {
        return ServiceCategory::when(
            isset($selectedcolumns) && count($selectedcolumns) >= 1,
            function ($query) use ($selectedcolumns) {
                return $query->select($selectedcolumns);
            }
        )
            ->where('status', true)
            ->orderBy('sort', 'asc')
            ->get();
    }
}
