<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\Admin\AdminService;
use App\Services\Admin\ProfileService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function __construct(
        protected AdminService $adminService,
        protected ProfileService $profileService
    ) {}

    public function index()
    {
        $data = $this->profileService->getIndexPageData();

        return view('admin.pages.profile.index', compact('data'));
    }

    public function edit()
    {
        $data = $this->profileService->getIndexPageData();

        return view('admin.pages.profile.edit', compact('data'));
    }

    public function update(Request $request): RedirectResponse
    {
        $response = $this->profileService->updateProfile($request);

        if ($response['status']) {
            return redirect()->route('profile.index')->with('success', $response['message']);
        } else {
            return redirect()->back()->withErrors($response['errors']);
        }
    }
}
