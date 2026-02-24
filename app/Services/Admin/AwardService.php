<?php

namespace App\Services\Admin;

use App\Models\Award;
use App\Repositories\Admin\Interfaces\AwardRepositoryInterface;
use App\Repositories\Admin\Interfaces\PharmacyStatisticRepositoryInterface;
use Carbon\Carbon;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Storage;

class AwardService
{
    /**
     * Create a new class instance.
     */
    public function __construct(
        protected AwardRepositoryInterface $awardRepo,
        protected PharmacyStatisticRepositoryInterface $statisticRepo
    ) {}



    /* =============================================================
    | Create a new award record.
    ================================================================*/
    public function create($request): ?Award
    {
        $data = [
            'award_name' => $request->award_name,
            'award_type' => $request->award_type,
            'award_to' => $request->award_to,
            'award_by' => $request->award_by,
            'award_year' => $request->award_year ?? null,
            'award_by_country' => $request->award_by_country,
            'created_at' => Carbon::now(),
        ];

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('assets/images/awards', 'public');
        }

        $createdAward = $this->awardRepo->create($data);

        if ($createdAward) {
            $this->statisticRepo->incrementTotalForType('AWARD');
        }

        return $createdAward;
    }

    /* ============================================================================
    |   Fetch a single award record by its primary ID.
    ==============================================================================*/
    public function find(int $id, ?array $selectedColumns = null): ?Award
    {
        return $this->awardRepo->find($id, $selectedColumns);
    }

    /* ============================================================================
    |  Fetch awards with optional filters and selected columns.
    ==============================================================================*/
    public function getAwards(?array $filterData = null, ?array $selectedcolumns = null): ?LengthAwarePaginator
    {
        return $this->awardRepo->getAwards($filterData, $selectedcolumns);
    }

    /* ============================================================================
    | Update an existing award record .
    ==============================================================================*/
    public function update($request): bool
    {
        $awardId = $request->id;
        $award = $this->awardRepo->find($awardId, ['image']);

        $data = [
            'award_name' => $request->award_name,
            'award_type' => $request->award_type,
            'award_to' => $request->award_to,
            'award_by' => $request->award_by,
            'award_year' => $request->award_year ?? null,
            'award_by_country' => $request->award_by_country,
        ];

        if ($request->hasFile('image')) {
            if (isset($award->image) && Storage::disk('public')->exists($award->image)) {
                Storage::disk('public')->delete($award->image);
            }
            $data['image'] = $request->file('image')->store('assets/images/awards', 'public');
        }

        return $this->awardRepo->updateColumns($awardId, $data);
    }

    /* ============================================================================
    | Permanently delete an award.
    ==============================================================================*/
    public function delete(int $id): bool
    {
        $externalWonAward = $this->awardRepo->find($id, ['image']);

        if (! empty($externalWonAward->image) && Storage::disk('public')->exists($externalWonAward->image)) {
            Storage::disk('public')->delete($externalWonAward->image);
        }

        $isDeleted = $this->awardRepo->delete($id);

        if ($isDeleted) {
            $this->statisticRepo->decrementTotalForType('AWARD');
        }

        return $isDeleted;
    }
}
