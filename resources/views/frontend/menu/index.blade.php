@extends('layouts.frontend.app', ['pageTitle' => $page->page_title])

@section('content')
    @if ($page->page_slug == 'visa-service')
        <!-- Breadcrumb Banner Start -->
        <section class="breadcrumb-banner"
            style="
        background-image: url('{{ !empty($page->image) ? url('upload/page/' . $page->image) : url('frontend/img/slider/7.jpg') }}');
        background-size: cover;
        background-position: center center;
        background-repeat: no-repeat;
        padding: 200px 0;
        text-align: center;
        color: #fff;
    ">
        </section>
        <!-- Breadcrumb Banner End -->

        <!-- Page Content -->
        <section class="page-content pt-5 pb-5">
            <div class="container">
                <section class="services-section">
                    <div class="auto-container">

                        <div class="row">
                            <div class="col-lg-6">
                                <div class="sec-title">
                                    <span class="sub-title">What do we offer</span>
                                    <h2>Outstanding immigration visa <span class="color3">services.</span></h2>
                                    <div class="text">
                                        Lorem Ipsum. Proin gravida nibh vel velit auctor aliquet.
                                    </div>
                                </div>
                            </div>

                            @forelse($services as $service)
                                <!-- Service Block -->
                                <div class="service-block col-lg-3 col-md-6 col-sm-12 wow fadeInUp">
                                    <div class="inner-box">

                                        <div class="image-box">

                                            <figure class="image">
                                                <a href="{{ url('service/' . $service->slug) }}">
                                                    <img
                                                        src="{{ !empty($service->image) ? url('upload/service/' . $service->image) : url('upload/no_image.jpg') }}">
                                                </a>
                                            </figure>

                                            <h6 class="title">{{ $service->title }}</h6>

                                        </div>

                                        <div class="content-box">

                                            <h6 class="title">
                                                <a href="{{ url('service/' . $service->slug) }}">
                                                    {{ $service->title }}
                                                </a>
                                            </h6>

                                            <div class="text">
                                                {{ Str::limit($service->description, 80) }}
                                            </div>

                                            <a href="{{ url('service/' . $service->slug) }}" class="read-more">
                                                More <i class="fa fa-long-arrow-right"></i>
                                            </a>

                                        </div>

                                    </div>
                                </div>

                            @empty

                                <!-- Default Service 1 -->
                                <div class="service-block col-lg-3 col-md-6 col-sm-12 wow fadeInUp">
                                    <div class="inner-box">
                                        <div class="image-box">
                                            <figure class="image">
                                                <img src="{{ asset('frontend/images/resource/service-1.jpg') }}">
                                            </figure>
                                            <h6 class="title">Student Visa</h6>
                                        </div>

                                        <div class="content-box">
                                            <h6 class="title">Student Visa</h6>
                                            <div class="text">
                                                We have to a tendency to believe the idea that smart looking website.
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Default Service 2 -->
                                <div class="service-block col-lg-3 col-md-6 col-sm-12 wow fadeInUp">
                                    <div class="inner-box">
                                        <div class="image-box">
                                            <figure class="image">
                                                <img src="{{ asset('frontend/images/resource/service-2.jpg') }}">
                                            </figure>
                                            <h6 class="title">Business Visa</h6>
                                        </div>

                                        <div class="content-box">
                                            <h6 class="title">Business Visa</h6>
                                            <div class="text">
                                                We have to a tendency to believe the idea that smart looking website.
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Default Service 3 -->
                                <div class="service-block col-lg-3 col-md-6 col-sm-12 wow fadeInUp">
                                    <div class="inner-box">
                                        <div class="image-box">
                                            <figure class="image">
                                                <img src="{{ asset('frontend/images/resource/service-3.jpg') }}">
                                            </figure>
                                            <h6 class="title">Family Visa</h6>
                                        </div>

                                        <div class="content-box">
                                            <h6 class="title">Family Visa</h6>
                                            <div class="text">
                                                We have to a tendency to believe the idea that smart looking website.
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Default Service 4 -->
                                <div class="service-block col-lg-3 col-md-6 col-sm-12 wow fadeInUp">
                                    <div class="inner-box">
                                        <div class="image-box">
                                            <figure class="image">
                                                <img src="{{ asset('frontend/images/resource/service-4.jpg') }}">
                                            </figure>
                                            <h6 class="title">Tourist Visa</h6>
                                        </div>

                                        <div class="content-box">
                                            <h6 class="title">Tourist Visa</h6>
                                            <div class="text">
                                                We have to a tendency to believe the idea that smart looking website.
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforelse

                        </div>
                    </div>
                </section>
            </div>
        </section>
    @elseif($page->page_slug == 'team')
        <!-- Breadcrumb Banner Start -->
        <section class="breadcrumb-banner"
            style="
        background-image: url('{{ !empty($page->image) ? url('upload/page/' . $page->image) : url('frontend/img/slider/7.jpg') }}');
        background-size: cover;
        background-position: center center;
        background-repeat: no-repeat;
        padding: 200px 0;
        text-align: center;
        color: #fff;
    ">
        </section>
        <!-- Breadcrumb Banner End -->
        <!-- Page Content -->
        <section class="page-content py-5">
            <div class="container">

                <!-- Section Title -->
                <div class="row mb-5">
                    <div class="col-12 text-center">
                        <h2 class="fw-bold">Our Team</h2>
                        <p class="text-muted">Meet our professional team members</p>
                    </div>
                </div>

                <div class="row">
                    @foreach ($teams as $team)
                        <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
                            <div class="card h-100 text-center shadow-lg border-0">

                                <img src="{{ !empty($team->image) ? url('upload/team/' . $team->image) : url('upload/avatar5.png') }}"
                                    class="card-img-top rounded-top" alt="{{ $team->name }}">

                                <div class="card-body">
                                    <h5 class="card-title mb-1">{{ $team->name }}</h5>

                                    <p class="text-muted mb-2">
                                        {{ $team->designation }}
                                    </p>

                                    <p class="mb-1">
                                        <i class="fa fa-phone"></i> {{ $team->phone }}
                                    </p>

                                    <p class="small text-muted mb-0">
                                        {{ $team->address }}
                                    </p>
                                </div>

                            </div>
                        </div>
                    @endforeach
                </div>

            </div>
        </section>
    @elseif($page->page_slug == 'office-address')
        <!-- Breadcrumb Banner Start -->
        <section class="breadcrumb-banner"
            style="
        background-image: url('{{ !empty($page->image) ? url('upload/page/' . $page->image) : url('frontend/img/slider/7.jpg') }}');
        background-size: cover;
        background-position: center center;
        background-repeat: no-repeat;
        padding: 200px 0;
        text-align: center;
        color: #fff;
    ">
        </section>
        <!-- Breadcrumb Banner End -->
        <!-- Page Content -->
        <section class="page-content pt-5 pb-5">
            <div class="container">

                <!--Contact Details Start-->
                <section class="contact-details">
                    <div class="container ">
                        <div class="row">
                            <div class="col-xl-7 col-lg-6">
                                <div class="sec-title">
                                    <span class="sub-title">Send us email</span>
                                    <h2>Feel free to write</h2>
                                </div>
                                <!-- Contact Form -->
                                <form id="contact_form" name="contact_form" class="" action="#" method="post">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="mb-3">
                                                <input name="form_name" class="form-control" type="text"
                                                    placeholder="Enter Name">
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="mb-3">
                                                <input name="form_email" class="form-control required email"
                                                    type="email" placeholder="Enter Email">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="mb-3">
                                                <input name="form_subject" class="form-control required" type="text"
                                                    placeholder="Enter Subject">
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="mb-3">
                                                <input name="form_phone" class="form-control" type="text"
                                                    placeholder="Enter Phone">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <textarea name="form_message" class="form-control required" rows="7" placeholder="Enter Message"></textarea>
                                    </div>
                                    <div class="mb-3">
                                        <input name="form_botcheck" class="form-control" type="hidden"
                                            value="" />
                                        <button type="submit" class="theme-btn btn-style-one"
                                            data-loading-text="Please wait..."><span class="btn-title">Send
                                                message</span></button>
                                        <button type="reset" class="theme-btn btn-style-one bg-theme-color5"><span
                                                class="btn-title">Reset</span></button>
                                    </div>
                                </form>
                                <!-- Contact Form Validation-->
                            </div>
                            <div class="col-xl-5 col-lg-6">
                                <div class="contact-details__right">
                                    <div class="sec-title">
                                        <span class="sub-title">Need any help?</span>
                                        <h2>Get in touch with us</h2>
                                        <div class="text">Lorem ipsum is simply free text available dolor sit amet
                                            consectetur
                                            notted adipisicing elit sed do eiusmod tempor incididunt simply dolore magna.
                                        </div>
                                    </div>
                                    <ul class="list-unstyled contact-details__info">
                                        <li>
                                            <div class="icon">
                                                <span class="lnr-icon-phone-plus"></span>
                                            </div>
                                            <div class="text">
                                                <h6>Have any question?</h6>
                                                <a href="tel:{{ get_setting('phone')->value ?? '' }}"><span>Free</span>
                                                    {{ get_setting('phone')->value ?? '' }}</a>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="icon">
                                                <span class="lnr-icon-envelope1"></span>
                                            </div>
                                            <div class="text">
                                                <h6>Write email</h6>
                                                <a
                                                    href="mailto:{{ get_setting('email')->value ?? '' }}">{{ get_setting('email')->value ?? '' }}</a>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="icon">
                                                <span class="lnr-icon-location"></span>
                                            </div>
                                            <div class="text">
                                                <h6>Visit anytime</h6>
                                                <span>{{ get_setting('business_address')->value ?? '' }}</span>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <!--Contact Details End-->

                <!-- Divider: Google Map -->
                <section>
                    <div class="container-fluid p-0">
                        <div class="row">
                            <!-- Google Map HTML Codes -->
                            <iframe
                                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d58144.787229144335!2d88.60616015!3d24.37959175!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x39fbefa96a38d031%3A0x10f93a950ed6f410!2sRajshahi!5e0!3m2!1sen!2sbd!4v1773211282518!5m2!1sen!2sbd"
                                width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"
                                referrerpolicy="no-referrer-when-downgrade"></iframe>
                        </div>
                    </div>
                </section>
            </div>
        </section>
    @endif
@endsection
