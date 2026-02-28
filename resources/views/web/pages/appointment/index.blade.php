@extends('web.layouts.main')

@section('content')

<!--==============================
    Breadcumb
============================== -->
<x-web.breadcrumb.default-breadcrumb label="Appointments" :items="[['label' => 'Home', 'url' => route('web.homepage.index')],['label' => 'Appointments', 'active' => true]]" />


<!--==============================
Appointment Area
==============================-->
<x-web.pages.sections.appointment.wrapper />

<!--==============================
Brand Area
==============================-->
<x-web.pages.sections.appointment.brand.wrapper />
@endsection