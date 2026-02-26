<?php

namespace App\Repositories\Admin;

use App\Models\Testimonial;
use App\Repositories\Admin\Interfaces\TestimonialRepositoryInterface;
use Illuminate\Pagination\LengthAwarePaginator;

class TestimonialRepository implements TestimonialRepositoryInterface
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }


    /* ============================================================================
    | Create a new testimonial record in the database and returns the created record.
    ==============================================================================*/
    public function create(array $data): ?Testimonial
    {
        return Testimonial::create($data);
    }

    /* ============================================================================
    |   Fetch a single testimonial record by its primary ID.
    ==============================================================================*/
    public function find(int $id, ?array $selectedColumns = null): ?Testimonial
    {
        return Testimonial::where('id', $id)
            ->when(
                isset($selectedColumns) && count($selectedColumns) >= 1,
                function ($query) use ($selectedColumns) {
                    return $query->select($selectedColumns);
                }
            )
            ->first();
    }


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
                isset($selectedcolumns) && count($selectedcolumns) >= 1,
                function ($query) use ($selectedcolumns) {
                    return $query->select($selectedcolumns);
                }
            )
            ->orderBy('sort', 'asc')
            ->paginate($filterData['paginateLimit'] ?? 10);
    }

    /* ============================================================================
    |Update specific columns of an existing testimonial record.
    ==============================================================================*/
    public function updateColumns(int $id, array $data): bool
    {
        return Testimonial::where('id', $id)->update($data);
    }

    /* ================================================
     |Delete existing testimonial record by its id.
     ==================================================*/
    public function delete(int $id): bool
    {
        return Testimonial::where('id', $id)->delete();
    }
}
