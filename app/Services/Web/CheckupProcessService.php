<?php

namespace App\Services\Web;

use App\Repositories\Web\Interfaces\CheckupProcessRepositoryInterface;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class CheckupProcessService
{
    /**
     * Create a new class instance.
     */
    public function __construct(
        protected CheckupProcessRepositoryInterface $checkupProcessRepo
    ) {
        //
    }



    /* ============================================================================
    |  Fetch checkup process with optional filters and selected columns.
    ==============================================================================*/
    public function getCheckupProcesss(?array $filterData = null, ?array $selectedcolumns = null): ?LengthAwarePaginator
    {
        return $this->checkupProcessRepo->getCheckupProcesss($filterData, $selectedcolumns);
    }


}
