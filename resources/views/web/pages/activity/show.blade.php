@extends('web.layouts.main')

@section('content')

<!--==============================
    Breadcumb
============================== -->
<x-web.breadcrumb.default-breadcrumb label="Activity Details" :items="[['label' => 'Home', 'url' => route('web.homepage.index')],['label' => 'Activity Details', 'active' => true]]" />



<!--==============================
        Activity Area
==============================-->
<x-web.pages.sections.activity.activity-detail.wrapper :activity="$data['activity']" />

@endsection