<?php

namespace App\Services\Admin;

use App\Models\JobApplication;
use App\Repositories\Admin\Interfaces\JobApplicationRepositoryInterface;
use Carbon\Carbon;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class JobApplicationService
{
    /**
     * Create a new class instance.
     */
    public function __construct(
        protected JobApplicationRepositoryInterface $jobApplicationRepo
    ) {
        //
    }

    /* ============================================================================
    |   Fetch a single Job Application record by its primary ID.
    ==============================================================================*/
    public function find(int $id, ?array $selectedColumns = null): ?JobApplication
    {
        return $this->jobApplicationRepo->find($id, $selectedColumns);
    }

    /* ============================================================================
    |  Fetch Job Application with optional filters and selected columns.
    ==============================================================================*/
    public function getJobApplications(?array $filterData = null, ?array $selectedcolumns = null): ?LengthAwarePaginator
    {
        return $this->jobApplicationRepo->getJobApplications($filterData, $selectedcolumns);
    }

    /* ============================================================================
    | Update an existing job applicatoin record .
    ==============================================================================*/
    public function update($request): bool
    {
        $data = [
            'application_status' => $request->status ?? null,
        ];

        return $this->jobApplicationRepo->updateColumns($request->id, $data);
    }

    /* ============================================================================
    | Permanently delete an job application record.
    ==============================================================================*/
    public function delete(int $id): bool
    {
        $application = $this->jobApplicationRepo->find($id, ['profile_image', 'additional_certifications', 'resume_path', 'cover_letter']);

        if (! empty($application->profile_image) && Storage::disk('public')->exists($application->profile_image)) {
            Storage::disk('public')->delete($application->profile_image);
        }

        if (! empty($application->additional_certifications) && Storage::disk('public')->exists($application->additional_certifications)) {
            Storage::disk('public')->delete($application->additional_certifications);
        }

        if (! empty($application->resume_path) && Storage::disk('public')->exists($application->resume_path)) {
            Storage::disk('public')->delete($application->resume_path);
        }

        if (! empty($application->cover_letter) && Storage::disk('public')->exists($application->cover_letter)) {
            Storage::disk('public')->delete($application->cover_letter);
        }

        return $this->jobApplicationRepo->delete($id);
    }
}
