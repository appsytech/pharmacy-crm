<?php

namespace App\Providers;

use App\Repositories\Admin\ActivityRepository;
use App\Repositories\Admin\AdminRepository;
use App\Repositories\Admin\DoctorRepository;
use App\Repositories\Admin\Interfaces\ActivityRepositoryInterface;
use App\Repositories\Admin\Interfaces\AdminRepositoryInterface;
use App\Repositories\Admin\Interfaces\DoctorRepositoryInterface;
use App\Repositories\Admin\Interfaces\JobApplicationRepositoryInterface;
use App\Repositories\Admin\Interfaces\PatientAppoinmentRepositoryInterface;
use App\Repositories\Admin\Interfaces\PatientRepositoryInterface;
use App\Repositories\Admin\Interfaces\StaffRepositoryInterface;
use App\Repositories\Admin\JobApplicationRepository;
use App\Repositories\Admin\PatientAppoinmentRepository;
use App\Repositories\Admin\PatientRepository;
use App\Repositories\Admin\StaffRepository;
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
            JobApplicationRepositoryInterface::class => JobApplicationRepository::class
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
