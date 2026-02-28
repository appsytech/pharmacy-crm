<?php

namespace App\Services\Web;

use App\Repositories\Web\Interfaces\TestimonialRepositoryInterface;
use Illuminate\Pagination\LengthAwarePaginator;

class TestimonialService
{
    /**
     * Create a new class instance.
     */
    public function __construct(
        protected TestimonialRepositoryInterface $testimonialRepo
    ) {}

    /* ============================================================================
    |  Fetch testimonial with optional filters and selected columns.
    ==============================================================================*/
    public function getTestimonials(?array $filterData = null, ?array $selectedcolumns = null): ?LengthAwarePaginator
    {
        return $this->testimonialRepo->getTestimonials($filterData, $selectedcolumns);
    }
}
