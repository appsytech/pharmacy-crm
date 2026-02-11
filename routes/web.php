<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\DoctorController;
use App\Http\Controllers\Admin\MedicineListController;
use App\Http\Controllers\Admin\PatientController;
use App\Http\Controllers\Admin\ProfileController;
use Illuminate\Support\Facades\Route;





/* ====================== Dashboard > Auth  ====================== */

Route::get('login', [AuthController::class, 'login'])->name('login');
Route::post('login/proceed', [AuthController::class, 'authenticate'])->name('login.proceed');
Route::post('logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

/* ====================== Dashboard  ====================== */
Route::get('/', [DashboardController::class, 'index'])->name('dashboard')->middleware('auth');
Route::get('medicine-list', [MedicineListController::class, 'index'])->name('medicine-list.index')->middleware('auth');


/* ====================== Dashboard > Profile ====================== */
Route::get('dashboard/profile', [ProfileController::class, 'index'])->name('profile.index')->middleware('auth');
Route::get('dashboard/profile-edit', [ProfileController::class, 'edit'])->name('profile.edit')->middleware('auth');
Route::put('dashboard/profile/update', [ProfileController::class, 'update'])->name('profile.update')->middleware('auth');

/* ====================== Dashboard > Admins ====================== */
Route::get('dashboard/admin', [AdminController::class, 'index'])->name('admin.index')->middleware('auth');
Route::post('dashboard/admin/store', [AdminController::class, 'store'])->name('admin.store')->middleware('auth');
Route::delete('dashboard/admin/delete', [AdminController::class, 'delete'])->name('admin.delete')->middleware('auth');
Route::get('dashboard/admin/edit/{id}', [AdminController::class, 'edit'])->name('admin.edit')->middleware('auth');
Route::put('dashboard/admin/update', [AdminController::class, 'update'])->name('admin.update')->middleware('auth');
Route::post('dashboard/admin/status/update', [AdminController::class, 'updateStatus'])->name('admin.status.update')->middleware('auth');


/* ====================== Dashboard > Doctors ====================== */
Route::get('dashboard/doctor', [DoctorController::class, 'index'])->name('doctor.index')->middleware('auth');
Route::post('dashboard/doctor/store', [DoctorController::class, 'store'])->name('doctor.store')->middleware('auth');
Route::delete('dashboard/doctor/delete', [DoctorController::class, 'delete'])->name('doctor.delete')->middleware('auth');
Route::get('dashboard/doctor/edit/{id}', [DoctorController::class, 'edit'])->name('doctor.edit')->middleware('auth');
Route::put('dashboard/doctor/update', [DoctorController::class, 'update'])->name('doctor.update')->middleware('auth');


/* ====================== Dashboard > Patients ====================== */
Route::get('dashboard/patient', [PatientController::class, 'index'])->name('patient.index')->middleware('auth');
Route::post('dashboard/patient/store', [PatientController::class, 'store'])->name('patient.store')->middleware('auth');
Route::delete('dashboard/patient/delete', [PatientController::class, 'delete'])->name('patient.delete')->middleware('auth');
Route::get('dashboard/patient/edit/{id}', [PatientController::class, 'edit'])->name('patient.edit')->middleware('auth');
Route::put('dashboard/patient/update', [PatientController::class, 'update'])->name('patient.update')->middleware('auth');
