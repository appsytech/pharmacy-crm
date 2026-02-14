<?php

namespace App\Services\Admin;

use App\Models\Medicine;
use App\Repositories\Admin\Interfaces\ManufacturerRepositoryInterface;
use App\Repositories\Admin\Interfaces\MedicineRepositoryInterface;
use App\Repositories\Admin\Interfaces\SupplierRepositoryInterface;
use Carbon\Carbon;
use Illuminate\Pagination\LengthAwarePaginator;

class MedicineService
{
    /**
     * Create a new class instance.
     */
    public function __construct(
        protected MedicineRepositoryInterface $medicineRepo,
        protected ManufacturerRepositoryInterface $manuFacturerRepo,
        protected SupplierRepositoryInterface $supplierRepo
    ) {}



    /* =============================================================
    | Create a new medicine record.
    ================================================================*/
    public function create($request): array
    {
        $manufacturerId  = (int) $request->manufacturer_id;
        $supplierId = (int) $request->supplier_id;

        $manufacturerName = $this->manuFacturerRepo->find($manufacturerId, ['manufacturer_name'])?->manufacturer_name;
        $supplierName  = $this->supplierRepo->find($supplierId, ['supplier_name'])?->supplier_name;

        $data = [
            'supplier_id'       => $supplierId,
            'supplier_name'     => $supplierName,
            'manufacturer_id'   => $manufacturerId,
            'manufacturer_name' => $manufacturerName,
            'name'              => $request->name,
            'generic_name'      => $request->generic_name ?? null,
            'brand_name'        => $request->brand_name ?? null,
            'category'          => $request->category ?? null,
            'dosage_form'       => $request->dosage_form ?? null,
            'strength'          => $request->strength ?? null,
            'batch_number'      => $request->batch_number,
            'manufacturing_date' => $request->manufacturing_date ?? null,
            'expiry_date'       => $request->expiry_date ?? null,
            'purchase_price'    => $request->purchase_price,
            'selling_price'     => $request->selling_price,
            'stock_quantity'    => $request->stock_quantity ?? 0,
            'alert_quantity'    => $request->alert_quantity ?? 10,
            'storage_type'      => $request->storage_type ?? 'ROOM-TEMPERATURE',
            'shelf_location'    => $request->shelf_location ?? null,
            'rack_number'       => $request->rack_number ?? null,
            'description'       => $request->description ?? null,
            'created_at'  => Carbon::now()

        ];

        $createdMedicine = $this->medicineRepo->create($data);

        if ($createdMedicine) {
            return [
                'status' => true,
                'message' => ['Medicine Created successfully']
            ];
        }

        return [
            'status' => false,
            'message' => ['Something went wrong']
        ];
    }

    /* ============================================================================
    |   Fetch a single medicine record by its primary ID.
    ==============================================================================*/
    public function find(int $id, ?array $selectedColumns = null): ?Medicine
    {
        return $this->medicineRepo->find($id, $selectedColumns);
    }

    /* ============================================================================
    |  Fetch medicines with optional filters and selected columns.
    ==============================================================================*/
    public function getMedicines(?array $filterData = null, ?array $selectedcolumns = null): ?LengthAwarePaginator
    {
        return $this->medicineRepo->getMedicines($filterData, $selectedcolumns);
    }

    /* ============================================================================
    | Update an existing medicine record .
    ==============================================================================*/
    public function update($request): array
    {
        $medicineId = $request->id;
        $manufacturerId  = (int) $request->manufacturer_id;
        $supplierId = (int) $request->supplier_id;

        $manufacturerName = $this->manuFacturerRepo->find($manufacturerId, ['manufacturer_name'])?->manufacturer_name;
        $supplierName  = $this->supplierRepo->find($supplierId, ['supplier_name'])?->supplier_name;

        $data = [
            'supplier_id'       => $supplierId,
            'supplier_name'     => $supplierName,
            'manufacturer_id'   => $manufacturerId,
            'manufacturer_name' => $manufacturerName,
            'name'              => $request->name,
            'generic_name'      => $request->generic_name ?? null,
            'brand_name'        => $request->brand_name ?? null,
            'category'          => $request->category ?? null,
            'dosage_form'       => $request->dosage_form ?? null,
            'strength'          => $request->strength ?? null,
            'batch_number'      => $request->batch_number,
            'manufacturing_date' => $request->manufacturing_date ?? null,
            'expiry_date'       => $request->expiry_date ?? null,
            'purchase_price'    => $request->purchase_price,
            'selling_price'     => $request->selling_price,
            'stock_quantity'    => $request->stock_quantity ?? 0,
            'alert_quantity'    => $request->alert_quantity ?? 10,
            'storage_type'      => $request->storage_type ?? 'ROOM-TEMPERATURE',
            'shelf_location'    => $request->shelf_location ?? null,
            'rack_number'       => $request->rack_number ?? null,
            'description'       => $request->description ?? null,
            'updated_at' => Carbon::now(),
        ];


        $isUpdated =  $this->medicineRepo->updateColumns($medicineId, $data);

        if ($isUpdated) {
            return [
                'status' => true,
                'message' => ['Medicine Updated successfully']
            ];
        }

        return [
            'status' => false,
            'message' => ['Something went wrong']
        ];
    }



    /* ============================================================================
    | Permanently delete an medicine.
    ==============================================================================*/
    public function delete(int $id): bool
    {
        return $this->medicineRepo->delete($id);
    }
}
