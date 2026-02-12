<?php

namespace App\Services\Admin;

use App\Repositories\Admin\Interfaces\DoctorRepositoryInterface;
use App\Repositories\Admin\Interfaces\StaffRepositoryInterface;
use Illuminate\Support\Facades\Auth;

class StaffAuthService
{
    /**
     * Create a new class instance.
     */
    public function __construct(
        protected DoctorRepositoryInterface $doctorRepo,
        protected StaffRepositoryInterface $staffRepo
    ) {}



    public function authenticate($request): array
    {
        $credential = $request->credential;
        $password   = $request->password;
        $role = $request->role;

        $role = strtoupper($request->role);

        $guard = $this->resolveGuard($role);

        if (! $guard) {
            return [
                'status' => false,
                'message' => 'Invalid role selected',
            ];
        }

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


    private function resolveGuard(string $role): ?string
    {
        return match ($role) {
            'DOCTOR' => 'doctors',
            'STAFF'  => 'staffs',
            default  => null,
        };
    }
}
