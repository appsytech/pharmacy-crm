<?php

use App\Http\Controllers\Admin\ActivityCategoryController;
use App\Http\Controllers\Admin\ActivityController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\AwardController;
use App\Http\Controllers\Admin\CheckupProcessController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\DoctorController;
use App\Http\Controllers\Admin\ExpenseController;
use App\Http\Controllers\Admin\ExpenseTypeController;
use App\Http\Controllers\Admin\FaqController;
use App\Http\Controllers\Admin\GalleryController;
use App\Http\Controllers\Admin\HomeSliderController;
use App\Http\Controllers\Admin\InquiryController;
use App\Http\Controllers\Admin\JobApplicationController;
use App\Http\Controllers\Admin\LogMoneyController;
use App\Http\Controllers\Admin\ManufacturerController;
use App\Http\Controllers\Admin\MedicineController;
use App\Http\Controllers\Admin\MedicineListController;
use App\Http\Controllers\Admin\PatientAppoinmentController;
use App\Http\Controllers\Admin\PatientAuthController;
use App\Http\Controllers\Admin\PatientController;
use App\Http\Controllers\Admin\PatientReportController;
use App\Http\Controllers\Admin\PharmacyBranchController;
use App\Http\Controllers\Admin\PharmacyScheduleController;
use App\Http\Controllers\Admin\PharmacyStatisticController;
use App\Http\Controllers\Admin\StaffAuthController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\ServiceCategoryController;
use App\Http\Controllers\Admin\ServiceController as AdminServiceController;
use App\Http\Controllers\Admin\StaffController;
use App\Http\Controllers\Admin\StaffSalaryController;
use App\Http\Controllers\Admin\SupplierController;
use App\Http\Controllers\Admin\SupplierPaymentController;
use App\Http\Controllers\Admin\TestimonialController;
use App\Http\Controllers\Web\ActivityController as WebActivityController;
use App\Http\Controllers\Web\AppointmentController;
use App\Http\Controllers\Web\BlogController;
use App\Http\Controllers\web\InquiryController as WebInquiryController;
use App\Http\Controllers\Web\PageController;
use App\Http\Controllers\Web\ServiceController;
use App\Http\Controllers\Web\TeamController;
use Illuminate\Support\Facades\Route;



/* ====================== Dashboard > Auth  ====================== */

Route::get('login', [AuthController::class, 'login'])->name('login');
Route::post('login/proceed', [AuthController::class, 'authenticate'])->name('login.proceed');
Route::post('logout', [AuthController::class, 'logout'])->name('logout')->middleware(['multiAuth:web,doctors,staffs,patients']);

/* ====================== Dashboard > Staff Auth  ====================== */
Route::get('staff/login', [StaffAuthController::class, 'login'])->name('staff.login');
Route::post('staff/login/proceed', [StaffAuthController::class, 'authenticate'])->name('staff.login.proceed');

/* ====================== Dashboard > Patient Auth  ====================== */
Route::get('patient/login', [PatientAuthController::class, 'login'])->name('patient.login');
Route::post('patient/login/proceed', [PatientAuthController::class, 'authenticate'])->name('patient.login.proceed');

/* ====================== Dashboard  ====================== */
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard')->middleware(['multiAuth:web,doctors,staffs,patients']);
Route::get('medicine-list', [MedicineListController::class, 'index'])->name('medicine-list.index')->middleware('auth');


/* ====================== Dashboard > Profile ====================== */
Route::get('dashboard/profile', [ProfileController::class, 'index'])->name('profile.index')->middleware(['multiAuth:web,doctors,staffs,patients']);
Route::get('dashboard/profile-edit', [ProfileController::class, 'edit'])->name('profile.edit')->middleware(['multiAuth:web,doctors,staffs,patients']);
Route::put('dashboard/profile/update', [ProfileController::class, 'update'])->name('profile.update')->middleware(['multiAuth:web,doctors,staffs,patients']);

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
Route::get('dashboard/doctor', [DoctorController::class, 'index'])->name('doctor.index')->middleware(['multiAuth:web,staffs']);
Route::post('dashboard/doctor/store', [DoctorController::class, 'store'])->name('doctor.store')->middleware(['multiAuth:web,staffs']);
Route::delete('dashboard/doctor/delete', [DoctorController::class, 'delete'])->name('doctor.delete')->middleware(['multiAuth:web,staffs']);
Route::get('dashboard/doctor/edit/{id}', [DoctorController::class, 'edit'])->name('doctor.edit')->middleware(['multiAuth:web,staffs']);
Route::put('dashboard/doctor/update', [DoctorController::class, 'update'])->name('doctor.update')->middleware(['multiAuth:web,staffs']);


