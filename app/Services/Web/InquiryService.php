<?php

namespace App\Services\Web;

use App\Models\Inquiry;
use App\Repositories\Web\Interfaces\InquiryRepositoryInterface;
use Carbon\Carbon;

class InquiryService
{
    /**
     * Create a new class instance.
     */
    public function __construct(
        protected InquiryRepositoryInterface $inquiryRepo
    ) {}

    public function create($request): ?Inquiry
    {
        $data = [
            'fullName' => $request->full_name,
            'email' => $request->email,
            'phoneNumber' => $request->phone_number ?? null,
            'subject' => $request->subject ?? null,
            'message' => $request->message,
            'status' => 'NEW',
            'created_at' => Carbon::now(),
        ];

        return $this->inquiryRepo->create($data);
    }
}
