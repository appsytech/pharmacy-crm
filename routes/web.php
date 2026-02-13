<?php

use App\Http\Controllers\Admin\ActivityController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\DoctorController;
use App\Http\Controllers\Admin\JobApplicationController;
use App\Http\Controllers\Admin\MedicineListController;
use App\Http\Controllers\Admin\PatientAppoinmentController;
use App\Http\Controllers\Admin\PatientController;
use App\Http\Controllers\Admin\StaffAuthController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\StaffController;
use Illuminate\Support\Facades\Route;



/* ====================== Dashboard > Auth  ====================== */

Route::get('login', [AuthController::class, 'login'])->name('login');
Route::post('login/proceed', [AuthController::class, 'authenticate'])->name('login.proceed');
Route::post('logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

/* ====================== Dashboard > Portal Auth  ====================== */
Route::get('staff/login', [StaffAuthController::class, 'login'])->name('staff.login');
Route::post('staff/login/proceed', [StaffAuthController::class, 'authenticate'])->name('staff.login.proceed');

/* ====================== Dashboard  ====================== */
Route::get('/', [DashboardController::class, 'index'])->name('dashboard')->middleware(['auth']);
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


/* ====================== Dashboard > Activity====================== */
Route::get('dashboard/activity', [ActivityController::class, 'index'])->name('activity.index')->middleware('auth');
Route::get('dashboard/activity/edit/{id}', [ActivityController::class, 'edit'])->name('activity.edit')->middleware('auth');
Route::put('dashboard/activity/update', [ActivityController::class, 'update'])->name('activity.update')->middleware('auth');
Route::post('dashboard/activity/store', [ActivityController::class, 'store'])->name('activity.store')->middleware('auth');
Route::delete('dashboard/activity/delete', [ActivityController::class, 'delete'])->name('activity.delete')->middleware('auth');
Route::post('dashboard/activity/status/update', [ActivityController::class, 'updateStatus'])->name('activity.status.update')->middleware('auth');


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



/* ====================== Dashboard > Patient Appoinment ====================== */
Route::get('dashboard/patient-appointment', [PatientAppoinmentController::class, 'index'])->name('patient-appointment.index')->middleware('auth');
Route::post('dashboard/patient-appointment/store', [PatientAppoinmentController::class, 'store'])->name('patient-appointment.store')->middleware('auth');
Route::delete('dashboard/patient-appointment/delete', [PatientAppoinmentController::class, 'delete'])->name('patient-appointment.delete')->middleware('auth');
Route::get('dashboard/patient-appointment/edit/{id}', [PatientAppoinmentController::class, 'edit'])->name('patient-appointment.edit')->middleware('auth');
Route::put('dashboard/patient-appointment/update', [PatientAppoinmentController::class, 'update'])->name('patient-appointment.update')->middleware('auth');
Route::post('dashboard/patient-appointment/status/update', [PatientAppoinmentController::class, 'updateStatus'])->name('patient-appointment.status.update')->middleware('auth');


/* ====================== Dashboard > Staffs ====================== */
Route::get('dashboard/staff', [StaffController::class, 'index'])->name('staff.index')->middleware('auth');
Route::post('dashboard/staff/store', [StaffController::class, 'store'])->name('staff.store')->middleware('auth');
Route::delete('dashboard/staff/delete', [StaffController::class, 'delete'])->name('staff.delete')->middleware('auth');
Route::get('dashboard/staff/edit/{id}', [StaffController::class, 'edit'])->name('staff.edit')->middleware('auth');
Route::put('dashboard/staff/update', [StaffController::class, 'update'])->name('staff.update')->middleware('auth');



/* ====================== Dashboard > Job Applications====================== */
Route::get('dashboard/job-application', [JobApplicationController::class, 'index'])->name('job-application.index')->middleware('auth');
Route::delete('dashboard/job-application/delete', [JobApplicationController::class, 'delete'])->name('job-application.delete')->middleware('auth');
Route::get('dashboard/job-application/respond/{id}', [JobApplicationController::class, 'edit'])->name('job-application.edit')->middleware('auth');
Route::put('dashboard/job-application/update', [JobApplicationController::class, 'update'])->name('job-application.update')->middleware('auth');