/* ====================== Dashboard > Patients ====================== */
Route::get('dashboard/patient', [PatientController::class, 'index'])->name('patient.index')->middleware(['multiAuth:web,doctors,staffs']);
Route::post('dashboard/patient/store', [PatientController::class, 'store'])->name('patient.store')->middleware('auth')->middleware(['multiAuth:web,doctors,staffs']);
Route::delete('dashboard/patient/delete', [PatientController::class, 'delete'])->name('patient.delete')->middleware('auth')->middleware(['multiAuth:web,doctors,staffs']);
Route::get('dashboard/patient/edit/{id}', [PatientController::class, 'edit'])->name('patient.edit')->middleware('auth')->middleware(['multiAuth:web,doctors,staffs']);
Route::put('dashboard/patient/update', [PatientController::class, 'update'])->name('patient.update')->middleware('auth')->middleware(['multiAuth:web,doctors,staffs']);


/* ====================== Dashboard > Patient Appoinment ====================== */
Route::get('dashboard/patient-appointment', [PatientAppoinmentController::class, 'index'])->name('patient-appointment.index')->middleware(['multiAuth:web,doctors,staffs,patients']);
Route::post('dashboard/patient-appointment/store', [PatientAppoinmentController::class, 'store'])->name('patient-appointment.store')->middleware(['multiAuth:web,doctors,staffs']);
Route::delete('dashboard/patient-appointment/delete', [PatientAppoinmentController::class, 'delete'])->name('patient-appointment.delete')->middleware(['multiAuth:web,doctors,staffs']);
Route::get('dashboard/patient-appointment/edit/{id}', [PatientAppoinmentController::class, 'edit'])->name('patient-appointment.edit')->middleware(['multiAuth:web,doctors,staffs']);
Route::put('dashboard/patient-appointment/update', [PatientAppoinmentController::class, 'update'])->name('patient-appointment.update')->middleware(['multiAuth:web,doctors,staffs']);
Route::post('dashboard/patient-appointment/status/update', [PatientAppoinmentController::class, 'updateStatus'])->name('patient-appointment.status.update')->middleware(['multiAuth:web,doctors,staffs']);


/* ====================== Dashboard > Patient Report ====================== */
Route::get('dashboard/patient-report', [PatientReportController::class, 'index'])->name('patient-report.index')->middleware(['multiAuth:web,staffs,doctors']);
Route::post('dashboard/patient-report/store', [PatientReportController::class, 'store'])->name('patient-report.store')->middleware(['multiAuth:web,staffs,doctors']);
Route::delete('dashboard/patient-report/delete', [PatientReportController::class, 'delete'])->name('patient-report.delete')->middleware(['multiAuth:web,staffs,doctors']);
Route::get('dashboard/patient-report/edit/{id}', [PatientReportController::class, 'edit'])->name('patient-report.edit')->middleware(['multiAuth:web,staffs,doctors']);
Route::put('dashboard/patient-report/update', [PatientReportController::class, 'update'])->name('patient-report.update')->middleware(['multiAuth:web,staffs,doctors']);


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
Route::get('dashboard/supplier', [SupplierController::class, 'index'])->name('supplier.index')->middleware(['multiAuth:web,staffs']);
Route::post('dashboard/supplier/store', [SupplierController::class, 'store'])->name('supplier.store')->middleware(['multiAuth:web,staffs']);
Route::delete('dashboard/supplier/delete', [SupplierController::class, 'delete'])->name('supplier.delete')->middleware(['multiAuth:web,staffs']);
Route::get('dashboard/supplier/edit/{id}', [SupplierController::class, 'edit'])->name('supplier.edit')->middleware(['multiAuth:web,staffs']);
Route::put('dashboard/supplier/update', [SupplierController::class, 'update'])->name('supplier.update')->middleware(['multiAuth:web,staffs']);

