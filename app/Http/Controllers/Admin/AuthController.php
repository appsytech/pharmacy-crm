<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\Admin\AuthService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{

    public function __construct(
        protected AuthService $authService
    ) {}


    public function login()
    {
        if (Auth::check()) {
            return redirect()->intended(route('dashboard'));
        }

        return view('admin.pages.auth.login');
    }

    public function authenticate(Request $request): RedirectResponse
    {
        $request->validate([
            'credential' => 'required|string|max:255',
            'password' => 'required|string|min:8|max:40',
        ]);

        $authenticationResponse = $this->authService->authenticate($request);

        if ($authenticationResponse['status']) {
            return redirect()->intended(route('dashboard'))->with('success', $authenticationResponse['message']);
        } else {
            return redirect()->back()->withErrors($authenticationResponse['message']);
        }
    }

    public function logout(Request $request)
    {

        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
