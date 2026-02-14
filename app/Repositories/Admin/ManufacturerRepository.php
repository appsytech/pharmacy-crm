<?php

namespace App\Repositories\Admin;

use App\Models\Manufacturer;
use App\Repositories\Admin\Interfaces\ManufacturerRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class ManufacturerRepository implements ManufacturerRepositoryInterface
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }


    /* ============================================================================
    | Create a new Manufacturer record in the database and returns the created record.
    ==============================================================================*/
    public function create(array $data): ?Manufacturer
    {
        return Manufacturer::create($data);
    }

    /* ============================================================================
    |   Fetch a single Manufacturer record by its primary ID.
    ==============================================================================*/
    public function find(int $id, ?array $selectedColumns = null): ?Manufacturer
    {
        return Manufacturer::where('id', $id)
            ->when(
                isset($selectedColumns) && count($selectedColumns) >= 1,
                function ($query) use ($selectedColumns) {
                    return $query->select($selectedColumns);
                }
            )
            ->first();
    }


    /* ============================================================================
    |  Fetch Manufacturer with optional filters and selected columns.
    ==============================================================================*/
    public function getManufacturers(?array $filterData = null, ?array $selectedcolumns = null): ?LengthAwarePaginator
    {
       
        return Manufacturer::when(
            isset($filterData['manufacturerName']),
            function ($query) use ($filterData) {
                $query->where('manufacturer_name', 'LIKE', '%' . $filterData['manufacturerName'] . '%');
            }
        )
            ->when(
                isset($filterData['phone']),
                function ($query) use ($filterData) {
                    $query->where('phone', 'LIKE', '%' . $filterData['phone'] . '%');
                }
            )
            ->when(
                isset($selectedcolumns) && count($selectedcolumns) >= 1,
                function ($query) use ($selectedcolumns) {
                    return $query->select($selectedcolumns);
                }
            )
            ->paginate($filterData['paginateLimit'] ?? 10);
    }

    /* ============================================================================
    |  Fetch Manufacturers Collection with optional filters and selected columns.
    ==============================================================================*/
    public function getManufacturersCollection(?array $filterData = null, ?array $selectedcolumns = null): ?Collection
    {
       
        return Manufacturer::when(
            isset($filterData['manufacturerName']),
            function ($query) use ($filterData) {
                $query->where('manufacturer_name', 'LIKE', '%' . $filterData['manufacturerName'] . '%');
            }
        )
            ->when(
                isset($filterData['phone']),
                function ($query) use ($filterData) {
                    $query->where('phone', 'LIKE', '%' . $filterData['phone'] . '%');
                }
            )
            ->when(
                isset($selectedcolumns) && count($selectedcolumns) >= 1,
                function ($query) use ($selectedcolumns) {
                    return $query->select($selectedcolumns);
                }
            )
            ->get();
    }

    /* ============================================================================
    |Update specific columns of an existing Manufacturer record.
    ==============================================================================*/
    public function updateColumns(int $id, array $data): bool
    {
        return Manufacturer::where('id', $id)->update($data);
    }

    /* ================================================
     |Delete existing Manufacturer record by its id.
     ==================================================*/
    public function delete(int $id): bool
    {
        return Manufacturer::where('id', $id)->delete();
    }
}