/* ====================== Dashboard > Supplier Payment ====================== */
Route::get('dashboard/supplier-payment', [SupplierPaymentController::class, 'index'])->name('supplier-payment.index')->middleware('auth');
Route::post('dashboard/supplier-payment/store', [SupplierPaymentController::class, 'store'])->name('supplier-payment.store')->middleware('auth');
Route::delete('dashboard/supplier-payment/delete', [SupplierPaymentController::class, 'delete'])->name('supplier-payment.delete')->middleware('auth');
Route::get('dashboard/supplier-payment/edit/{id}', [SupplierPaymentController::class, 'edit'])->name('supplier-payment.edit')->middleware('auth');
Route::put('dashboard/supplier-payment/update', [SupplierPaymentController::class, 'update'])->name('supplier-payment.update')->middleware('auth');


/* ====================== Dashboard > Manufacturer ====================== */
Route::get('dashboard/manufacturer', [ManufacturerController::class, 'index'])->name('manufacturer.index')->middleware(['multiAuth:web,staffs']);
Route::post('dashboard/manufacturer/store', [ManufacturerController::class, 'store'])->name('manufacturer.store')->middleware(['multiAuth:web,staffs']);
Route::delete('dashboard/manufacturer/delete', [ManufacturerController::class, 'delete'])->name('manufacturer.delete')->middleware(['multiAuth:web,staffs']);
Route::get('dashboard/manufacturer/edit/{id}', [ManufacturerController::class, 'edit'])->name('manufacturer.edit')->middleware(['multiAuth:web,staffs']);
Route::put('dashboard/manufacturer/update', [ManufacturerController::class, 'update'])->name('manufacturer.update')->middleware(['multiAuth:web,staffs']);


/* ====================== Dashboard > Medicine ====================== */
Route::get('dashboard/medicine', [MedicineController::class, 'index'])->name('medicine.index')->middleware(['multiAuth:web,staffs']);
Route::post('dashboard/medicine/store', [MedicineController::class, 'store'])->name('medicine.store')->middleware(['multiAuth:web,staffs']);
Route::delete('dashboard/medicine/delete', [MedicineController::class, 'delete'])->name('medicine.delete')->middleware(['multiAuth:web,staffs']);
Route::get('dashboard/medicine/edit/{id}', [MedicineController::class, 'edit'])->name('medicine.edit')->middleware(['multiAuth:web,staffs']);
Route::put('dashboard/medicine/update', [MedicineController::class, 'update'])->name('medicine.update')->middleware(['multiAuth:web,staffs']);


/* ====================== Dashboard > Pharmacy Branch ====================== */
Route::get('dashboard/pharmacy-branch', [PharmacyBranchController::class, 'index'])->name('pharmacy-branch.index')->middleware('auth');
Route::post('dashboard/pharmacy-branch/store', [PharmacyBranchController::class, 'store'])->name('pharmacy-branch.store')->middleware('auth');
Route::delete('dashboard/pharmacy-branch/delete', [PharmacyBranchController::class, 'delete'])->name('pharmacy-branch.delete')->middleware('auth');
Route::get('dashboard/pharmacy-branch/edit/{id}', [PharmacyBranchController::class, 'edit'])->name('pharmacy-branch.edit')->middleware('auth');
Route::put('dashboard/pharmacy-branch/update', [PharmacyBranchController::class, 'update'])->name('pharmacy-branch.update')->middleware('auth');


/* ====================== Dashboard > Gallery Images====================== */
Route::get('dashboard/gallery', [GalleryController::class, 'index'])->name('gallery.index')->middleware('auth');
Route::get('dashboard/gallery/edit/{id}', [GalleryController::class, 'edit'])->name('gallery.edit')->middleware('auth');
Route::put('dashboard/gallery/update', [GalleryController::class, 'update'])->name('gallery.update')->middleware('auth');
Route::post('dashboard/gallery/store', [GalleryController::class, 'store'])->name('gallery.store')->middleware('auth');
Route::delete('dashboard/gallery/delete', [GalleryController::class, 'delete'])->name('gallery.delete')->middleware('auth');


/* ====================== Dashboard > Inquiries ====================== */
Route::get('dashboard/inquiries', [InquiryController::class, 'index'])->name('inquiry.index')->middleware('auth');
Route::delete('dashboard/inquiry/delete', [InquiryController::class, 'delete'])->name('inquiry.delete')->middleware('auth');


