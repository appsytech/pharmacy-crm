<?php

namespace App\Services\Admin;

use App\Models\StaffSalary;
use App\Repositories\Admin\Interfaces\LogMoneyRepositoryInterface;
use App\Repositories\Admin\Interfaces\StaffRepositoryInterface;
use App\Repositories\Admin\Interfaces\StaffSalaryRepositoryInterface;
use Carbon\Carbon;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Auth;

class StaffSalaryService
{
    /**
     * Create a new class instance.
     */
    public function __construct(
        protected StaffSalaryRepositoryInterface $staffSalaryRepo,
        protected StaffRepositoryInterface $staffRepo,
        // protected LogMoneyRepositoryInterface $logMoneyRepo
    ) {
        //
    }

    /* =============================================================
     | Create a new staff salary record.
    ================================================================*/
    public function create($request): ?StaffSalary
    {
        $staffId = (int) $request->staff_id;
        $staffName = $this->staffRepo->find($staffId, ['full_name'])->full_name;

        $previousRemaining = $this->findLatestByStaffId($staffId, ['remaining_amount'])?->remaining_amount ?? 0;

        $baseSalary = (float) $request->base_salary ?? 0;
        $bonus = (float) $request->bonuses ?? 0;
        $taxPercentage = (float) $request->tax_percentage ?? 0;
        $paidAmount = (float) $request->paid_amount ?? 0;
        $advanceAmount = (float) $request->advances ?? 0;

        $taxableAmount = $baseSalary + $bonus;
        $taxAmount = ($taxableAmount * $taxPercentage) / 100;
        $totalAmount = $taxableAmount - $taxAmount - $advanceAmount;
        $remainingAmount = $previousRemaining + $totalAmount - $paidAmount;

        $status = match (true) {
            $paidAmount <= 0 && $advanceAmount <= 0 => 'UNPAID',
            $remainingAmount <= 0 => 'PAID',
            ($paidAmount > 0 && $remainingAmount > 0) || $advanceAmount > 0 => 'PARTIALLY PAID',
        };

        $data = [
            'staff_id' => $staffId,
            'staff_name' => $staffName,
            'academic_year' => $request->academic_year,
            'month' => $request->month,
            'base_salary' => $baseSalary,
            'bonuses' => $bonus ?? null,
            'tax_percentage' => $taxPercentage ?? null,
            'tax_amount' => $taxAmount ?? null,
            'advances' => $advanceAmount ?? null,
            'total_salary' => $totalAmount ?? null,
            'paid_amount' => $paidAmount ?? null,
            'remaining_amount' => $remainingAmount,
            'status' => $status,
            'payment_date' => $request->payment_date,
            'created_by' => Auth::user()->name,
            'created_at' => Carbon::now(),
        ];

        $createdSalary = $this->staffSalaryRepo->create($data);

        if ($createdSalary) {
            // $this->logMoneyRepo->create([
            //     'type' => 'EXPENSE',
            //     'method_type' => 'TEACHER-SALARY',
            //     'amount' => $paidAmount,
            //     'payment_method' => 'CASH',
            //     'user_id' => $staffId,
            //     'description' => "Paid amount {$paidAmount} to {$teacherName}",
            //     'transaction_date' => $request->payment_date ?? Carbon::now(),
            //     'created_by' => Auth::user()->name,
            //     'created_at' => Carbon::now(),
            // ]);
        }

        return $createdSalary;
    }

    /* ============================================================================
    |   Fetch a single staff salary record by its primary ID.
    ==============================================================================*/
    public function find(int $id, ?array $selectedColumns = null): ?StaffSalary
    {
        return $this->staffSalaryRepo->find($id, $selectedColumns);
    }

    /* ============================================================================
    |   Fetch a latest staff payment record by staff ID.
    ==============================================================================*/
    public function findLatestByStaffId(int $staffId, ?array $selectedColumns = null): ?StaffSalary
    {
        return $this->staffSalaryRepo->findLatestByStaffId($staffId, $selectedColumns);
    }

    /* ============================================================================
    |  Fetch Staff salaries with optional filters and selected columns.
    ==============================================================================*/
    public function getStaffSalaries(?array $filterData = null, ?array $selectedcolumns = null): ?LengthAwarePaginator
    {
        return $this->staffSalaryRepo->getStaffSalaries($filterData, $selectedcolumns);
    }

    /* ============================================================================
    | Update an existing Staff salary record .
    ==============================================================================*/
    public function update($request): bool
    {
        $salaryId = $request->id;

        $staffId = (int) $request->staff_id;
        $staffName = $this->staffRepo->find($staffId, ['full_name'])?->full_name;

        $baseSalary = (float) $request->base_salary ?? 0;
        $bonus = (float) $request->bonuses ?? 0;
        $taxPercentage = (float) $request->tax_percentage ?? 0;
        $paidAmount = (float) $request->paid_amount ?? 0;
        $advanceAmount = (float) $request->advances ?? 0;

        $taxableAmount = $baseSalary + $bonus;
        $taxAmount = ($taxableAmount * $taxPercentage) / 100;
        $totalAmount = $taxableAmount - $taxAmount - $advanceAmount;
        $remainingAmount = $request->remaining_amount;

        $status = match (true) {
            $paidAmount <= 0 && $advanceAmount <= 0 => 'UNPAID',
            $remainingAmount <= 0 => 'PAID',
            ($paidAmount > 0 && $remainingAmount > 0) || $advanceAmount > 0 => 'PARTIALLY PAID',
        };

        $data = [
            'staff_id' => $staffId,
            'staff_name' => $staffName,
            'academic_year' => $request->academic_year,
            'month' => $request->month,
            'base_salary' => $baseSalary,
            'bonuses' => $bonus ?? null,
            'tax_percentage' => $taxPercentage ?? null,
            'tax_amount' => $taxAmount ?? null,
            'advances' => $advanceAmount ?? null,
            'total_salary' => $totalAmount ?? null,
            'paid_amount' => $paidAmount ?? null,
            'remaining_amount' => $remainingAmount,
            'status' => $status,
            'payment_date' => $request->payment_date,
            'updated_by' => Auth::user()->name,
            'updated_at' => Carbon::now(),
        ];

        return $this->staffSalaryRepo->updateColumns($salaryId, $data);
    }

    /* ============================================================================
    | Permanently delete an Staff salary record.
    ==============================================================================*/
    public function delete(int $id): bool
    {
        return $this->staffSalaryRepo->delete($id);
    }
}
