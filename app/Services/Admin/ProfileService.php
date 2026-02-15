<?php

namespace App\Services\Admin;

use App\Repositories\Admin\Interfaces\AdminRepositoryInterface;
use App\Repositories\Admin\Interfaces\DoctorRepositoryInterface;
use App\Repositories\Admin\Interfaces\StaffRepositoryInterface;
use Illuminate\Support\Facades\Auth;

class ProfileService
{
    /**
     * Create a new class instance.
     */
    public function __construct(
        protected AdminRepositoryInterface $adminRepo,
        protected StaffRepositoryInterface $staffRepo,
        protected DoctorRepositoryInterface $doctorRepo
    ) {
        //
    }


    public function getIndexPageData(): array
    {
        $data = [];
        $loggedInUserId =  Auth::user()->id;

        if (Auth::guard('web')->check()) {
            $data['admin'] = $this->adminRepo->find($loggedInUserId);
        } elseif (Auth::guard('staff')->check()) {
            $data['staff'] = $this->staffRepo->find($loggedInUserId);
        } else {
            $data['doctor'] = $this->doctorRepo->find($loggedInUserId);
        }

        return $data;
    }
}
