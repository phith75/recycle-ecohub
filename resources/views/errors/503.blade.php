@extends('errors::minimal')

@section('title', __('Service Unavailable'))

<section class="container items-center justify-center">
<div class="d-flex pt-5 justify-content-center">
    <img src="{{ asset('images/errors/503.jpg') }}" alt="">  
</div></section>