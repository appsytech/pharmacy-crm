<?php

namespace App\Services\Admin;

use Illuminate\Support\Facades\Auth;

class PatientAuthService
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }



    public function authenticate($request): array
    {
        $credential = $request->credential;
        $password   = $request->password;
        $guard = 'patients';

        if (Auth::guard($guard)->attempt([
            'email' => $credential,
            'password' => $password,
        ])) {
            return [
                'status' => true,
                'message' => 'Welcome to dashboard',
            ];
        }

        return [
            'status' => false,
            'message' => 'Please recheck your credentials',

        ];
    }
}
