<?php

namespace App\Services\Web;

use App\Repositories\Web\Interfaces\ServiceCategoryRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class ServiceCategoryService
{
    /**
     * Create a new class instance.
     */
    public function __construct(
        protected ServiceCategoryRepositoryInterface $serviceCategoryRepo
    ) {}


    /* ============================================================================
    |  Fetch Service Category Collection with optional filters and selected columns.
    ==============================================================================*/
    public function getServiceCategoriesCollection(?array $filterData = null, ?array $selectedcolumns = null): ?Collection
    {
        return $this->serviceCategoryRepo->getServiceCategoriesCollection($filterData, $selectedcolumns);
    }
}
