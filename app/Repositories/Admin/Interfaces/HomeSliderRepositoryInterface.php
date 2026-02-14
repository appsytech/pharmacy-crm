<?php

namespace App\Repositories\Admin\Interfaces;

use App\Models\HomeSlider;
use Illuminate\Pagination\LengthAwarePaginator;

interface HomeSliderRepositoryInterface
{
    /* ============================================================================
    | Create a new HomeSlider record in the database and returns the created record.
    ==============================================================================*/
    public function create(array $data): ?HomeSlider;

    /* ============================================================================
    |   Fetch a single HomeSlider record by its primary ID.
    ==============================================================================*/
    public function find(int $id, ?array $selectedColumns = null): ?HomeSlider;

    /* ============================================================================
    |  Fetch HomeSlider with optional filters and selected columns.
    ==============================================================================*/
    public function getHomeSliders(?array $filterData = null, ?array $selectedcolumns = null): ?LengthAwarePaginator;

    /* ============================================================================
    |Update specific columns of an existing HomeSlider record.
    ==============================================================================*/
    public function updateColumns(int $id, array $data): bool;

    /* ================================================
     |Delete existing HomeSlider record by its id.
     ==================================================*/
    public function delete(int $id): bool;
}
