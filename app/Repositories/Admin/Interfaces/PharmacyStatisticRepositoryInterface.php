<?php

namespace App\Repositories\Admin\Interfaces;

use App\Models\PharmacyStatistic;
use Illuminate\Pagination\LengthAwarePaginator;

interface PharmacyStatisticRepositoryInterface
{
    /* ============================================================================
    | Create a new pharmacy statistic record in the database and returns the created record.
    ==============================================================================*/
    public function create(array $data): ?PharmacyStatistic;

    /* ============================================================================
    |   Fetch a single pharmacy statistic record by its primary ID.
    ==============================================================================*/
    public function find(int $id, ?array $selectedColumns = null): ?PharmacyStatistic;

    /* ============================================================================
    |   Fetch a single pharmacy statistic record by its Type.
    ==============================================================================*/
    public function findByType(string $type, ?array $selectedColumns = null): ?PharmacyStatistic;

    /* ============================================================================
    |  Fetch pharmacy statistics with optional filters and selected columns.
    ==============================================================================*/
    public function getPharmacyStatistics(?array $filterData = null, ?array $selectedcolumns = null): ?LengthAwarePaginator;

    /* ============================================================================
    |Update specific columns of an existing pharmacy statistic record.
    ==============================================================================*/
    public function updateColumns(int $id, array $data): bool;

    /* ============================================================================
    | Increment the total counter by 1 based on the given type.  types:- 1 = Teacher , 2 = Award , 3 = student
    ==============================================================================*/
    public function incrementTotalForType(string $type): bool;

    /* ============================================================================
    | Decrement the total counter by 1 based on the given type.  types:- 1 = Teacher , 2 = Award , 3 = student
    ==============================================================================*/
    public function decrementTotalForType(string $type): bool;
}
