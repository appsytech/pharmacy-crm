<?php

namespace App\Services\Web;

use App\Models\Gallery;
use App\Repositories\Web\Interfaces\GalleryRepositoryInterface;
use Illuminate\Pagination\LengthAwarePaginator;

class GalleryService
{
    /**
     * Create a new class instance.
     */
    public function __construct(
        protected GalleryRepositoryInterface $galleryRepo
    ) {}




    /* ============================================================================
    |   Fetch a single gallery image record by its primary ID.
    ==============================================================================*/
    public function find(string $encryptedId, ?array $selectedColumns = null): ?Gallery
    {
        $id =  (int) decrypt($encryptedId);
        return $this->galleryRepo->find($id, $selectedColumns);
    }


    /* ============================================================================
    |  Fetch gallery images with optional filters and selected columns.
    ==============================================================================*/
    public function getGallerys(?array $filterData = null, ?array $selectedcolumns = null): ?LengthAwarePaginator
    {
        return $this->galleryRepo->getGallerys($filterData, $selectedcolumns);
    }
}
