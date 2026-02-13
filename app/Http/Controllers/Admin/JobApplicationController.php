<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\Admin\JobApplicationService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class JobApplicationController extends Controller
{
    public function __construct(
        protected JobApplicationService $jobApplicationService
    ) {}

    public function index(Request $request)
    {
        $request->validate([
            'status' => 'nullable|in:PENDING,REVIEWED,SHORTLISTED,REJECTED,HIRED',
        ]);

        $data = [
            'jobApplications' => $this->jobApplicationService->getJobApplications([
                'status' => $request->status ?? null,
            ]),
            'oldInputs' => $request->all(),
        ];

        return view('admin.pages.job-application.index', compact('data'));
    }

    public function edit(Request $request): View
    {
        $data = [
            'application' => $this->jobApplicationService->find((int) decrypt($request->id)),
        ];

        return view('admin.pages.job-application.edit', compact('data'));
    }

    public function update(Request $request): RedirectResponse
    {
        $request->validate([
            'id' => 'required|integer',
            'status' => 'required|in:PENDING,REVIEWED,SHORTLISTED,REJECTED,HIRED',
        ]);

        $isUpdated = $this->jobApplicationService->update($request);

        if ($isUpdated) {
            return redirect()->route('job-application.index')->with('success', 'Job Application Updated Successfully');
        } else {
            return redirect()->back()->withErrors('Something went wrong!');
        }
    }

    public function delete(Request $request): RedirectResponse
    {
        $request->validate([
            'id' => 'required|int',
        ]);

        $isDeleted = $this->jobApplicationService->delete($request->id);

        if ($isDeleted) {
            return redirect()->back()->with('success', 'Job Application Deleted Successfully');
        } else {
            return redirect()->back()->withErrors('Something went wrong!');
        }
    }
}
