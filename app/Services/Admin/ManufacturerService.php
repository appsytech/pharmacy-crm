<?php

namespace App\Services\Admin;

use App\Models\Manufacturer;
use App\Repositories\Admin\Interfaces\ManufacturerRepositoryInterface;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class ManufacturerService
{
    /**
     * Create a new class instance.
     */
    public function __construct(
        protected ManufacturerRepositoryInterface $manufacturerRepo
    ) {}



    /* =============================================================
    | Create a new manufacturer record.
    ================================================================*/
    public function create($request): array
    {
        $data = [
            'manufacturer_name' => $request->manufacturer_name,
            'contact_person'    => $request->contact_person ?? null,
            'phone'             => $request->phone ?? null,
            'email'             => $request->email ?? null,
            'address'           => $request->address ?? null,
            'city'              => $request->city ?? null,
            'state'             => $request->state ?? null,
            'country'           => $request->country ?? null,
            'license_number'    => $request->license_number ?? null,
            'status'            => $request->status ?? 'ACTIVE',
            'created_at'  => Carbon::now()

        ];

        $createdManufacturer = $this->manufacturerRepo->create($data);

        if ($createdManufacturer) {
            return [
                'status' => true,
                'message' => ['Manufacturer Created successfully']
            ];
        }

        return [
            'status' => false,
            'message' => ['Something went wrong']
        ];
    }

    /* ============================================================================
    |   Fetch a single manufacturer record by its primary ID.
    ==============================================================================*/
    public function find(int $id, ?array $selectedColumns = null): ?Manufacturer
    {
        return $this->manufacturerRepo->find($id, $selectedColumns);
    }

    /* ============================================================================
    |  Fetch manufacturers with optional filters and selected columns.
    ==============================================================================*/
    public function getManufacturers(?array $filterData = null, ?array $selectedcolumns = null): ?LengthAwarePaginator
    {
        return $this->manufacturerRepo->getManufacturers($filterData, $selectedcolumns);
    }

    /* ============================================================================
    |  Fetch Manufacturers Collection with optional filters and selected columns.
    ==============================================================================*/
    public function getManufacturersCollection(?array $filterData = null, ?array $selectedcolumns = null): ?Collection
    {
        return $this->manufacturerRepo->getManufacturersCollection($filterData, $selectedcolumns);
    }

    /* ============================================================================
    | Update an existing manufacturer record .
    ==============================================================================*/
    public function update($request): array
    {
        $manufacturerId = $request->id;

        $data = [
            'manufacturer_name' => $request->manufacturer_name,
            'contact_person'    => $request->contact_person ?? null,
            'phone'             => $request->phone ?? null,
            'email'             => $request->email ?? null,
            'address'           => $request->address ?? null,
            'city'              => $request->city ?? null,
            'state'             => $request->state ?? null,
            'country'           => $request->country ?? null,
            'license_number'    => $request->license_number ?? null,
            'status'            => $request->status ?? 'ACTIVE',
            'updated_at' => Carbon::now(),
        ];


        $isUpdated =  $this->manufacturerRepo->updateColumns($manufacturerId, $data);

        if ($isUpdated) {
            return [
                'status' => true,
                'message' => ['Manufacturer Updated successfully']
            ];
        }

        return [
            'status' => false,
            'message' => ['Something went wrong']
        ];
    }



    /* ============================================================================
    | Permanently delete an manufacturer.
    ==============================================================================*/
    public function delete(int $id): bool
    {
        return $this->manufacturerRepo->delete($id);
    }
}
