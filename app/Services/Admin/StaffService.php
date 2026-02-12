<?php

namespace App\Services\Admin;

use App\Models\Staff;
use App\Repositories\Admin\Interfaces\StaffRepositoryInterface;
use Carbon\Carbon;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Auth;

class StaffService
{
    /**
     * Create a new class instance.
     */
    public function __construct(
        protected StaffRepositoryInterface $staffRepo
    ) {}



    /* =============================================================
    | Create a new staff record.
    ================================================================*/
    public function create($request): array
    {

        $data = [
            'full_name' => $request->full_name,
            'email' => $request->email,
            'phone' => $request->phone ?? null,
            'gender' => $request->gender ?? null,
            'date_of_birth' => $request->date_of_birth ?? null,
            'join_date' => $request->join_date,
            'job_title' => $request->job_title ?? null,
            'department' => $request->department ?? null,
            'salary' => $request->salary ?? null,
            'status' => $request->status,
            'address' => $request->address ?? null,
            'created_by' => Auth::user()->name,
            'created_at' => Carbon::now()
        ];

        $createdstaff = $this->staffRepo->create($data);

        if ($createdstaff) {
            return [
                'status' => true,
                'message' => ['Staff Created successfully']
            ];
        }

        return [
            'status' => false,
            'message' => ['Something went wrong']
        ];
    }




    /* ============================================================================
    |   Fetch a single staff record by its primary ID.
    ==============================================================================*/
    public function find(int $id, ?array $selectedColumns = null): ?Staff
    {
        return $this->staffRepo->find($id, $selectedColumns);
    }

    /* ============================================================================
    |  Fetch staffs with optional filters and selected columns.
    ==============================================================================*/
    public function getStaffs(?array $filterData = null, ?array $selectedcolumns = null): ?LengthAwarePaginator
    {
        return $this->staffRepo->getStaffs($filterData, $selectedcolumns);
    }

    /* ============================================================================
    | Update an existing staff record .
    ==============================================================================*/
    public function update($request): array
    {
        $staffId = $request->id;

        $data = [
            'full_name' => $request->full_name,
            'email' => $request->email,
            'phone' => $request->phone ?? null,
            'gender' => $request->gender ?? null,
            'date_of_birth' => $request->date_of_birth ?? null,
            'join_date' => $request->join_date,
            'job_title' => $request->job_title ?? null,
            'department' => $request->department ?? null,
            'salary' => $request->salary ?? null,
            'status' => $request->status,
            'address' => $request->address ?? null,
            'updated_at' => Carbon::now(),
        ];

        $isUpdated =  $this->staffRepo->updateColumns($staffId, $data);

        if ($isUpdated) {
            return [
                'status' => true,
                'message' => ['staff Updated successfully']
            ];
        }

        return [
            'status' => false,
            'message' => ['Something went wrong']
        ];
    }



    /* ============================================================================
    | Permanently delete an staff.
    ==============================================================================*/
    public function delete(int $id): bool
    {
        return $this->staffRepo->delete($id);
    }
}
