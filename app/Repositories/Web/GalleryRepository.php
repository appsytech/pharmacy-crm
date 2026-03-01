<?php

namespace App\Repositories\Web;

use App\Models\Gallery;
use App\Repositories\Web\Interfaces\GalleryRepositoryInterface;
use Illuminate\Pagination\LengthAwarePaginator;

class GalleryRepository implements GalleryRepositoryInterface
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }


    /* ============================================================================
    |   Fetch a single gallery image record by its primary ID.
    ==============================================================================*/
    public function find(int $id, ?array $selectedColumns = null): ?Gallery
    {
        return Gallery::where('id', $id)
            ->when(
                isset($selectedColumns) && count($selectedColumns) >= 1,
                function ($query) use ($selectedColumns) {
                    return $query->select($selectedColumns);
                }
            )
            ->first();
    }

    /* ============================================================================
    |  Fetch gallery images with optional filters and selected columns.
    ==============================================================================*/
    public function getGallerys(?array $filterData = null, ?array $selectedcolumns = null): ?LengthAwarePaginator
    {
        return Gallery::when(
            isset($filterData['title']),
            function ($query) use ($filterData) {
                $query->where('title', 'LIKE', '%' . $filterData['title'] . '%');
            }
        )
            ->when(
                isset($selectedcolumns) && count($selectedcolumns) >= 1,
                function ($query) use ($selectedcolumns) {
                    return $query->select($selectedcolumns);
                }
            )
            ->where('status', 'ACTIVE')
            ->orderBy('created_at', 'desc')
            ->paginate($filterData['paginateLimit'] ?? 10);
    }
}
