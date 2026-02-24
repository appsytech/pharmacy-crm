<?php

namespace App\Repositories\Admin\Interfaces;

use App\Models\Gallery;
use Illuminate\Pagination\LengthAwarePaginator;

interface GalleryRepositoryInterface
{
    /* ============================================================================
    | Create a new gallery record in the database and returns the created record.
    ==============================================================================*/
    public function create(array $data): ?Gallery;

    /* ============================================================================
    |   Fetch a single gallery record by its primary ID.
    ==============================================================================*/
    public function find(int $id, ?array $selectedColumns = null): ?Gallery;

    /* ============================================================================
    |  Fetch gallery  with optional filters and selected columns.
    ==============================================================================*/
    public function getGallerys(?array $filterData = null, ?array $selectedcolumns = null): ?LengthAwarePaginator;

    /* ============================================================================
    |Update specific columns of an existing agllery record.
    ==============================================================================*/
    public function updateColumns(int $id, array $data): bool;

    /* ================================================
     |Delete existing gallery record by its id.
     ==================================================*/
    public function delete(int $id): bool;
}
