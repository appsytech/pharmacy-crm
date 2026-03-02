<?php

namespace App\Services\Admin;

use App\Models\Service;
use App\Repositories\Admin\Interfaces\ServiceRepositoryInterface;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ServiceService
{
    /**
     * Create a new class instance.
     */
    public function __construct(
        protected ServiceRepositoryInterface $serviceRepo
    ) {}



    /* =============================================================
    | Create a new service record.
    ================================================================*/
    public function create($request)
    {

        $data = [
            'title'               => $request->title,
            'description'         => $request->description ?? null,
            'location'            => $request->location ?? null,
            'mission_description' => $request->mission_description ?? null,
            'created_by'          => Auth::user()->name,
            'created_at'          => Carbon::now(),
            'status'              => $request->status ?? 1,
            'sort'               => (int) $request->sort,

        ];


        if ($request->hasFile('icon')) {
            $data['icon'] = $request->file('icon')->store('assets/icons/services', 'public');
        }

        if ($request->hasFile('images1')) {
            $data['images1'] = $request->file('images1')->store('assets/images/services', 'public');
        }

        if ($request->hasFile('images2')) {
            $data['images2'] = $request->file('images2')->store('assets/images/services', 'public');
        }

        if ($request->hasFile('images3')) {
            $data['images3'] = $request->file('images3')->store('assets/images/services', 'public');
        }

        $isCreated = $this->serviceRepo->create($data);

        if ($isCreated) {

            return response()->json([
                'status' => true,
                'code' => 200,
                'messages' => ['Service Created Successfully'],
                'errors' => null,
                'data' => null,
            ], 200);
        } else {

            return response()->json([
                'status' => false,
                'code' => 500,
                'messages' => ['Something went wrong'],
                'errors' => ['Something went wrong'],
                'data' => null,
            ], 500);
        }
    }

    /* ============================================================================
    |   Fetch a single service record by its primary ID.
    ==============================================================================*/
    public function find(int $id, ?array $selectedColumns = null): ?Service
    {
        return $this->serviceRepo->find($id, $selectedColumns);
    }

    /* ============================================================================
    |  Fetch services with optional filters and selected columns.
    ==============================================================================*/
    public function getServices(?array $filterData = null, ?array $selectedcolumns = null): ?LengthAwarePaginator
    {
        return $this->serviceRepo->getServices($filterData, $selectedcolumns);
    }

    /* ============================================================================
    | Update an existing service record .
    ==============================================================================*/
    public function update($request): bool
    {
        $serviceId = $request->id;
        $service = $this->serviceRepo->find($serviceId, ['icon', 'images1', 'images2', 'images3']);

        $data = [
            'title'               => $request->title,
            'description'         => $request->description ?? null,
            'location'            => $request->location ?? null,
            'mission_description' => $request->mission_description ?? null,
            'status'              => $request->status ?? 1,
            'sort'               => $request->sort
        ];

        if ($request->hasFile('icon')) {
            if (isset($service->icon) && Storage::disk('public')->exists($service->icon)) {
                Storage::disk('public')->delete($service->icon);
            }
            $data['icon'] = $request->file('icon')->store('assets/icons/services', 'public');
        }

        if ($request->hasFile('images1')) {
            if (isset($service->images1) && Storage::disk('public')->exists($service->images1)) {
                Storage::disk('public')->delete($service->images1);
            }
            $data['images1'] = $request->file('images1')->store('assets/images/services', 'public');
        }

        if ($request->hasFile('images2')) {
            if (isset($service->images2) && Storage::disk('public')->exists($service->images2)) {
                Storage::disk('public')->delete($service->images2);
            }
            $data['images2'] = $request->file('images2')->store('assets/images/services', 'public');
        }

        if ($request->hasFile('images3')) {
            if (isset($service->images3) && Storage::disk('public')->exists($service->images3)) {
                Storage::disk('public')->delete($service->images3);
            }
            $data['images3'] = $request->file('images3')->store('assets/images/services', 'public');
        }


        return $this->serviceRepo->updateColumns($serviceId, $data);
    }

    /* ============================================================================
    | Toggle service status.
    ==============================================================================*/
    public function updateStatus(int $id): bool
    {
        $service = $this->serviceRepo->find($id, ['id', 'status']);

        if (! $service) {
            return false;
        }

        return $this->serviceRepo->updateColumns($id, [
            'status' => ! $service->status,
        ]);
    }

    /* ============================================================================
    | Permanently delete an service.
    ==============================================================================*/
    public function delete(int $id): bool
    {
        $service = $this->serviceRepo->find($id, ['icon', 'images1', 'images2', 'images3']);

        if (! empty($service->icon) && Storage::disk('public')->exists($service->icon)) {
            Storage::disk('public')->delete($service->icon);
        }

        if (! empty($service->images1) && Storage::disk('public')->exists($service->images1)) {
            Storage::disk('public')->delete($service->images1);
        }

        if (! empty($service->images2) && Storage::disk('public')->exists($service->images2)) {
            Storage::disk('public')->delete($service->images2);
        }

        if (! empty($service->images3) && Storage::disk('public')->exists($service->images3)) {
            Storage::disk('public')->delete($service->images3);
        }

        return $this->serviceRepo->delete($id);
    }
}
