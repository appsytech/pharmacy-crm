<?php

namespace App\Repositories\Web\Interfaces;

use App\Models\Gallery;
use Illuminate\Pagination\LengthAwarePaginator;

interface GalleryRepositoryInterface
{
    /* ============================================================================
    |   Fetch a single gallery image record by its primary ID.
    ==============================================================================*/
    public function find(int $id, ?array $selectedColumns = null): ?Gallery;


    /* ============================================================================
    |  Fetch gallery images with optional filters and selected columns.
    ==============================================================================*/
    public function getGallerys(?array $filterData = null, ?array $selectedcolumns = null): ?LengthAwarePaginator;
}
