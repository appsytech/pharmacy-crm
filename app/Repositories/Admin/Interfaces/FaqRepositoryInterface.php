<?php

namespace App\Repositories\Admin\Interfaces;

use App\Models\Faq;
use Illuminate\Pagination\LengthAwarePaginator;

interface FaqRepositoryInterface
{

    /* ============================================================================
    | Create a new faq record in the database and returns the created record.
    ==============================================================================*/
    public function create(array $data): ?Faq;

    /* ============================================================================
    |   Fetch a single faq record by its primary ID.
    ==============================================================================*/
    public function find(int $id, ?array $selectedColumns = null): ?Faq;


    /* ============================================================================
    |  Fetch faq with optional filters and selected columns.
    ==============================================================================*/
    public function getFaqs(?array $filterData = null, ?array $selectedcolumns = null): ?LengthAwarePaginator;

    /* ============================================================================
    |Update specific columns of an existing faq record.
    ==============================================================================*/
    public function updateColumns(int $id, array $data): bool;

    /* ================================================
     |Delete existing faq record by its id.
     ==================================================*/
    public function delete(int $id): bool;
}
