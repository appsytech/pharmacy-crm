<?php

namespace App\Repositories\Admin\Interfaces;

use App\Models\Manufacturer;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

interface ManufacturerRepositoryInterface
{
    /* ============================================================================
    | Create a new Manufacturer record in the database and returns the created record.
    ==============================================================================*/
    public function create(array $data): ?Manufacturer;

    /* ============================================================================
    |   Fetch a single Manufacturer record by its primary ID.
    ==============================================================================*/
    public function find(int $id, ?array $selectedColumns = null): ?Manufacturer;


    /* ============================================================================
    |  Fetch Manufacturer with optional filters and selected columns.
    ==============================================================================*/
    public function getManufacturers(?array $filterData = null, ?array $selectedcolumns = null): ?LengthAwarePaginator;

    /* ============================================================================
    |  Fetch Manufacturers collection with optional filters and selected columns.
    ==============================================================================*/
    public function getManufacturersCollection(?array $filterData = null, ?array $selectedcolumns = null): ?Collection;

    /* ============================================================================
    |Update specific columns of an existing Manufacturer record.
    ==============================================================================*/
    public function updateColumns(int $id, array $data): bool;

    /* ================================================
     |Delete existing Manufacturer record by its id.
     ==================================================*/
    public function delete(int $id): bool;
}
