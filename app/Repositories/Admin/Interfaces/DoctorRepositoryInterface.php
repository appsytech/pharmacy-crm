<?php

namespace App\Repositories\Admin\Interfaces;

use App\Models\Doctor;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

interface DoctorRepositoryInterface
{

    /* ============================================================================
    | Create a new doctor record in the database and returns the created record.
    ==============================================================================*/
    public function create(array $data): ?Doctor;

    /* ============================================================================
    |   Fetch a single doctor record by its primary ID.
    ==============================================================================*/
    public function find(int $id, ?array $selectedColumns = null): ?Doctor;

    /* ============================================================================
    |  Fetch doctor with optional filters and selected columns.
    ==============================================================================*/
    public function getDoctors(?array $filterData = null, ?array $selectedcolumns = null): ?LengthAwarePaginator;

    /* ============================================================================
    |  Fetch doctor Collection with optional filters and selected columns.
    ==============================================================================*/
    public function getDoctorsCollection(?array $filterData = null, ?array $selectedcolumns = null): ?Collection;

    /* ============================================================================
    |Update specific columns of an existing doctor record.
    ==============================================================================*/
    public function updateColumns(int $id, array $data): bool;

    /* ================================================
     |Delete existing doctor record by its id.
     ==================================================*/
    public function delete(int $id): bool;
}
