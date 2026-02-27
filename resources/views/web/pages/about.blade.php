@extends('web.layouts.main')

@section('content')

<!--==============================
    Breadcumb
============================== -->
<x-web.breadcrumb.default-breadcrumb label="About Us" :items="[['label' => 'Home', 'url' => route('web.homepage.index')],['label' => 'About Us', 'active' => true]]" />

<!--==============================
About Area
==============================-->
<x-web.sections.about.wrapper />

<!--==============================
Counter Area
==============================-->
<x-web.pages.sections.counter.wrapper />

<!--==============================
Feature Area
==============================-->
<x-web.pages.sections.feature.wrapper />

<!--==============================
Team Area
==============================-->
<x-web.sections.team.wrapper class="space" />

<!--==============================
Cta Area
==============================-->
<x-web.pages.sections.cta.wrapper />

<!--==============================
Achievement Area
==============================-->
<x-web.pages.sections.achievement.wrapper />

<!--==============================
Testimonial Area
==============================-->
<x-web.pages.sections.testimonial.wrapper />
@endsection