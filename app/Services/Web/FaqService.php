<?php

namespace App\Services\Web;

use App\Repositories\Web\Interfaces\FaqRepositoryInterface;
use Illuminate\Pagination\LengthAwarePaginator;

class FaqService
{
    /**
     * Create a new class instance.
     */
    public function __construct(
        protected FaqRepositoryInterface $faqRepo
    ) {}


    /* ============================================================================
    |  Fetch faq with optional filters and selected columns.
    ==============================================================================*/
    public function getFaqs(?array $filterData = null, ?array $selectedcolumns = null): ?LengthAwarePaginator
    {
        return $this->faqRepo->getFaqs($filterData, $selectedcolumns);
    }
}
