<?php

namespace App\Repositories\Admin\Interfaces;

use Illuminate\Pagination\LengthAwarePaginator;

interface InquiryRepositoryInterface
{
    /* ============================================================================
        |  Fetch inquiries with optional filters and selected columns.
     ==============================================================================*/
    public function getInquiries(?array $filterData = null, ?array $selectedcolumns = null): ?LengthAwarePaginator;

    /* ================================================
    |Delete existing inquiry record by its id.
    ==================================================*/
    public function delete(int $id): bool;
}
