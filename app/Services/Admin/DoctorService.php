<?php

namespace App\Services\Admin;

use App\Models\Doctor;
use App\Repositories\Admin\Interfaces\DoctorRepositoryInterface;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Storage;

class DoctorService
{
    /**
     * Create a new class instance.
     */
    public function __construct(
        protected DoctorRepositoryInterface $doctorRepo
    ) {}



    /* =============================================================
    | Create a new doctor record.
    ================================================================*/
    public function create($request): array
    {
        $data = [
            'full_name' => $request->full_name,
            'phone_number' => $request->phone_number ?? null,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'consultation_fee' => $request->consultation_fee,
            'speciality' => $request->speciality,
            'department' =>  $request->department,
            'experience' => $request->experience,
            'description' =>  $request->description,
            'status' =>  $request->status,
            'position' => $request->position,
            'license_number' => $request->license_number,
            'join_date' => $request->join_date,
            'fb_profile' => $request->fb_profile,
            'linkedin_profile' => $request->linkedin_profile,
            'twitter_profile' => $request->twitter_profile,
            'availability' => $request->availability,
            'location' => $request->location,
            'created_at' => Carbon::now()
        ];

        if ($request->hasFile('profile_image')) {
            $data['profile_image'] = $request->file('profile_image')->store('assets/images/doctors', 'public');
        }

        $createdDcotor = $this->doctorRepo->create($data);

        if ($createdDcotor) {
            return [
                'status' => true,
                'message' => ['Doctor Created successfully']
            ];
        }

        return [
            'status' => false,
            'message' => ['Something went wrong']
        ];
    }




    /* ============================================================================
    |   Fetch a single doctor record by its primary ID.
    ==============================================================================*/
    public function find(int $id, ?array $selectedColumns = null): ?Doctor
    {
        return $this->doctorRepo->find($id, $selectedColumns);
    }

    /* ============================================================================
    |  Fetch doctors with optional filters and selected columns.
    ==============================================================================*/
    public function getDoctors(?array $filterData = null, ?array $selectedcolumns = null): ?LengthAwarePaginator
    {
        return $this->doctorRepo->getDoctors($filterData, $selectedcolumns);
    }


    /* ============================================================================
    |  Fetch doctor Collection with optional filters and selected columns.
    ==============================================================================*/
    public function getDoctorsCollection(?array $filterData = null, ?array $selectedcolumns = null): ?Collection
    {
        return $this->doctorRepo->getDoctorsCollection($filterData, $selectedcolumns);
    }

    /* ============================================================================
    | Update an existing doctor record .
    ==============================================================================*/
    public function update($request): array
    {
        $doctorId = $request->id;
        $doctor = $this->doctorRepo->find($doctorId, ['profile_image']);

        $data = [
            'full_name' => $request->full_name,
            'phone_number' => $request->phone_number ?? null,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'consultation_fee' => $request->consultation_fee,
            'speciality' => $request->speciality,
            'department' =>  $request->department,
            'experience' => $request->experience,
            'description' =>  $request->description,
            'status' =>  $request->status,
            'position' => $request->position,
            'license_number' => $request->license_number,
            'join_date' => $request->join_date,
            'availability' => $request->availability,
            'location' => $request->location,
            'fb_profile' => $request->fb_profile,
            'linkedin_profile' => $request->linkedin_profile,
            'twitter_profile' => $request->twitter_profile,
            'updated_at' => Carbon::now(),
        ];

        if ($request->hasFile('profile_image')) {
            if (isset($doctor->profile_image) && Storage::disk('public')->exists($doctor->profile_image)) {
                Storage::disk('public')->delete($doctor->profile_image);
            }

            $data['profile_image'] = $request->file('profile_image')->store('assets/images/doctors', 'public');
        }

        if (! empty($request->password)) {
            $data['password'] = bcrypt($request->password); // Hash it before saving
        }

        $isUpdated =  $this->doctorRepo->updateColumns($doctorId, $data);

        if ($isUpdated) {
            return [
                'status' => true,
                'message' => ['Doctor Updated successfully']
            ];
        }

        return [
            'status' => false,
            'message' => ['Something went wrong']
        ];
    }



    /* ============================================================================
    | Permanently delete an doctor.
    ==============================================================================*/
    public function delete(int $id): bool
    {
        $doctor = $this->doctorRepo->find($id, ['profile_image']);

        if (! empty($doctor->profile_image) && Storage::disk('public')->exists($doctor->profile_image)) {
            Storage::disk('public')->delete($doctor->profile_image);
        }

        $isDeleted = $this->doctorRepo->delete($id);

        return $isDeleted;
    }
}
