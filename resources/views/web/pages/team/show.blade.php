@extends('web.layouts.main')

@section('content')

<!--==============================
    Breadcumb
============================== -->



<!--==============================
    Breadcumb
============================== -->
<x-web.breadcrumb.default-breadcrumb label="Doctor Details" :items="[['label' => 'Home', 'url' => route('web.team.index')],['label' => 'Doctor Details', 'active' => true]]" />


<!--==============================
Team Area
==============================-->
<x-web.pages.sections.team.team-details.wrapper :team="$data['team']" />
@endsection