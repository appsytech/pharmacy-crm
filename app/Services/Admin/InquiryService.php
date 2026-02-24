<?php

namespace App\Services\Admin;

use App\Repositories\Admin\Interfaces\InquiryRepositoryInterface;
use Illuminate\Pagination\LengthAwarePaginator;

class InquiryService
{
    /**
     * Create a new class instance.
     */
    public function __construct(
        protected InquiryRepositoryInterface $inquiryRepo
    ) {
        //
    }

    /* ============================================================================
    |Fetch inquiry with optional filters and selected columns.
    ==============================================================================*/
    public function getInquiries(?array $filterData = null, ?array $selectedcolumns = null): ?LengthAwarePaginator
    {

        return $this->inquiryRepo->getInquiries($filterData, $selectedcolumns);
    }

    /* ============================================================================
    | Permanently delete an inquiry record.
    ==============================================================================*/
    public function delete(int $id): bool
    {
        return $this->inquiryRepo->delete($id);
    }
}
