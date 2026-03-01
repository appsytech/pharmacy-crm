@extends('web.layouts.main')

@section('content')

<!--==============================
Gallery Area
================================-->
<x-web.pages.sections.gallery.wrapper :images="$data['images']" />

<!--==============================
Feature Area
==============================-->
<x-web.pages.sections.gallery.feature.wrapper />

<!--==============================
Team Area
==============================-->
<x-web.pages.sections.gallery.team.wrapper />

@endsection