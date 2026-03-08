@extends('web.layouts.main')

@section('content')

<!--==============================
    Breadcumb
============================== -->
<x-web.breadcrumb.default-breadcrumb label="Services" :items="[['label' => 'Home', 'url' => route('web.homepage.index')], ['label' => 'Services', 'url' => route('web.service.index')], ['label' => 'Services Detail', 'active' => true]]" />


<!--==============================
    Service Area
==============================-->
<x-web.pages.sections.service.service-details.wrapper
    :service="$data['service']"
    :categories="$data['categories']"
    :realtedServices="$data['relatedServices']" />

@endsection