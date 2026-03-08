<?php

namespace App\Repositories\Admin\Interfaces;

use App\Models\ActivityCategory;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

interface ActivityCategoryRepositoryInterface
{

    /* ============================================================================
    | Create a new Activity Category record in the database and returns the created record.
    ==============================================================================*/
    public function create(array $data): ?ActivityCategory;

    /* ============================================================================
    |   Fetch a single Activity Category record by its primary ID.
    ==============================================================================*/
    public function find(int $id, ?array $selectedColumns = null): ?ActivityCategory;

    /* ============================================================================
    |  Fetch Activity Category with optional filters and selected columns.
    ==============================================================================*/
    public function getActivityCategories(?array $filterData = null, ?array $selectedcolumns = null): ?LengthAwarePaginator;

    /* ============================================================================
    |  Fetch Activity Category Collection with optional filters and selected columns.
    ==============================================================================*/
    public function getActivityCategoriesCollection(?array $filterData = null, ?array $selectedcolumns = null): ?Collection;

    /* ============================================================================
    |Update specific columns of an existing Activity Category record.
    ==============================================================================*/
    public function updateColumns(int $id, array $data): bool;

    /* ================================================
     |Delete existing Activity Category record by its id.
     ==================================================*/
    public function delete(int $id): bool;
}
