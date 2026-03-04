@extends('web.layouts.main')

@section('content')

<!--==============================
    Breadcumb
============================== -->
<x-web.breadcrumb.default-breadcrumb label="Activity" :items="[['label' => 'Home', 'url' => route('web.homepage.index')],['label' => 'Activity', 'active' => true]]" />


<!--==============================
Blog Area
==============================-->
<x-web.pages.sections.activity.wrapper :activities="$data['activities']" />
@endsection