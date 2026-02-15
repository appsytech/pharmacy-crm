<?php

namespace App\Providers;

use App\Repositories\Admin\ActivityRepository;
use App\Repositories\Admin\AdminRepository;
use App\Repositories\Admin\DoctorRepository;
use App\Repositories\Admin\ExpenseRepository;
use App\Repositories\Admin\ExpenseTypeRepository;
use App\Repositories\Admin\HomeSliderRepository;
use App\Repositories\Admin\Interfaces\ActivityRepositoryInterface;
use App\Repositories\Admin\Interfaces\AdminRepositoryInterface;
use App\Repositories\Admin\Interfaces\DoctorRepositoryInterface;
use App\Repositories\Admin\Interfaces\ExpenseRepositoryInterface;
use App\Repositories\Admin\Interfaces\ExpenseTypeRepositoryInterface;
use App\Repositories\Admin\Interfaces\HomeSliderRepositoryInterface;
use App\Repositories\Admin\Interfaces\JobApplicationRepositoryInterface;
use App\Repositories\Admin\Interfaces\ManufacturerRepositoryInterface;
use App\Repositories\Admin\Interfaces\MedicineRepositoryInterface;
use App\Repositories\Admin\Interfaces\PatientAppoinmentRepositoryInterface;
use App\Repositories\Admin\Interfaces\PatientReportRepositoryInterface;
use App\Repositories\Admin\Interfaces\PatientRepositoryInterface;
use App\Repositories\Admin\Interfaces\PharmacyBranchRepositoryInterface;
use App\Repositories\Admin\Interfaces\StaffRepositoryInterface;
use App\Repositories\Admin\Interfaces\StaffSalaryRepositoryInterface;
use App\Repositories\Admin\Interfaces\SupplierPaymentRepositoryInterface;
use App\Repositories\Admin\Interfaces\SupplierRepositoryInterface;
use App\Repositories\Admin\JobApplicationRepository;
use App\Repositories\Admin\ManufacturerRepository;
use App\Repositories\Admin\MedicineRepository;
use App\Repositories\Admin\PatientAppoinmentRepository;
use App\Repositories\Admin\PatientReportRepository;
use App\Repositories\Admin\PatientRepository;
use App\Repositories\Admin\PharmacyBranchRepository;
use App\Repositories\Admin\StaffRepository;
use App\Repositories\Admin\StaffSalaryRepository;
use App\Repositories\Admin\SupplierPaymentRepository;
use App\Repositories\Admin\SupplierRepository;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $bindings = [

            /* ============ Admins bindings ============ */
            AdminRepositoryInterface::class => AdminRepository::class,
            DoctorRepositoryInterface::class => DoctorRepository::class,
            PatientRepositoryInterface::class => PatientRepository::class,
            StaffRepositoryInterface::class => StaffRepository::class,
            ActivityRepositoryInterface::class => ActivityRepository::class,
            PatientAppoinmentRepositoryInterface::class => PatientAppoinmentRepository::class,
            JobApplicationRepositoryInterface::class => JobApplicationRepository::class,
            ExpenseTypeRepositoryInterface::class => ExpenseTypeRepository::class,
            ExpenseRepositoryInterface::class => ExpenseRepository::class,
            HomeSliderRepositoryInterface::class => HomeSliderRepository::class,
            StaffSalaryRepositoryInterface::class => StaffSalaryRepository::class,
            SupplierRepositoryInterface::class => SupplierRepository::class,
            ManufacturerRepositoryInterface::class => ManufacturerRepository::class,
            MedicineRepositoryInterface::class => MedicineRepository::class,
            PatientReportRepositoryInterface::class => PatientReportRepository::class,
            PharmacyBranchRepositoryInterface::class => PharmacyBranchRepository::class,
            SupplierPaymentRepositoryInterface::class => SupplierPaymentRepository::class
        ];

        foreach ($bindings as $interface => $repository) {
            $this->app->bind($interface, $repository);
        }
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Schema::defaultStringLength(191);
    }
}
