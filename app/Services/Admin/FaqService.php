<?php

namespace App\Services\Admin;

use App\Models\Faq;
use App\Repositories\Admin\Interfaces\FaqRepositoryInterface;
use Carbon\Carbon;
use Illuminate\Pagination\LengthAwarePaginator;

class FaqService
{
    /**
     * Create a new class instance.
     */
    public function __construct(
        protected FaqRepositoryInterface $faqRepo
    ) {}



    /* =============================================================
    | Create a new Faq record.
    ================================================================*/
    public function create($request): array
    {
        $data = [
            'question'  => $request->question,
            'answer'    => $request->answer,
            'is_active' => $request->status ?? 1,
            'sort'      => $request->sort ?? 0,
        ];

        $createdFaq = $this->faqRepo->create($data);

        if ($createdFaq) {
            return [
                'status' => true,
                'message' => ['Faq Created successfully']
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
    public function find(int $id, ?array $selectedColumns = null): ?Faq
    {
        return $this->faqRepo->find($id, $selectedColumns);
    }

    /* ============================================================================
    |  Fetch Faqs with optional filters and selected columns.
    ==============================================================================*/
    public function getFaqs(?array $filterData = null, ?array $selectedcolumns = null): ?LengthAwarePaginator
    {
        return $this->faqRepo->getFaqs($filterData, $selectedcolumns);
    }

    /* ============================================================================
    | Update an existing Faq record .
    ==============================================================================*/
    public function update($request): array
    {
        $faqId = $request->id;

        $data = [
            'question'  => $request->question,
            'answer'    => $request->answer,
            'is_active' => $request->status ?? 1,
            'sort'      => $request->sort ?? 0,
            'updated_at' => Carbon::now()
        ];

        $isUpdated =  $this->faqRepo->updateColumns($faqId, $data);


        if ($isUpdated) {
            return [
                'status' => true,
                'message' => ['Faq Updated successfully']
            ];
        }

        return [
            'status' => false,
            'message' => ['Something went wrong']
        ];
    }

    /* ============================================================================
    | Toggle Faq status.
    ==============================================================================*/
    public function updateStatus(int $id): bool
    {
        $faq = $this->faqRepo->find($id, ['id', 'is_active']);

        if (! $faq) {
            return false;
        }

        return $this->faqRepo->updateColumns($id, [
            'is_active' => ! $faq->is_active,
        ]);
    }

    /* ============================================================================
    | Permanently delete an Faq.
    ==============================================================================*/
    public function delete(int $id): bool
    {

        $isDeleted = $this->faqRepo->delete($id);

        return $isDeleted;
    }
}
