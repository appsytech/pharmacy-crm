<?php

namespace App\Repositories\Admin;

use App\Models\Faq;
use App\Repositories\Admin\Interfaces\FaqRepositoryInterface;
use Illuminate\Pagination\LengthAwarePaginator;

class FaqRepository implements FaqRepositoryInterface
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }


    /* ============================================================================
    | Create a new faq record in the database and returns the created record.
    ==============================================================================*/
    public function create(array $data): ?Faq
    {
        return Faq::create($data);
    }

    /* ============================================================================
    |   Fetch a single faq record by its primary ID.
    ==============================================================================*/
    public function find(int $id, ?array $selectedColumns = null): ?Faq
    {
        return Faq::where('id', $id)
            ->when(
                isset($selectedColumns) && count($selectedColumns) >= 1,
                function ($query) use ($selectedColumns) {
                    return $query->select($selectedColumns);
                }
            )
            ->first();
    }


    /* ============================================================================
    |  Fetch faq with optional filters and selected columns.
    ==============================================================================*/
    public function getFaqs(?array $filterData = null, ?array $selectedcolumns = null): ?LengthAwarePaginator
    {
        return Faq::when(
            isset($filterData['status']),
            function ($query) use ($filterData) {
                $query->where('is_active', $filterData['status']);
            }
        )
            ->when(
                isset($selectedcolumns) && count($selectedcolumns) >= 1,
                function ($query) use ($selectedcolumns) {
                    return $query->select($selectedcolumns);
                }
            )
            ->orderBy('sort', 'asc')
            ->paginate($filterData['paginateLimit'] ?? 10);
    }

    /* ============================================================================
    |Update specific columns of an existing faq record.
    ==============================================================================*/
    public function updateColumns(int $id, array $data): bool
    {
        return Faq::where('id', $id)->update($data);
    }

    /* ================================================
     |Delete existing faq record by its id.
     ==================================================*/
    public function delete(int $id): bool
    {
        return Faq::where('id', $id)->delete();
    }
}
