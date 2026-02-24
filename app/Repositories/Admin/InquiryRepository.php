<?php

namespace App\Repositories\Admin;

use App\Models\Inquiry;
use App\Repositories\Admin\Interfaces\InquiryRepositoryInterface;
use Illuminate\Pagination\LengthAwarePaginator;

class InquiryRepository implements InquiryRepositoryInterface
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    /* ============================================================================
    |Fetch inquiry with optional filters and selected columns.
    ==============================================================================*/
    public function getInquiries(?array $filterData = null, ?array $selectedcolumns = null): ?LengthAwarePaginator
    {
    
        return Inquiry::when(
            isset($filterData['email']),

            function ($query) use ($filterData) {
                $query->where('email', 'LIKE', '%' . $filterData['email'] . '%');
            }
        )
            ->when(
                isset($selectedcolumns) && count($selectedcolumns) >= 1,
                function ($query) use ($selectedcolumns) {
                    return $query->select($selectedcolumns);
                }
            )
            ->paginate($filterData['paginateLimit'] ?? 10);
    }

    /* ================================================
    |Delete existing inquiry record by its id.
    ==================================================*/
    public function delete(int $id): bool
    {
       
        return Inquiry::where('id', $id)->delete();
    }
}
