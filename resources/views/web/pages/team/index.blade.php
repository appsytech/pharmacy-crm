@extends('web.layouts.main')

@section('content')

<!--==============================
    Breadcumb
============================== -->
<x-web.breadcrumb.default-breadcrumb label="Our Doctors" :items="[['label' => 'Home', 'url' => route('web.homepage.index')],['label' => 'Our Doctors', 'active' => true]]" />

<!--==============================
      Team Area
==============================-->
<x-web.pages.sections.team.wrapper />
@endsection