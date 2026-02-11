<?php

namespace App\Services\Admin;

use App\Repositories\Admin\Interfaces\AdminRepositoryInterface;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class AuthService
{
    /**
     * Create a new class instance.
     */
    public function __construct(
        protected AdminRepositoryInterface $adminRepo
    ) {}



    public function authenticate($request): array
    {
        $credential = $request->credential;

        $admin = $this->adminRepo->findByCredential($credential, ['id', 'email']);

        if (! $admin) {
            return [
                'status' => false,
                'message' => 'You are not admin',
            ];
        }


        if (Auth::attempt(['email' => $admin->email, 'password' => $request->password])) {
            $admin->update([
                'last_login_at' => Carbon::now(),
            ]);

            return [
                'status' => true,
                'message' => 'Welcome to the dashboard',
            ];
        }

        return [
            'status' => false,
            'message' => 'Please recheck your credentials',

        ];
    }
}
