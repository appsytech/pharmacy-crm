<?php

namespace App\Services\Admin;

use App\Models\Admin;
use App\Repositories\Admin\Interfaces\AdminRepositoryInterface;
use Carbon\Carbon;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Storage;

class AdminService
{
    /**
     * Create a new class instance.
     */
    public function __construct(
        protected AdminRepositoryInterface $adminRepo
    ) {
        //
    }




    /* =============================================================
    | Create a new admin record.
    ================================================================*/
    public function create($request): array
    {
        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'username' => $request->username ?? null,
            'phone' => $request->phone ?? null,
            'password' => bcrypt($request->password),
            'admin_role' => $request->admin_role ?? null,
            'status' => $request->status ?? null,
        ];

        if ($request->hasFile('profile_image')) {
            $data['profile_image'] = $request->file('profile_image')->store('assets/images/admins', 'public');
        }

        $createdAdmin = $this->adminRepo->create($data);

        if ($createdAdmin) {
            return [
                'status' => true,
                'message' => ['Admin Created successfully']
            ];
        }


        return [
            'status' => false,
            'message' => ['Something went wrong']
        ];
    }

    /* ============================================================================
    |   Fetch a single admin record by its primary ID.
    ==============================================================================*/
    public function find(int $id, ?array $selectedColumns = null): ?Admin
    {
        return $this->adminRepo->find($id, $selectedColumns);
    }

    /* ============================================================================
    |  Fetch admins with optional filters and selected columns.
    ==============================================================================*/
    public function getAdmins(?array $filterData = null, ?array $selectedcolumns = null): ?LengthAwarePaginator
    {
        return $this->adminRepo->getAdmins($filterData, $selectedcolumns);
    }

    /* ============================================================================
    | Update an existing admin record .
    ==============================================================================*/
    public function update($request): array
    {
        $adminId = $request->id;
        $admin = $this->adminRepo->find($adminId, ['profile_image']);

        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'username' => $request->username ?? null,
            'phone' => $request->phone ?? null,
            'admin_role' => $request->admin_role ?? null,
            'status' => $request->status ?? null,
            'updated_at' => Carbon::now(),
        ];

        if ($request->hasFile('profile_image')) {
            if (isset($admin->profile_image) && Storage::disk('public')->exists($admin->profile_image)) {
                Storage::disk('public')->delete($admin->profile_image);
            }
            $data['profile_image'] = $request->file('profile_image')->store('assets/images/admins', 'public');
        }

        if (! empty($request->password)) {
            $data['password'] = bcrypt($request->password); // Hash it before saving
        }

        $isUpdated =  $this->adminRepo->updateColumns($adminId, $data);

        if ($isUpdated) {
            return [
                'status' => true,
                'message' => ['Admin Updated successfully']
            ];
        }

        return [
            'status' => false,
            'message' => ['Something went wrong']
        ];
    }

    /* ============================================================================
    | Toggle admin status.
    ==============================================================================*/
    public function updateStatus(int $id): bool
    {
        $admin = $this->adminRepo->find($id, ['id', 'status']);

        if (! $admin) {
            return false;
        }

        return $this->adminRepo->updateColumns($id, [
            'status' => ! $admin->status,
        ]);
    }

    /* ============================================================================
    | Permanently delete an admin.
    ==============================================================================*/
    public function delete(int $id): bool
    {
        $admin = $this->adminRepo->find($id, ['profile_image']);

        if (! empty($admin->profile_image) && Storage::disk('public')->exists($admin->profile_image)) {
            Storage::disk('public')->delete($admin->profile_image);
        }

        $isDeleted = $this->adminRepo->delete($id);

        return $isDeleted;
    }
}