/* ====================== Dashboard >  Award ====================== */
Route::get('dashboard/award', [AwardController::class, 'index'])->name('award.index')->middleware('auth');
Route::post('dashboard/award/store', [AwardController::class, 'store'])->name('award.store')->middleware('auth');
Route::delete('dashboard/award/delete', [AwardController::class, 'delete'])->name('award.delete')->middleware('auth');
Route::get('dashboard/award/edit/{id}', [AwardController::class, 'edit'])->name('award.edit')->middleware('auth');
Route::put('dashboard/award/update', [AwardController::class, 'update'])->name('award.update')->middleware('auth');



/* ====================== Dashboard > Statistic ====================== */
Route::get('dashboard/statistic', [PharmacyStatisticController::class, 'index'])->name('statistic.index')->middleware('auth');
Route::post('dashboard/statistic/store', [PharmacyStatisticController::class, 'store'])->name('statistic.store')->middleware('auth');
Route::post('dashboard/statistic/status/update', [PharmacyStatisticController::class, 'updateStatus'])->name('statistic.status.update')->middleware('auth');


/* ====================== Dashboard > Log Money ====================== */
Route::get('dashboard/log-money', [LogMoneyController::class, 'index'])->name('log-money.index')->middleware('auth');


/* ====================== Dashboard > Pharmacy Schedule ====================== */
Route::get('dashboard/pharmacy-schedule', [PharmacyScheduleController::class, 'index'])->name('pharmacy-schedule.index')->middleware('auth');
Route::post('dashboard/pharmacy-schedule/store', [PharmacyScheduleController::class, 'store'])->name('pharmacy-schedule.store')->middleware('auth');
Route::delete('dashboard/pharmacy-schedule/delete', [PharmacyScheduleController::class, 'delete'])->name('pharmacy-schedule.delete')->middleware('auth');
Route::get('dashboard/pharmacy-schedule/edit/{id}', [PharmacyScheduleController::class, 'edit'])->name('pharmacy-schedule.edit')->middleware('auth');
Route::put('dashboard/pharmacy-schedule/update', [PharmacyScheduleController::class, 'update'])->name('pharmacy-schedule.update')->middleware('auth');
Route::post('dashboard/pharmacy-schedule/status/update', [PharmacyScheduleController::class, 'updateStatus'])->name('pharmacy-schedule.status.update')->middleware('auth');


/* ====================== Dashboard > Checkup Process ====================== */
Route::get('dashboard/checkup-process', [CheckupProcessController::class, 'index'])->name('checkup-process.index')->middleware('auth');
Route::post('dashboard/checkup-process/store', [CheckupProcessController::class, 'store'])->name('checkup-process.store')->middleware('auth');
Route::delete('dashboard/checkup-process/delete', [CheckupProcessController::class, 'delete'])->name('checkup-process.delete')->middleware('auth');
Route::get('dashboard/checkup-process/edit/{id}', [CheckupProcessController::class, 'edit'])->name('checkup-process.edit')->middleware('auth');
Route::put('dashboard/checkup-process/update', [CheckupProcessController::class, 'update'])->name('checkup-process.update')->middleware('auth');
Route::post('dashboard/checkup-process/status/update', [CheckupProcessController::class, 'updateStatus'])->name('checkup-process.status.update')->middleware('auth');


/* ====================== Dashboard > Pharmacy Schedule ====================== */
Route::get('dashboard/faq', [FaqController::class, 'index'])->name('faq.index')->middleware('auth');
Route::post('dashboard/faq/store', [FaqController::class, 'store'])->name('faq.store')->middleware('auth');
Route::delete('dashboard/faq/delete', [FaqController::class, 'delete'])->name('faq.delete')->middleware('auth');
Route::get('dashboard/faq/edit/{id}', [FaqController::class, 'edit'])->name('faq.edit')->middleware('auth');
Route::put('dashboard/faq/update', [FaqController::class, 'update'])->name('faq.update')->middleware('auth');
Route::post('dashboard/faq/status/update', [FaqController::class, 'updateStatus'])->name('faq.status.update')->middleware('auth');


/* ====================== Dashboard > Testimonial ====================== */
Route::get('dashboard/testimonial', [TestimonialController::class, 'index'])->name('testimonial.index')->middleware('auth');
Route::post('dashboard/testimonial/store', [TestimonialController::class, 'store'])->name('testimonial.store')->middleware('auth');
Route::delete('dashboard/testimonial/delete', [TestimonialController::class, 'delete'])->name('testimonial.delete')->middleware('auth');
Route::get('dashboard/testimonial/edit/{id}', [TestimonialController::class, 'edit'])->name('testimonial.edit')->middleware('auth');
Route::put('dashboard/testimonial/update', [TestimonialController::class, 'update'])->name('testimonial.update')->middleware('auth');
Route::post('dashboard/testimonial/status/update', [TestimonialController::class, 'updateStatus'])->name('testimonial.status.update')->middleware('auth');


