<?php

namespace App\Repositories\Admin\Interfaces;

use App\Models\PharmacyBranch;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

interface PharmacyBranchRepositoryInterface
{

    /* ============================================================================
    | Create a new Pharmacy Branches record in the database and returns the created record.
    ==============================================================================*/
    public function create(array $data): ?PharmacyBranch;

    /* ============================================================================
    |   Fetch a single Pharmacy Branches record by its primary ID.
    ==============================================================================*/
    public function find(int $id, ?array $selectedColumns = null): ?PharmacyBranch;


    /* ============================================================================
    |  Fetch Pharmacy Branches with optional filters and selected columns.
    ==============================================================================*/
    public function getPharmacyBranches(?array $filterData = null, ?array $selectedcolumns = null): ?LengthAwarePaginator;

    /* ============================================================================
    |  Fetch Pharmacy Branches collection with optional filters and selected columns.
    ==============================================================================*/
    public function getPharmacyBranchesCollection(?array $filterData = null, ?array $selectedcolumns = null): ?Collection;

    /* ============================================================================
    |Update specific columns of an existing Pharmacy Branches record.
    ==============================================================================*/
    public function updateColumns(int $id, array $data): bool;

    /* ================================================
     |Delete existing Pharmacy Branches record by its id.
     ==================================================*/
    public function delete(int $id): bool;
}
