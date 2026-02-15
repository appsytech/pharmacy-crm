<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\Admin\StaffAuthService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StaffAuthController extends Controller
{
    public function __construct(
        protected StaffAuthService $staffAuthService
    ) {}


    public function login()
    {

        if (Auth::guard('web')->check()) {
            return redirect()->intended(route('dashboard'));
        }

        if (Auth::guard('doctors')->check()) {
            return redirect()->intended(route('dashboard'));
        }

        if (Auth::guard('staffs')->check()) {
            return redirect()->intended(route('dashboard'));
        }

        return view('admin.pages.auth.staff.login');
    }



    public function authenticate(Request $request): RedirectResponse
    {
        $request->validate([
            'role' => 'required|in:doctor,staff',
            'credential' => 'required|string|max:255',
            'password' => 'required|string|min:8|max:40',
        ]);

        $authenticationResponse = $this->staffAuthService->authenticate($request);

        if ($authenticationResponse['status']) {
            return redirect()->intended(route('dashboard'))->with('success', $authenticationResponse['message']);
        } else {
            return redirect()->back()->withErrors($authenticationResponse['message']);
        }
    }
}