/* ====================== Dashboard > Service ====================== */
Route::get('dashboard/service', [AdminServiceController::class, 'index'])->name('service.index')->middleware('auth');
Route::post('dashboard/service/store', [AdminServiceController::class, 'store'])->name('service.store')->middleware('auth');
Route::delete('dashboard/service/delete', [AdminServiceController::class, 'delete'])->name('service.delete')->middleware('auth');
Route::get('dashboard/service/edit/{id}', [AdminServiceController::class, 'edit'])->name('service.edit')->middleware('auth');
Route::put('dashboard/service/update', [AdminServiceController::class, 'update'])->name('service.update')->middleware('auth');
Route::post('dashboard/service/status/update', [AdminServiceController::class, 'updateStatus'])->name('service.status.update')->middleware('auth');



/* ====================== Dashboard > Service Category ====================== */
Route::get('dashboard/service-category', [ServiceCategoryController::class, 'index'])->name('service-category.index')->middleware('auth');
Route::post('dashboard/service-category/store', [ServiceCategoryController::class, 'store'])->name('service-category.store')->middleware('auth');
Route::delete('dashboard/service-category/delete', [ServiceCategoryController::class, 'delete'])->name('service-category.delete')->middleware('auth');
Route::get('dashboard/service-category/edit/{id}', [ServiceCategoryController::class, 'edit'])->name('service-category.edit')->middleware('auth');
Route::put('dashboard/service-category/update', [ServiceCategoryController::class, 'update'])->name('service-category.update')->middleware('auth');
Route::post('dashboard/service-category/status/update', [ServiceCategoryController::class, 'updateStatus'])->name('service-category.status.update')->middleware('auth');



/* ====================== Dashboard > Activity Category ====================== */
Route::get('dashboard/activity-category', [ActivityCategoryController::class, 'index'])->name('activity-category.index')->middleware('auth');
Route::post('dashboard/activity-category/store', [ActivityCategoryController::class, 'store'])->name('activity-category.store')->middleware('auth');
Route::delete('dashboard/activity-category/delete', [ActivityCategoryController::class, 'delete'])->name('activity-category.delete')->middleware('auth');
Route::get('dashboard/activity-category/edit/{id}', [ActivityCategoryController::class, 'edit'])->name('activity-category.edit')->middleware('auth');
Route::put('dashboard/activity-category/update', [ActivityCategoryController::class, 'update'])->name('activity-category.update')->middleware('auth');
Route::post('dashboard/activity-category/status/update', [ActivityCategoryController::class, 'updateStatus'])->name('activity-category.status.update')->middleware('auth');


/* ====================== Web  ====================== */
Route::get('/', [PageController::class, 'homePage'])->name('web.homepage.index');


/* ====================== Web > pages  ====================== */
Route::get('about-us', [PageController::class, 'aboutUs'])->name('web.about.index');
Route::get('galleries', [PageController::class, 'gallery'])->name('web.gallery.index');


/* ====================== Web > Service  ====================== */
Route::get('services', [ServiceController::class, 'index'])->name('web.service.index');
Route::get('service/details/{id}', [ServiceController::class, 'show'])->name('web.service.show');


/* ====================== Web > Team  ====================== */
Route::get('teams', [TeamController::class, 'index'])->name('web.team.index');
Route::get('team/details/{id}', [TeamController::class, 'show'])->name('web.team.show');


/* ====================== Web > Appointment  ====================== */
Route::get('appointment', [AppointmentController::class, 'index'])->name('web.appointment.index');


/* ====================== Web > Blog  ====================== */
Route::get('activities', [WebActivityController::class, 'index'])->name('web.activity.index');
Route::get('activity/details/{id}', [WebActivityController::class, 'show'])->name('web.activity.show');


/* ====================== Web > Contact  ====================== */
Route::get('contact', [PageController::class, 'contact'])->name('web.contact.index');



/* ======================Web Routes > Inquiry====================== */
Route::post('inquiry/store', [WebInquiryController::class, 'store'])->name('inquiry.store');
