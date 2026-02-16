<?php

namespace App\Services\Admin;

use App\Repositories\Admin\Interfaces\AdminRepositoryInterface;
use App\Repositories\Admin\Interfaces\DoctorRepositoryInterface;
use App\Repositories\Admin\Interfaces\StaffRepositoryInterface;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ProfileService
{
    /**
     * Create a new class instance.
     */
    public function __construct(
        protected AdminRepositoryInterface $adminRepo,
        protected StaffRepositoryInterface $staffRepo,
        protected DoctorRepositoryInterface $doctorRepo,
        protected AdminService $adminService,
        protected StaffService $staffService,
        protected DoctorService $doctorService
    ) {
        //
    }


    public function updateProfile($request)
    {
        if (Auth::guard('web')->check()) {
            $validator = Validator::make($request->all(), [
                'id' => 'required|integer',
                'name' => 'required|string|max:255',
                'email' => 'required|email|max:255',
                'username' => 'nullable|string|max:100',
                'phone' => 'nullable|string',
                'password' => 'nullable|string|min:8|confirmed',
                'admin_role' => 'required|in:1,2,3',
                'status' => 'required|in:0,1',
                'profile_image' => 'nullable',
            ]);

            if ($validator->fails()) {
                return [
                    'status' => false,
                    'message' => 'Validation Fails',
                    'errors' => $validator->errors(),
                ];
            }

            $isUpdated = $this->adminService->update($request);

            return [
                'status' => true,
                'message' => 'Profile Updated Successfully',
            ];
        } elseif (Auth::guard('staffs')->check()) {
            $validator = Validator::make($request->all(), [
                'id' => 'required|integer',
                'full_name'     => 'required|string|max:50',
                'email'         => 'required|email|max:50|unique:staffs,email,' . $request->id,
                'password' => 'nullable|string|min:8|max:40|confirmed',
                'phone'         => 'nullable|string|max:20',
                'gender'        => 'required|in:MALE,FEMALE,OTHER',
                'date_of_birth' => 'nullable|date|before:today',
                'join_date'     => 'required|date',
                'role'          => 'required|string|max:100',
                'job_title'     => 'nullable|string|max:50',
                'department'    => 'nullable|string|max:100',
                'salary'        => 'nullable|numeric|min:0',
                'status'        => 'required|in:ACTIVE,INACTIVE,ONLEAVE',
                'address'       => 'nullable|string',
            ]);


            if ($validator->fails()) {
                return [
                    'status' => false,
                    'message' => 'Validation Fails',
                    'errors' => $validator->errors(),
                ];
            }

            $isUpdated = $this->staffService->update($request);

            return [
                'status' => $isUpdated ?  true : false,
                'message' => $isUpdated ? 'Profile Updated Successfully' : 'Something went wrong',
            ];
        } else {

            $validator = Validator::make($request->all(), [
                'id' => 'required|integer',
                'full_name' => 'required|string|max:150',
                'phone_number' => 'nullable|string|max:20',
                'email' => 'required|email|max:150|unique:doctors,email,' . $request->id,
                'password' => 'nullable|string|min:8|max:255|confirmed',
                'consultation_fee' => 'nullable|numeric|min:0',
                'role'          => 'required|string|max:100',
                'profile_image' => 'nullable|file',
                'speciality' => 'nullable|string|max:100',
                'department' => 'nullable|string|max:100',
                'experience' => 'nullable|integer|min:0',
                'description' => 'nullable|string',
                'status' => 'nullable|in:ACTIVE,INACTIVE,ONLEAVE',
                'position' => 'required|in:JUNIOR,SENIOR,CONSULTANT,HEAD',
                'license_number' => 'required|string|max:50|unique:doctors,license_number,' . $request->id,
                'join_date' => 'nullable|date',
                'availability' => 'nullable|string',
                'fb_profile' => 'nullable|url|max:255',
                'linkedin_profile' => 'nullable|url|max:255',
                'twitter_profile' => 'nullable|url|max:255',
                'location' => 'nullable|string|max:150',
            ]);


            if ($validator->fails()) {
                return [
                    'status' => false,
                    'message' => 'Validation Fails',
                    'errors' => $validator->errors(),
                ];
            }

            $isUpdated = $this->doctorService->update($request);

            return [
                'status' => $isUpdated ?  true : false,
                'message' => $isUpdated ? 'Profile Updated Successfully' : 'Something went wrong',
            ];
        }
    }

    public function getIndexPageData(): array
    {
        $data = [];
        $loggedInUserId =  Auth::user()->id;

        if (Auth::guard('web')->check()) {
            $data['admin'] = $this->adminRepo->find($loggedInUserId);
        } elseif (Auth::guard('staffs')->check()) {
            $data['staff'] = $this->staffRepo->find($loggedInUserId);
        } else {
            $data['doctor'] = $this->doctorRepo->find($loggedInUserId);
        }

        return $data;
    }
}
