@extends('web.layouts.main')

@section('content')

<!--==============================
    Breadcumb
============================== -->
<x-web.breadcrumb.default-breadcrumb label="Services" :items="[['label' => 'Home', 'url' => route('web.homepage.index')],['label' => 'Services', 'active' => true]]" />


<!--==============================
Service Area
==============================-->
<x-web.sections.service.wrapper :services="$data['services']"  :paginate=true sectionTitle="Our Tata Medical D S Pvt specialties Technical service" sectionSubTitle="Our Services" />

<!--==============================
Cta Area
==============================-->
<section class="space-bottom">
    <div class="container z-index-common">
        <div class="cta-sec5 mega-hover" data-bg-src="{{ asset('assets/img/bg/cta_bg_5.jpg') }}">
            <h2 class="sec-title text-white mb-35">We are pleased to offer you the healthy.</h2>
            <a href="shop-details.html" class="th-btn style4 shadow-1">Contact Us Now</a>
        </div>
    </div>
</section>

@endsection