 <aside id="sidebar"
     {{ $attributes->merge([
         'class' =>
             'fixed lg:relative w-64 bg-white border-gray-200 shadow-sm transition-all duration-300 h-screen overflow-hidden flex flex-col flex-shrink-0 z-40 -translate-x-full lg:translate-x-0',
     ]) }}>

     <x-admin.sidebar.logo
         logoUrl="https://www.creativefabrica.com/wp-content/uploads/2022/04/14/A-Symbol-Company-Logo-Design-Vector-Graphics-28995233-3-580x387.jpg" />
     <x-admin.sidebar.search />
     <nav class="p-4 space-y-1 flex-1 overflow-y-auto">

         <!--======== Home  ========-->
         <x-admin.sidebar.nav-item title="Home" :svgUrl="asset('assets/svg/home.svg')" :url="route('dashboard')" :activeRoutes="['dashboard']" />

         <!--======== Medicine  ========-->
         <x-admin.sidebar.nav-item-group title="Medicine" :svgUrl="asset('assets/svg/pill.svg')" :activeRoutes="['medicine.index', 'medicine.edit', 'supplier.index', 'supplier.edit', 'manufacturer.index', 'manufacturer.edit']">
             <x-admin.sidebar.nav-sub-item title="Supplier" :url="route('supplier.index')" :activeRoutes="['supplier.index', 'supplier.edit']" />
             <x-admin.sidebar.nav-sub-item title="Manufacturer" :url="route('manufacturer.index')" :activeRoutes="['manufacturer.index', 'manufacturer.edit']" />
             <x-admin.sidebar.nav-sub-item title="Medicine List" :url="route('medicine.index')" :activeRoutes="['medicine.index', 'medicine.edit']" />
             <x-admin.sidebar.nav-sub-item title="Upcoming Medicine" url="#" />
         </x-admin.sidebar.nav-item-group>

         <!--======== Billing  ========-->
         <x-admin.sidebar.nav-item-group title="Billing" :svgUrl="asset('assets/svg/receipt.svg')">
             <x-admin.sidebar.nav-sub-item title="Medicine Bill" url="#" />
             <x-admin.sidebar.nav-sub-item title="Patient Bill" url="#" />
         </x-admin.sidebar.nav-item-group>

         <!--======== Doctors  ========-->
         <x-admin.sidebar.nav-item-group title="Doctors" :svgUrl="asset('assets/svg/stethoscope.svg')" :activeRoutes="['doctor.index', 'doctor.edit']">
             <x-admin.sidebar.nav-sub-item title="Core Doctors" :url="route('doctor.index')" :activeRoutes="['doctor.index', 'doctor.edit']" />
             <x-admin.sidebar.nav-sub-item title="Specialist" url="#" />
             <x-admin.sidebar.nav-sub-item title="New Vacancy" url="#" />
             <x-admin.sidebar.nav-sub-item title="Applicants" url="#" />
         </x-admin.sidebar.nav-item-group>

         <!--======== Extra Events  ========-->
         <x-admin.sidebar.nav-item-group title="Extra Events" :svgUrl="asset('assets/svg/calendar-check.svg')" :activeRoutes="['activity.index', 'activity.edit', 'job-application.index', 'job-application.edit']">
             <x-admin.sidebar.nav-sub-item title="Activities" url="{{ route('activity.index') }}" :activeRoutes="['activity.index', 'activity.edit']" />
             <x-admin.sidebar.nav-sub-item title="Job Applications" url="{{ route('job-application.index') }}" :activeRoutes="['job-application.index', 'job-application.edit']" />
         </x-admin.sidebar.nav-item-group>

         <!--========Manage Money ========-->
         <x-admin.sidebar.nav-item-group title="Manage Money" :svgUrl="asset('assets/svg/dollar-sign.svg')" :activeRoutes="['expense-type.index', 'expense-type.edit', 'expense.index', 'expense.edit']">
             <x-admin.sidebar.nav-sub-item title="Expense type" url="{{ route('expense-type.index') }}" :activeRoutes="['expense-type.index', 'expense-type.edit']" />
             <x-admin.sidebar.nav-sub-item title="Expense" url="{{ route('expense.index') }}" :activeRoutes="['expense.index', 'expense.edit']" />
         </x-admin.sidebar.nav-item-group>

         <!--========Staff Management ========-->
         <x-admin.sidebar.nav-item-group title="Manage Staff" :svgUrl="asset('assets/svg/user-cog.svg')" :activeRoutes="['staff.index', 'staff.edit', 'staff-salary.index', 'staff-salary.edit']">
             <x-admin.sidebar.nav-sub-item title="Staff" :url="route('staff.index')" :activeRoutes="['staff.index', 'staff.edit']" />
             <x-admin.sidebar.nav-sub-item title="Staff Salary" :url="route('staff-salary.index')" :activeRoutes="['staff-salary.index', 'staff-salary.edit']" />
         </x-admin.sidebar.nav-item-group>

         <!--======== Patients  ========-->
         <x-admin.sidebar.nav-item-group title="Patients" :svgUrl="asset('assets/svg/user-group.svg')" :activeRoutes="['patient.index', 'patient.edit', 'patient-appointment.index', 'patient-appointment.edit', 'patient-report.index', 'patient-report.edit']">
             <x-admin.sidebar.nav-sub-item title="Patient List" :url="route('patient.index')" :activeRoutes="['patient.index', 'patient.edit']" />
             <x-admin.sidebar.nav-sub-item title="Patient Appointment" :url="route('patient-appointment.index')" :activeRoutes="['patient-appointment.index', 'patient-appointment.edit']" />
             <x-admin.sidebar.nav-sub-item title="Patient Report" :url="route('patient-report.index')" :activeRoutes="['patient-report.index', 'patient-report.edit']" />
         </x-admin.sidebar.nav-item-group>

         <!--======== Setting  ========-->
         <x-admin.sidebar.nav-item-group title="Setting" :svgUrl="asset('assets/svg/setting.svg')" :activeRoutes="['admin.index', 'admin.edit',  'homepage-slider.index', 'homepage-slider.edit']">
             <x-admin.sidebar.nav-sub-item title="Admin" :url="route('admin.index')" :activeRoutes="['admin.index', 'admin.edit']" />
             <x-admin.sidebar.nav-sub-item title="Homepage Slider" :url="route('homepage-slider.index')" :activeRoutes="['homepage-slider.index', 'homepage-slider.edit']" />
         </x-admin.sidebar.nav-item-group>

     </nav>

     <x-admin.globals.buttons.logout-button label="Logout" :svgUrl="asset('assets/svg/exit.svg')" />
 </aside>