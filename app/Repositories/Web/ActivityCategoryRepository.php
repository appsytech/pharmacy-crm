<?php

namespace App\Repositories\Web;

use App\Models\ActivityCategory;
use App\Repositories\Web\Interfaces\ActivityCategoryRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class ActivityCategoryRepository implements ActivityCategoryRepositoryInterface
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }


    /* ============================================================================
    |  Fetch Activity Category Collection with optional filters and selected columns.
    ==============================================================================*/
    public function getActivityCategoriesCollection(?array $filterData = null, ?array $selectedcolumns = null): ?Collection
    {
        return ActivityCategory::when(
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
