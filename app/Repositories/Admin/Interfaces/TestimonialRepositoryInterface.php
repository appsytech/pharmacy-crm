<?php

namespace App\Repositories\Admin\Interfaces;

use App\Models\Testimonial;
use Illuminate\Pagination\LengthAwarePaginator;

interface TestimonialRepositoryInterface
{
    /* ============================================================================
    | Create a new testimonial record in the database and returns the created record.
    ==============================================================================*/
    public function create(array $data): ?Testimonial;

    /* ============================================================================
    |   Fetch a single testimonial record by its primary ID.
    ==============================================================================*/
    public function find(int $id, ?array $selectedColumns = null): ?Testimonial;

 
    /* ============================================================================
    |  Fetch testimonial with optional filters and selected columns.
    ==============================================================================*/
    public function getTestimonials(?array $filterData = null, ?array $selectedcolumns = null): ?LengthAwarePaginator;

    /* ============================================================================
    |Update specific columns of an existing testimonial record.
    ==============================================================================*/
    public function updateColumns(int $id, array $data): bool;

    /* ================================================
     |Delete existing testimonial record by its id.
     ==================================================*/
    public function delete(int $id): bool;
}
