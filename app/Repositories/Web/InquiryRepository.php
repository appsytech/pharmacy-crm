<?php

namespace App\Repositories\Web;

use App\Models\Inquiry;
use App\Repositories\Web\Interfaces\InquiryRepositoryInterface;

class InquiryRepository implements InquiryRepositoryInterface
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {}

    /* ============================================================================
     | Create a new inquiry record in the database and returns the created record.
     ==============================================================================*/
    public function create(array $data): ?Inquiry
    {
        return Inquiry::create($data);
    }
}
