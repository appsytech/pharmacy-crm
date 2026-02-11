<?php

namespace App\Providers;

use App\Repositories\Admin\AdminRepository;
use App\Repositories\Admin\DoctorRepository;
use App\Repositories\Admin\Interfaces\AdminRepositoryInterface;
use App\Repositories\Admin\Interfaces\DoctorRepositoryInterface;
use App\Repositories\Admin\Interfaces\PatientRepositoryInterface;
use App\Repositories\Admin\PatientRepository;
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
            PatientRepositoryInterface::class => PatientRepository::class
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
