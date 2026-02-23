<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\Admin\PatientAuthService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PatientAuthController extends Controller
{

    public function __construct(
        protected PatientAuthService $patientAuthService
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

        if (Auth::guard('patients')->check()) {
            return redirect()->intended(route('dashboard'));
        }

        return view('admin.pages.auth.patient.login');
    }



    public function authenticate(Request $request): RedirectResponse
    {
        $request->validate([
            'credential' => 'required|string|max:255',
            'password' => 'required|string|min:8|max:40',
        ]);

        $authenticationResponse = $this->patientAuthService->authenticate($request);

        if ($authenticationResponse['status']) {
            return redirect()->intended(route('dashboard'))->with('success', $authenticationResponse['message']);
        } else {
            return redirect()->back()->withErrors($authenticationResponse['message']);
        }
    }
}
