<?php

namespace App\Repositories\Admin\Interfaces;

use App\Models\ServiceCategory;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

interface ServiceCategoryRepositoryInterface
{

    /* ============================================================================
    | Create a new Service Category record in the database and returns the created record.
    ==============================================================================*/
    public function create(array $data): ?ServiceCategory;

    /* ============================================================================
    |   Fetch a single Service Category record by its primary ID.
    ==============================================================================*/
    public function find(int $id, ?array $selectedColumns = null): ?ServiceCategory;

    /* ============================================================================
    |  Fetch Service Category with optional filters and selected columns.
    ==============================================================================*/
    public function getServiceCategories(?array $filterData = null, ?array $selectedcolumns = null): ?LengthAwarePaginator;

    /* ============================================================================
    |  Fetch Service Category Collection with optional filters and selected columns.
    ==============================================================================*/
    public function getServiceCategoriesCollection(?array $filterData = null, ?array $selectedcolumns = null): ?Collection;

    /* ============================================================================
    |Update specific columns of an existing Service Category record.
    ==============================================================================*/
    public function updateColumns(int $id, array $data): bool;

    /* ================================================
     |Delete existing Service Category record by its id.
     ==================================================*/
    public function delete(int $id): bool;
}
