<?php

namespace App\Services\Admin;

use App\Models\CheckupProcess;
use App\Repositories\Admin\Interfaces\CheckupProcessRepositoryInterface;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class CheckupProcessService
{
    /**
     * Create a new class instance.
     */
    public function __construct(
        protected CheckupProcessRepositoryInterface $checkupProcessRepo
    ) {
        //
    }



    /* =============================================================
    | Create a new checkup process record.
    ================================================================*/
    public function create($request): array
    {
        $data = [
            'sn'          => $request->sn,
            'title'       => $request->title,
            'description' => $request->description ?? null,
            'status'      => $request->status ?? 1,
            'created_by'  => Auth::user()->name,
        ];


        if ($request->hasFile('images')) {
            $data['images'] = $request->file('images')->store('assets/images/checkup-process', 'public');
        }

        $createdSchedule = $this->checkupProcessRepo->create($data);

        if ($createdSchedule) {
            return [
                'status' => true,
                'message' => ['Checkup Process Created successfully']
            ];
        }

        return [
            'status' => false,
            'message' => ['Something went wrong']
        ];
    }

    /* ============================================================================
    |   Fetch a single checkup process record by its primary ID.
    ==============================================================================*/
    public function find(int $id, ?array $selectedColumns = null): ?CheckupProcess
    {
        return $this->checkupProcessRepo->find($id, $selectedColumns);
    }

    /* ============================================================================
    |  Fetch checkup process with optional filters and selected columns.
    ==============================================================================*/
    public function getCheckupProcesss(?array $filterData = null, ?array $selectedcolumns = null): ?LengthAwarePaginator
    {
        return $this->checkupProcessRepo->getCheckupProcesss($filterData, $selectedcolumns);
    }

    /* ============================================================================
    | Update an existing checkup process record .
    ==============================================================================*/
    public function update($request): array
    {
        $processId = $request->id;
        $process = $this->checkupProcessRepo->find($processId, ['images']);

        $data = [
            'sn'          => $request->sn,
            'title'       => $request->title,
            'description' => $request->description ?? null,
            'status'      => $request->status ?? 1,
        ];

        if ($request->hasFile('images')) {
            if (isset($process->images) && Storage::disk('public')->exists($process->images)) {
                Storage::disk('public')->delete($process->images);
            }
            $data['images'] = $request->file('images')->store('assets/images/checkup-process', 'public');
        }

        $isUpdated =  $this->checkupProcessRepo->updateColumns($processId, $data);

        if ($isUpdated) {
            return [
                'status' => true,
                'message' => ['Checkup Process Updated successfully']
            ];
        }

        return [
            'status' => false,
            'message' => ['Something went wrong']
        ];
    }

    /* ============================================================================
    | Toggle checkup process status.
    ==============================================================================*/
    public function updateStatus(int $id): bool
    {
        $process = $this->checkupProcessRepo->find($id, ['id', 'status']);

        if (! $process) {
            return false;
        }

        return $this->checkupProcessRepo->updateColumns($id, [
            'status' => ! $process->status,
        ]);
    }

    /* ============================================================================
    | Permanently delete an checkup process.
    ==============================================================================*/
    public function delete(int $id): bool
    {
        $process = $this->checkupProcessRepo->find($id, ['images']);

        if (! empty($process->images) && Storage::disk('public')->exists($process->images)) {
            Storage::disk('public')->delete($process->images);
        }

        $isDeleted = $this->checkupProcessRepo->delete($id);

        return $isDeleted;
    }
}
