<?php

namespace App\Services\Web;

use App\Models\Activity;
use App\Repositories\Web\Interfaces\ActivityRepositoryInterface;
use Illuminate\Pagination\LengthAwarePaginator;

class ActivityService
{
    /**
     * Create a new class instance.
     */
    public function __construct(
        protected ActivityRepositoryInterface $activityRepo
    ) {}

    /* ============================================================================
     |   Fetch a single Activity record by its primary ID.
     ==============================================================================*/
    public function find(string $encryptedId, ?array $selectedColumns = null): ?Activity
    {
        $id =  (int) decrypt($encryptedId);
        return $this->activityRepo->find($id, $selectedColumns);
    }

    /* ============================================================================
     |Retrieve activities list with optional filters and column selection.
     ==============================================================================*/
    public function getActivities(?array $filterData = null, ?array $selectedColumns = null): ?LengthAwarePaginator
    {
        return $this->activityRepo->getActivities($filterData, $selectedColumns);
    }
}
