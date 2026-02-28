@extends('web.layouts.main')

@section('content')

<!--==============================
    Breadcumb
============================== -->
<x-web.breadcrumb.default-breadcrumb label="Blog Details" :items="[['label' => 'Home', 'url' => route('web.homepage.index')],['label' => 'Blog Details', 'active' => true]]" />



<!--==============================
        Blog Area
==============================-->
<x-web.pages.sections.blog.blog-detail.wrapper />

@endsection