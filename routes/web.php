<?php

use App\Http\Controllers\Admin\ActivityController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\DoctorController;
use App\Http\Controllers\Admin\ExpenseController;
use App\Http\Controllers\Admin\ExpenseTypeController;
use App\Http\Controllers\Admin\HomeSliderController;
use App\Http\Controllers\Admin\JobApplicationController;
use App\Http\Controllers\Admin\ManufacturerController;
use App\Http\Controllers\Admin\MedicineController;
use App\Http\Controllers\Admin\MedicineListController;
use App\Http\Controllers\Admin\PatientAppoinmentController;
use App\Http\Controllers\Admin\PatientController;
use App\Http\Controllers\Admin\PatientReportController;
use App\Http\Controllers\Admin\StaffAuthController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\StaffController;
use App\Http\Controllers\Admin\StaffSalaryController;
use App\Http\Controllers\Admin\SupplierController;
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



/* ====================== Dashboard > Patient Report ====================== */
Route::get('dashboard/patient-report', [PatientReportController::class, 'index'])->name('patient-report.index')->middleware('auth');
Route::post('dashboard/patient-report/store', [PatientReportController::class, 'store'])->name('patient-report.store')->middleware('auth');
Route::delete('dashboard/patient-report/delete', [PatientReportController::class, 'delete'])->name('patient-report.delete')->middleware('auth');
Route::get('dashboard/patient-report/edit/{id}', [PatientReportController::class, 'edit'])->name('patient-report.edit')->middleware('auth');
Route::put('dashboard/patient-report/update', [PatientReportController::class, 'update'])->name('patient-report.update')->middleware('auth');



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


/* ====================== Dashboard > Expense Type ====================== */
Route::get('dashboard/expense-type', [ExpenseTypeController::class, 'index'])->name('expense-type.index')->middleware('auth');
Route::post('dashboard/expense-type/store', [ExpenseTypeController::class, 'store'])->name('expense-type.store')->middleware('auth');
Route::delete('dashboard/expense-type/delete', [ExpenseTypeController::class, 'delete'])->name('expense-type.delete')->middleware('auth');


/* ====================== Dashboard > Expense ====================== */
Route::get('dashboard/expense', [ExpenseController::class, 'index'])->name('expense.index')->middleware('auth');
Route::post('dashboard/expense/store', [ExpenseController::class, 'store'])->name('expense.store')->middleware('auth');
Route::get('dashboard/expense/edit/{id}', [ExpenseController::class, 'edit'])->name('expense.edit')->middleware('auth');
Route::put('dashboard/expense/update', [ExpenseController::class, 'update'])->name('expense.update')->middleware('auth');


/* ====================== Dashboard > Homepage Slider ====================== */
Route::get('dashboard/homepage-slider', [HomeSliderController::class, 'index'])->name('homepage-slider.index')->middleware('auth');
Route::post('dashboard/homepage-slider/store', [HomeSliderController::class, 'store'])->name('homepage-slider.store')->middleware('auth');
Route::delete('dashboard/homepage-slider/delete', [HomeSliderController::class, 'delete'])->name('homepage-slider.delete')->middleware('auth');
Route::get('dashboard/homepage-slider/edit/{id}', [HomeSliderController::class, 'edit'])->name('homepage-slider.edit')->middleware('auth');
Route::put('dashboard/homepage-slider/update', [HomeSliderController::class, 'update'])->name('homepage-slider.update')->middleware('auth');
Route::post('dashboard/homepage-slider/status/update', [HomeSliderController::class, 'updateStatus'])->name('homepage-slider.status.update')->middleware('auth');


/* ====================== Dashboard > staff Salary====================== */
Route::get('dashboard/staff-salary', [StaffSalaryController::class, 'index'])->name('staff-salary.index')->middleware('auth');
Route::post('dashboard/staff-salary/store', [StaffSalaryController::class, 'store'])->name('staff-salary.store')->middleware('auth');
Route::get('dashboard/staff-salary/edit/{id}', [StaffSalaryController::class, 'edit'])->name('staff-salary.edit')->middleware('auth');
Route::put('dashboard/staff-salary/update', [StaffSalaryController::class, 'update'])->name('staff-salary.update')->middleware('auth');
Route::delete('dashboard/staff-salary/delete', [StaffSalaryController::class, 'delete'])->name('staff-salary.delete')->middleware('auth');
Route::post('dashboard/staff-salary/amounts', [StaffSalaryController::class, 'getStaffAmountsById'])->name('staff-salary.get-amounts')->middleware('auth');


/* ====================== Dashboard > Supplier ====================== */
Route::get('dashboard/supplier', [SupplierController::class, 'index'])->name('supplier.index')->middleware('auth');
Route::post('dashboard/supplier/store', [SupplierController::class, 'store'])->name('supplier.store')->middleware('auth');
Route::delete('dashboard/supplier/delete', [SupplierController::class, 'delete'])->name('supplier.delete')->middleware('auth');
Route::get('dashboard/supplier/edit/{id}', [SupplierController::class, 'edit'])->name('supplier.edit')->middleware('auth');
Route::put('dashboard/supplier/update', [SupplierController::class, 'update'])->name('supplier.update')->middleware('auth');


/* ====================== Dashboard > Manufacturer ====================== */
Route::get('dashboard/manufacturer', [ManufacturerController::class, 'index'])->name('manufacturer.index')->middleware('auth');
Route::post('dashboard/manufacturer/store', [ManufacturerController::class, 'store'])->name('manufacturer.store')->middleware('auth');
Route::delete('dashboard/manufacturer/delete', [ManufacturerController::class, 'delete'])->name('manufacturer.delete')->middleware('auth');
Route::get('dashboard/manufacturer/edit/{id}', [ManufacturerController::class, 'edit'])->name('manufacturer.edit')->middleware('auth');
Route::put('dashboard/manufacturer/update', [ManufacturerController::class, 'update'])->name('manufacturer.update')->middleware('auth');


/* ====================== Dashboard > Medicine ====================== */
Route::get('dashboard/medicine', [MedicineController::class, 'index'])->name('medicine.index')->middleware('auth');
Route::post('dashboard/medicine/store', [MedicineController::class, 'store'])->name('medicine.store')->middleware('auth');
Route::delete('dashboard/medicine/delete', [MedicineController::class, 'delete'])->name('medicine.delete')->middleware('auth');
Route::get('dashboard/medicine/edit/{id}', [MedicineController::class, 'edit'])->name('medicine.edit')->middleware('auth');
Route::put('dashboard/medicine/update', [MedicineController::class, 'update'])->name('medicine.update')->middleware('auth');
