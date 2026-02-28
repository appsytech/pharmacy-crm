<?php

namespace App\Repositories\Web;

use App\Models\HomeSlider;
use App\Repositories\Web\Interfaces\HomeSliderRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class HomeSliderRepository implements HomeSliderRepositoryInterface
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    /* ============================================================================
    |  Fetch HomeSlider with optional filters and selected columns.
    ==============================================================================*/
    public function getHomeSliders(?array $filterData = null, ?array $selectedcolumns = null): ?Collection
    {
        return HomeSlider::when(
            isset($filterData['type']),
            function ($query) use ($filterData) {
                $query->where('type', 'LIKE', '%' . $filterData['type'] . '%');
            }
        )
            ->when(
                isset($filterData['deviceType']),
                function ($query) use ($filterData) {
                    $query->where('device_type', $filterData['deviceType']);
                }
            )

            ->when(
                isset($selectedcolumns) && count($selectedcolumns) >= 1,
                function ($query) use ($selectedcolumns) {
                    return $query->select($selectedcolumns);
                }
            )
            ->where('status', true)
            ->get();
    }
}
