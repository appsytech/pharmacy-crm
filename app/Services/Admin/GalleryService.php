<?php

namespace App\Services\Admin;

use App\Models\Gallery;
use App\Repositories\Admin\Interfaces\GalleryRepositoryInterface;
use Carbon\Carbon;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class GalleryService
{
    /**
     * Create a new class instance.
     */
    public function __construct(
        protected GalleryRepositoryInterface $galleryRepo
    ) {}


    /* =============================================================
     | Create a new gallery image record.
    ================================================================*/
    public function create($request): ?Gallery
    {
        $data = [
            'title' => $request->title ?? null,
            'description' => $request->description ?? null,
            'status' => $request->status,
            'created_by' => Auth::user()->name,
            'created_at' => Carbon::now(),
        ];

        if ($request->hasFile('images')) {
            $file = $request->file('images');
            $data['images'] = $file->store('assets/images/galleries', 'public');
        }

        if ($request->hasFile('big_image')) {
            $file = $request->file('big_image');
            $data['big_image'] = $file->store('assets/images/galleries', 'public');
        }

        return $this->galleryRepo->create($data);
    }

    /* ============================================================================
    |   Fetch a single gallery image record by its primary ID.
    ==============================================================================*/
    public function find(int $id, ?array $selectedColumns = null): ?Gallery
    {
        return $this->galleryRepo->find($id, $selectedColumns);
    }

    /* ============================================================================
    |  Fetch gallery images with optional filters and selected columns.
    ==============================================================================*/
    public function getGallerys(?array $filterData = null, ?array $selectedcolumns = null): ?LengthAwarePaginator
    {
        return $this->galleryRepo->getGallerys($filterData, $selectedcolumns);
    }

    /* ============================================================================
    | Update an existing gallery image record .
    ==============================================================================*/
    public function update($request): bool
    {
        $galleryImageId = $request->id;
        $galleryImage = $this->galleryRepo->find($galleryImageId, ['images', 'big_image']);

        $data = [
            'title' => $request->title ?? null,
            'description' => $request->description ?? null,
            'status' => $request->status,
            'updated_at' => Carbon::now(),
            'updated_by' => Auth::user()->name
        ];

        if ($request->hasFile('images')) {

            if (isset($galleryImage->images) && Storage::disk('public')->exists($galleryImage->images)) {
                Storage::disk('public')->delete($galleryImage->images);
            }

            $file = $request->file('images');
            $data['images'] = $file->store('assets/images/galleries', 'public');
        }

        if ($request->hasFile('big_image')) {

            if (isset($galleryImage->big_image) && Storage::disk('public')->exists($galleryImage->big_image)) {
                Storage::disk('public')->delete($galleryImage->big_image);
            }

            $file = $request->file('big_image');
            $data['big_image'] = $file->store('assets/images/galleries', 'public');
        }

        return $this->galleryRepo->updateColumns($galleryImageId, $data);
    }



    /* ============================================================================
    | Permanently delete an gallery image record.
    ==============================================================================*/
    public function delete(int $id): bool
    {
        $galleryImage = $this->galleryRepo->find($id, ['id', 'images', 'big_image']);

        if (isset($galleryImage->images) && Storage::disk('public')->exists($galleryImage->images)) {
            Storage::disk('public')->delete($galleryImage->images);
        }

        if (isset($galleryImage->big_image) && Storage::disk('public')->exists($galleryImage->big_image)) {
            Storage::disk('public')->delete($galleryImage->big_image);
        }

        return $this->galleryRepo->delete($id);
    }
}
