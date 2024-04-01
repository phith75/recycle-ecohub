@extends('errors::minimal')
@section('title', __('Unauthorized'))

<section class="container items-center justify-center">
    <div class="d-flex pt-5 justify-content-center">
        <img src="{{ asset('images/errors/401.jpg') }}" alt="">  
    </div>
    <div class="d-flex pt-5 justify-content-center">
    @if ($exception->getMessage() == "1")
       <a href="{{ route('user_client') }}" class="btn btn-danger p-3">Quay về trang chủ</a>
    @else
       <a href="{{ route('index') }}" class="btn btn-danger p-3">Quay về trang chủ</a>
    @endif
    </div>
</section>
