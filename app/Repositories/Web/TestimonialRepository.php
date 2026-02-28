<?php

namespace App\Repositories\Web;

use App\Models\Testimonial;
use App\Repositories\Web\Interfaces\TestimonialRepositoryInterface;
use Illuminate\Pagination\LengthAwarePaginator;

class TestimonialRepository implements TestimonialRepositoryInterface
{
    /**
     * Create a new class instance.
     */
    public function __construct() {}


    /* ============================================================================
    |  Fetch testimonial with optional filters and selected columns.
    ==============================================================================*/
    public function getTestimonials(?array $filterData = null, ?array $selectedcolumns = null): ?LengthAwarePaginator
    {
        return Testimonial::when(
            isset($filterData['name']),
            function ($query) use ($filterData) {
                $query->where('name', 'LIKE', '%' . $filterData['name'] . '%');
            }
        )
            ->when(
                isset($filterData['email']),
                function ($query) use ($filterData) {
                    $query->where('email', 'LIKE', '%' . $filterData['email'] . '%');
                }
            )
            ->when(
                isset($filterData['status']),
                function ($query) use ($filterData) {
                    $query->where('status',  $filterData['status']);
                }
            )
            ->when(
                isset($selectedcolumns) && count($selectedcolumns) >= 1,
                function ($query) use ($selectedcolumns) {
                    return $query->select($selectedcolumns);
                }
            )
            ->orderBy('sort', 'asc')
            ->paginate($filterData['paginateLimit'] ?? 20);
    }
}
