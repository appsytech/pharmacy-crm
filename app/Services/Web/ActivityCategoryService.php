<?php

namespace App\Services\Web;

use App\Repositories\Web\Interfaces\ActivityCategoryRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class ActivityCategoryService
{
    /**
     * Create a new class instance.
     */
    public function __construct(
        protected ActivityCategoryRepositoryInterface $activityCategoryRepo
    ) {}


    /* ============================================================================
    |  Fetch Activity Category Collection with optional filters and selected columns.
    ==============================================================================*/
    public function getActivityCategoriesCollection(?array $filterData = null, ?array $selectedcolumns = null): ?Collection
    {
        return $this->activityCategoryRepo->getActivityCategoriesCollection($filterData, $selectedcolumns);
    }
}
