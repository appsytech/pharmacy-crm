<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\Admin\AdminService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function __construct(
        protected AdminService $adminService
    ) {}

    public function index()
    {
        $data = [
            'admin' => $this->adminService->find(Auth::user()->id),
        ];

        return view('admin.pages.profile.index', compact('data'));
    }

    public function edit()
    {
        $data = [
            'admin' => $this->adminService->find(Auth::user()->id),
        ];

        return view('admin.pages.profile.edit', compact('data'));
    }

    public function update(Request $request): RedirectResponse
    {
        $request->validate([
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

        $isUpdated = $this->adminService->update($request);

        if ($isUpdated) {
            return redirect()->route('profile.index')->with('success', 'Profile Updated Successfully');
        } else {
            return redirect()->back()->withErrors('Something went wrong!');
        }
    }
}
