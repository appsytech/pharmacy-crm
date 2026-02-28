<?php

namespace App\Services\Web;

use App\Repositories\Web\Interfaces\HomeSliderRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class HomeSliderService
{
    /**
     * Create a new class instance.
     */
    public function __construct(
        protected HomeSliderRepositoryInterface $homeSliderRepo
    ) {
        //
    }

    /* ============================================================================
    |  Fetch  home slider with optional filters and selected columns.
    ==============================================================================*/
    public function getHomeSliders(?array $filterData = null, ?array $selectedcolumns = null): ?Collection
    {
        return $this->homeSliderRepo->getHomeSliders($filterData, $selectedcolumns);
    }
}
