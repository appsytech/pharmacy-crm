<?php

namespace App\Services\Admin;

use App\Models\PharmacySchedule;
use App\Repositories\Admin\Interfaces\PharmacyScheduleRepositoryInterface;
use Carbon\Carbon;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Auth;

class PharmacyScheduleService
{
    /**
     * Create a new class instance.
     */
    public function __construct(
        protected PharmacyScheduleRepositoryInterface $pharmacyScheduleRepo
    ) {}




    /* =============================================================
    | Create a new pharmacy schedule record.
    ================================================================*/
    public function create($request): array
    {
        $data = [
            'days'        => $request->days,
            'start_time'  => $request->start_time,
            'end_time'    => $request->end_time,
            'status'      => $request->status ?? 1,
            'sort'        => $request->sort ?? 0,
            'created_by'  => Auth::user()->name,
            'created_at'   => Carbon::now()
        ];

        $createdSchedule = $this->pharmacyScheduleRepo->create($data);

        if ($createdSchedule) {
            return [
                'status' => true,
                'message' => ['Pharmacy Schedule Created successfully']
            ];
        }

        return [
            'status' => false,
            'message' => ['Something went wrong']
        ];
    }

    /* ============================================================================
    |   Fetch a single pharmacy Schedule record by its primary ID.
    ==============================================================================*/
    public function find(int $id, ?array $selectedColumns = null): ?PharmacySchedule
    {
        return $this->pharmacyScheduleRepo->find($id, $selectedColumns);
    }

    /* ============================================================================
    |  Fetch pharmacy schedules with optional filters and selected columns.
    ==============================================================================*/
    public function getPharmacySchedules(?array $filterData = null, ?array $selectedcolumns = null): ?LengthAwarePaginator
    {
        return $this->pharmacyScheduleRepo->getPharmacySchedules($filterData, $selectedcolumns);
    }

    /* ============================================================================
    | Update an existing pharmacy schedule record .
    ==============================================================================*/
    public function update($request): array
    {
        $scheduleId = $request->id;

        $data = [
            'days'        => $request->days,
            'start_time'  => $request->start_time,
            'end_time'    => $request->end_time,
            'status'      => $request->status ?? 1,
            'sort'        => $request->sort ?? 0,
        ];

        $isUpdated =  $this->pharmacyScheduleRepo->updateColumns($scheduleId, $data);

        if ($isUpdated) {
            return [
                'status' => true,
                'message' => ['Pharmacy Schedule Updated successfully']
            ];
        }

        return [
            'status' => false,
            'message' => ['Something went wrong']
        ];
    }

    /* ============================================================================
    | Toggle pharmacy schedule status.
    ==============================================================================*/
    public function updateStatus(int $id): bool
    {
        $schedule = $this->pharmacyScheduleRepo->find($id, ['id', 'status']);

        if (! $schedule) {
            return false;
        }

        return $this->pharmacyScheduleRepo->updateColumns($id, [
            'status' => ! $schedule->status,
        ]);
    }

    /* ============================================================================
    | Permanently delete an pharmacy schedule.
    ==============================================================================*/
    public function delete(int $id): bool
    {

        $isDeleted = $this->pharmacyScheduleRepo->delete($id);

        return $isDeleted;
    }
}
