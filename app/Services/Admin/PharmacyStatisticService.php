<?php

namespace App\Services\Admin;

use App\Models\PharmacyStatistic;
use App\Repositories\Admin\Interfaces\PharmacyStatisticRepositoryInterface;
use Carbon\Carbon;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Auth;

class PharmacyStatisticService
{
    /**
     * Create a new class instance.
     */
    public function __construct(
        protected PharmacyStatisticRepositoryInterface $statisticRepository
    ) {}



    /* ============================================================================
    | Create a new Pharmacy Statistic record in the database and returns the created record.
    ==============================================================================*/
    public function create($request): ?PharmacyStatistic
    {
        $data = [
            'type' => $request->type,
            'status' => $request->status,
            'created_by' => Auth::user()->name,
            'created_at' => Carbon::now()
        ];

        return $this->statisticRepository->create($data);
    }

    /* ============================================================================
    |   Fetch a single Pharmacy Statistic record by its Type.
    ==============================================================================*/
    public function findByType(string $type, ?array $selectedColumns = null): ?PharmacyStatistic
    {
        return $this->statisticRepository->findByType($type, $selectedColumns);
    }

    /* ============================================================================
    |  Fetch Pharmacy Statistics with optional filters and selected columns.
    ==============================================================================*/
    public function getPharmacyStatistics(?array $filterData = null, ?array $selectedcolumns = null): ?LengthAwarePaginator
    {
        return $this->statisticRepository->getPharmacyStatistics($filterData, $selectedcolumns);
    }

    /* ============================================================================
    | Toggle Pharmacy Statistic status.
    ==============================================================================*/
    public function updateStatus(int $id): bool
    {
        $statistic = $this->statisticRepository->find($id, ['id', 'status']);

        if (! $statistic) {
            return false;
        }

        return $this->statisticRepository->updateColumns($id, [
            'status' => ! $statistic->status,
        ]);
    }
}
