<?php

namespace App\Services\Admin;

use App\Models\HomeSlider;
use App\Repositories\Admin\Interfaces\HomeSliderRepositoryInterface;
use Carbon\Carbon;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class HomeSliderService
{
    /**
     * Create a new class instance.
     */
    public function __construct(
        protected HomeSliderRepositoryInterface $homeSliderRepo
    ) {
        //
    }

    /* =============================================================
    | Create a new home slider record.
    ================================================================*/
    public function create($request): ?HomeSlider
    {
        $data = [
            'title' => $request->title,
            'type' => $request->type,
            'status' => $request->status,
            'device_type' => $request->device_type,
            'description' => $request->description,
            'jump_type' => $request->jump_type,
            'created_by' => Auth::user()->name,
            'created_at' => Carbon::now(),
        ];

        if ($request->hasFile('images')) {
            $data['images'] = $request->file('images')->store('assets/images/homeslider', 'public');
        }

        return $this->homeSliderRepo->create($data);
    }

    /* ============================================================================
    |   Fetch a single  home slider record by its primary ID.
    ==============================================================================*/
    public function find(int $id, ?array $selectedColumns = null): ?HomeSlider
    {
        return $this->homeSliderRepo->find($id, $selectedColumns);
    }

    /* ============================================================================
    |  Fetch  home slider with optional filters and selected columns.
    ==============================================================================*/
    public function getHomeSliders(?array $filterData = null, ?array $selectedcolumns = null): ?LengthAwarePaginator
    {
        return $this->homeSliderRepo->getHomeSliders($filterData, $selectedcolumns);
    }

    /* ============================================================================
    | Update an existing  home slider record .
    ==============================================================================*/
    public function update($request): bool
    {
        $sliderId = $request->id;
        $slider = $this->homeSliderRepo->find($sliderId, ['images']);

        $data = [
            'title' => $request->title,
            'type' => $request->type,
            'status' => $request->status,
            'device_type' => $request->device_type,
            'description' => $request->description,
            'jump_type' => $request->jump_type,
            'updated_at' => Carbon::now(),
        ];

        if ($request->hasFile('images')) {
            if (isset($slider->images) && Storage::disk('public')->exists($slider->images)) {
                Storage::disk('public')->delete($slider->images);
            }
            $data['images'] = $request->file('images')->store('assets/images/homeslider', 'public');
        }

        return $this->homeSliderRepo->updateColumns($sliderId, $data);
    }

    /* ============================================================================
    | Toggle  home slider status.
    ==============================================================================*/
    public function updateStatus(int $id): bool
    {
        $slider = $this->homeSliderRepo->find($id, ['id', 'status']);

        if (! $slider) {
            return false;
        }

        return $this->homeSliderRepo->updateColumns($id, [
            'status' => ! $slider->status,
        ]);
    }

    /* ============================================================================
    | Permanently delete an home slider.
    ==============================================================================*/
    public function delete(int $id): bool
    {
        $slider = $this->homeSliderRepo->find($id, ['images']);

        if (! empty($slider->images) && Storage::disk('public')->exists($slider->images)) {
            Storage::disk('public')->delete($slider->images);
        }

        return $this->homeSliderRepo->delete($id);
    }
}
