@extends('web.layouts.main')

@section('content')

<!--==============================
    Hero Area
 ==============================-->
<x-web.sections.hero.wrapper :sliders="$data['sliders']" />

<!--==============================
    About Area
==============================-->
<x-web.sections.about.wrapper sectionTitle="Affordable Health Care Solutions" sectionSubTitle="About Our Company" />

<!--==============================
Service Area
==============================-->
<x-web.sections.service.wrapper :services="$data['services']" :bgImg="asset('assets/img/bg/service_bg_1.png')" sectionTitle="Our Tata Medical D S Pvt specialties Technical service" sectionSubTitle="Our Services" class="bg-smoke" />

<!--==============================
Cta Area
==============================-->
<x-web.sections.cta.wrapper />

<!--==============================
Feature Area
==============================-->
<x-web.sections.feature.wrapper />

<!--==============================
Counter Area
==============================-->
<x-web.sections.counter.wrapper />

<!--==============================
Team Area
==============================-->
<x-web.sections.team.wrapper :teams="$data['doctors']" :bgImgUrl="asset('assets/img/bg/team_bg_1.jpg')" />

<!--==============================
Appointment Area
==============================-->
<x-web.sections.appointment.wrapper />

<!--==============================
Process Area
==============================-->
<x-web.sections.process.wrapper :processes="$data['checkupProcesses']" />

<!--==============================
Faq Area
==============================-->
<x-web.sections.faq.wrapper :faqs="$data['faqs']" />


<!--==============================
Testimonial Area
==============================-->
<x-web.sections.testimonial.wrapper :testimonials="$data['testimonials']" />


<!--==============================
Activity Area
==============================-->
<x-web.sections.activity.wrapper :activities="$data['activities']" />
@endsection