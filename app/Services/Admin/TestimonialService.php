<?php

namespace App\Services\Admin;

use App\Models\Testimonial;
use App\Repositories\Admin\Interfaces\TestimonialRepositoryInterface;
use Carbon\Carbon;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Storage;

class TestimonialService
{
    /**
     * Create a new class instance.
     */
    public function __construct(
        protected TestimonialRepositoryInterface $testimonialRepo
    ) {
        //
    }


    /* =============================================================
    | Create a new testimonial record.
    ================================================================*/
    public function create($request): array
    {
        $data = [
            'name'        => $request->name,
            'email'       => $request->email ?? null,
            'company'     => $request->company ?? null,
            'position'    => $request->position ?? null,
            'stars'       => $request->stars,
            'description' => $request->description,
            'sort'        => $request->sort ?? 0,
            'status'      => $request->status ?? 'PENDING',
        ];

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('assets/images/testimonial', 'public');
        }

        $createdTestimonial = $this->testimonialRepo->create($data);

        if ($createdTestimonial) {
            return [
                'status' => true,
                'message' => ['Testimonial Created successfully']
            ];
        }


        return [
            'status' => false,
            'message' => ['Something went wrong']
        ];
    }

    /* ============================================================================
    |   Fetch a single testimonial record by its primary ID.
    ==============================================================================*/
    public function find(int $id, ?array $selectedColumns = null): ?Testimonial
    {
        return $this->testimonialRepo->find($id, $selectedColumns);
    }

    /* ============================================================================
    |  Fetch testimonials with optional filters and selected columns.
    ==============================================================================*/
    public function getTestimonials(?array $filterData = null, ?array $selectedcolumns = null): ?LengthAwarePaginator
    {
        return $this->testimonialRepo->getTestimonials($filterData, $selectedcolumns);
    }

    /* ============================================================================
    | Update an existing testimonial record .
    ==============================================================================*/
    public function update($request): array
    {
        $testimonialId = $request->id;
        $testimonial = $this->testimonialRepo->find($testimonialId, ['image']);

        $data = [
            'name'        => $request->name,
            'email'       => $request->email ?? null,
            'company'     => $request->company ?? null,
            'position'    => $request->position ?? null,
            'stars'       => $request->stars,
            'description' => $request->description,
            'sort'        => $request->sort ?? 0,
            'status'      => $request->status ?? 'PENDING',
            'updated_at'    => Carbon::now()
        ];

        if ($request->hasFile('image')) {
            if (isset($testimonial->image) && Storage::disk('public')->exists($testimonial->image)) {
                Storage::disk('public')->delete($testimonial->image);
            }
            $data['image'] = $request->file('image')->store('assets/images/testimonial', 'public');
        }


        $isUpdated =  $this->testimonialRepo->updateColumns($testimonialId, $data);

        if ($isUpdated) {
            return [
                'status' => true,
                'message' => ['Testimonial Updated successfully']
            ];
        }

        return [
            'status' => false,
            'message' => ['Something went wrong']
        ];
    }



    /* ============================================================================
    | Permanently delete an testimonial.
    ==============================================================================*/
    public function delete(int $id): bool
    {
        $testimonial = $this->testimonialRepo->find($id, ['image']);

        if (! empty($testimonial->image) && Storage::disk('public')->exists($testimonial->image)) {
            Storage::disk('public')->delete($testimonial->image);
        }

        $isDeleted = $this->testimonialRepo->delete($id);

        return $isDeleted;
    }
}
