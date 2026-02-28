@extends('web.layouts.main')

@section('content')

<!--==============================
    Breadcumb
============================== -->
<x-web.breadcrumb.default-breadcrumb label="Blog Standard" :items="[['label' => 'Home', 'url' => route('web.homepage.index')],['label' => 'Blog Standard', 'active' => true]]" />


<!--==============================
Blog Area
==============================-->
<x-web.pages.sections.blog.wrapper />
@endsection