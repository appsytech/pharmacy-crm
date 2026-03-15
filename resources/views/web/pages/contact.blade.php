@extends('web.layouts.main')

@section('content')


<div id="popup-container" class="position-fixed top-0 end-0 p-3 d-flex flex-column gap-2" style="z-index: 1050;">
</div>

<!--==============================
    Breadcumb
============================== -->
<x-web.breadcrumb.default-breadcrumb label="Contact Us" :items="[['label' => 'Home', 'url' => route('web.homepage.index')],['label' => 'Contact Us', 'active' => true]]" />


<!--==============================
Contact Info Area
==============================-->
<x-web.pages.sections.contact.wrapper />


<!--==============================
Contact Area
==============================-->
<x-web.pages.sections.contact.form.wrapper />


<!--==============================
Map Area
==============================-->
<div class="">
    <div class="contact-map">
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3598.0325826164917!2d85.13344102617828!3d25.603833527451414!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x39ed5868439e63ef%3A0x1f6897baa42c1ae4!2sPatna%20Junction%2C%20Fraser%20Road%20Area%2C%20Patna%2C%20Bihar%20800001!5e0!3m2!1sen!2sin!4v1768845108776!5m2!1sen!2sin" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
    </div>
</div>
@endsection