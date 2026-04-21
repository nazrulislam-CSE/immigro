@extends('layouts.frontend.app', [$pageTitle => 'Page Title'])
@section('content')
    <!-- =============== PAGE TITLE ============== -->
    <style>
        .single_container {
            padding-top: 0px !important;
        }
    </style>
    <!-- =============== PAGE TITLE ============== -->
    <!-- Breadcrumb Banner Start -->
    <section class="breadcrumb-banner"
        style="
        background-image: url('{{ !empty($singleService->banner) ? url('upload/service/' . $singleService->banner) : url('upload/page-title.jpg') }}');
        background-size: cover;
        background-position: center center;
        background-repeat: no-repeat;
        padding: 200px 0;
        text-align: center;
        color: #fff;
    ">
    </section>
    <!-- Breadcrumb Banner End -->

    <!-- ================ SINGLE SERVICE DETAILS ================ -->
    <section class="single_container">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 mb-5 mb-lg-0">
                    <div class="row">
                        <div class="col-lg-12">
                            <article class="card border-0 primary-shadow">
                                <img src="{{ !empty($singleService->image) ? url('upload/service/' . $singleService->image) : url('upload/') }}"
                                    alt="..." class="wow fadeIn" data-wow-delay="200ms">
                                <div class="card-body p-1-6 p-sm-1-9">
                                    <div class="wow fadeIn" data-wow-delay="200ms">
                                        <h3 class="mb-3">{{ $singleService->title ?? 'n/a' }}</h3>
                                        <p>
                                            {!! $singleService->description ?? 'n/a' !!}
                                        </p>
                                        {{-- <p class="mb-2-3">
                                                {!! $singleVisa->documents ?? 'n/a' !!}
                                            </p> --}}
                                    </div>
                                </div>
                            </article>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 ps-xl-5">
                    <div class="sidebar">
                        <div class="sidebar__single sidebar__post">
                            <h3 class="sidebar__title">Recent Services</h3>
                            <hr>
                            <ul class="sidebar__post-list list-unstyled">
                                @foreach ($services as $service)
                                    <li
                                        class="d-flex mb-4 p-2 rounded 
            {{ request()->route('slug') == $service->slug ? 'bg-primary text-white' : '' }}">

                                        <div class="flex-shrink-0">
                                            <img width="80"
                                                src="{{ !empty($service->image) ? url('upload/service/' . $service->image) : url('upload/') }}"
                                                alt="...">
                                        </div>

                                        <div class="flex-grow-1 ms-3">
                                            <h4 class="mb-2 h6">
                                                <a href="{{ route('single.service.page', $service->slug) }}"
                                                    class="{{ request()->route('slug') == $service->slug ? 'text-white' : '' }}">
                                                    {{ $service->title ?? 'n/a' }}
                                                </a>
                                            </h4>

                                            <span
                                                class="small {{ request()->route('slug') == $service->slug ? 'text-white' : 'text-muted' }}">
                                                {{ $service->created_at->format('F d, Y') }}
                                            </span>
                                        </div>

                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
