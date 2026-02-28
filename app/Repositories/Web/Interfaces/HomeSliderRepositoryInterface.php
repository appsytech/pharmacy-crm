<?php

namespace App\Repositories\Web\Interfaces;

use Illuminate\Database\Eloquent\Collection;

interface HomeSliderRepositoryInterface
{
    /* ============================================================================
    |  Fetch HomeSlider with optional filters and selected columns.
    ==============================================================================*/
    public function getHomeSliders(?array $filterData = null, ?array $selectedcolumns = null): ?Collection;
}
