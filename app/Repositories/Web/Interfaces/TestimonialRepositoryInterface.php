<?php

namespace App\Repositories\Web\Interfaces;

use Illuminate\Pagination\LengthAwarePaginator;

interface TestimonialRepositoryInterface
{
     /* ============================================================================
    |  Fetch testimonial with optional filters and selected columns.
    ==============================================================================*/
    public function getTestimonials(?array $filterData = null, ?array $selectedcolumns = null): ?LengthAwarePaginator;
}
