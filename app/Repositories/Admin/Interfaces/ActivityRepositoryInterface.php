<?php

namespace App\Repositories\Admin\Interfaces;

use App\Models\Activity;
use Illuminate\Pagination\LengthAwarePaginator;

interface ActivityRepositoryInterface
{
    /* ============================================================================
          | Create a new activity record in the database and returns the created record.
     ==============================================================================*/
    public function create(array $data): ?Activity;

    /* ============================================================================
     |   Fetch a single Activity record by its primary ID.
    ==============================================================================*/
    public function find(int $id, ?array $selectedColumns = null): ?Activity;

    /* ============================================================================
     |Retrieve activities list with optional filters and column selection.
     ==============================================================================*/
    public function getActivities(?array $filterData = null, ?array $selectedColumns = null): ?LengthAwarePaginator;

    /* ============================================================================
     |Update specific columns of an existing activity record.
     ==============================================================================*/
    public function updateColumns(int $id, array $data): bool;

    /* ================================================
     |Delete existing activity record by its id.
     ==================================================*/
    public function delete(int $id): bool;
}
