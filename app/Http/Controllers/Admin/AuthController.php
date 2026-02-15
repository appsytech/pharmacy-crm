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
        if (Auth::guard('web')->check()) {
            return redirect()->intended(route('dashboard'));
        }

        if (Auth::guard('doctors')->check()) {
            return redirect()->intended(route('dashboard'));
        }

        if (Auth::guard('staffs')->check()) {
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
        $guards = ['web', 'doctors', 'staffs'];
        $redirectRoute = 'login';

        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {
                Auth::guard($guard)->logout();

                if (in_array($guard, ['doctors', 'staffs'])) {
                    $redirectRoute = 'staff.login';
                } else {
                    $redirectRoute = 'login';
                }

                break;
            }
        }

    
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route($redirectRoute);
    }
}
