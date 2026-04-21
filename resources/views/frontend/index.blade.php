@extends('layouts.frontend.app')
@section('content')
<style>
    .services-section {
        padding: 0px 0 90px;
    }
    .gallery-section{
        padding: 0px 0 90px;
    }
    .training-section{
        padding: 0px 0 90px;
    }
    .country-section{
        padding: 0px 0 90px;
    }
    .team-section{
        padding: 0px 0 90px;
    }
    .testimonial-section{
        padding: 0px 0 90px;
    }
</style>
    <!-- Main Slider -->
    <section class="main-slider mt-4">
        <div class="container-fluid p-0">
            <div class="row g-0">
                <div class="col-12">

                    <div id="mainSlider" class="carousel slide" data-bs-ride="carousel">

                        <div class="carousel-inner">

                            @forelse ($sliders as $slider)
                                <div class="carousel-item {{ $loop->first ? 'active' : '' }}">
                                    <img src="{{ asset('upload/slider/' . $slider->image) }}"
                                        class="d-block w-100 img-fluid slider-img" alt="Slider Image">
                                </div>
                            @empty
                                <div class="carousel-item active">
                                    <img src="{{ asset('frontend/images/main-slider/1.jpg') }}"
                                        class="d-block w-100 img-fluid slider-img" alt="Default Slider">
                                </div>
                            @endforelse

                        </div>

                        <!-- Controls -->
                        <button class="carousel-control-prev" type="button" data-bs-target="#mainSlider"
                            data-bs-slide="prev">
                            <span class="carousel-control-prev-icon"></span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#mainSlider"
                            data-bs-slide="next">
                            <span class="carousel-control-next-icon"></span>
                        </button>

                    </div>

                </div>
            </div>
        </div>
    </section>
    <!-- End Main Slider -->

    <!-- About Section -->
    <section class="about-section">
        <div class="auto-container">
            <div class="row">

                <!-- Content Column -->
                <div class="content-column col-xl-6 col-lg-6 col-md-12 col-sm-12 wow fadeInRight" data-wow-delay="600ms">
                    <div class="inner-column">
                        <div class="sec-title">

                            <span class="sub-title">about the company</span>

                            <h2>
                                {{ $about->title ?? 'Providing the best immigration services' }}
                            </h2>

                            <h4>
                                {!! $about->mission ?? 'Canada based immigration consultant agency.' !!}
                            </h4>

                            <div class="text">
                                {!! $about->description ??
                                    'Web designing in a powerful way of just not only professions, however, in a passion for our Company.' !!}
                            </div>

                        </div>

                        <div class="row">
                            <div class="about-block col-lg-6 col-md-6">
                                <div class="inner">
                                    <i class="icon flaticon-passport-16"></i>
                                    <h6 class="title">Best Immigration <br> Services</h6>
                                </div>
                            </div>

                            <div class="text-block col-lg-6 col-md-6">
                                <div class="inner">
                                    <div class="text">
                                        {!! $about->vission ?? 'We believe smart looking website is the first impression.' !!}
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="btm-box">
                            <a href="/page/about-us" class="theme-btn btn-style-one">
                                <span class="btn-title">Discover More</span>
                            </a>
                        </div>

                    </div>
                </div>

                <!-- Image Column -->
                <div class="image-column col-xl-6 col-lg-6 col-md-12 col-sm-12">
                    <div class="inner-column wow fadeInLeft">
                        <div class="row">

                            <div class="column col-lg-6 col-md-6">
                                <div class="image-box">

                                    <figure class="map">
                                        <img src="{{ asset('frontend/images/icons/map.png') }}" alt="">
                                    </figure>

                                    <figure class="image-1 overlay-anim wow fadeInUp">
                                        <img src="{{ !empty($about->image) ? url('upload/about/' . $about->image) : asset('frontend/images/resource/about-1.jpg') }}"
                                            alt="">
                                    </figure>

                                    <figure class="image-2 overlay-anim wow fadeInRight">
                                        <img src="{{ !empty($about->image1)
                                            ? url('upload/about/' . $about->image1)
                                            : asset('frontend/images/resource/about-2.jpg') }}"
                                            alt="">
                                    </figure>

                                </div>
                            </div>

                            <div class="column col-lg-6 col-md-6">
                                <div class="image-box">

                                    <figure class="image-3 overlay-anim wow fadeInLeft">
                                        <img src="{{ !empty($about->image1)
                                            ? url('upload/about/' . $about->image1)
                                            : asset('frontend/images/resource/about-3.jpg') }}"
                                            alt="">
                                    </figure>

                                    <div class="experience bounce-y">
                                        <div class="inner">
                                            <i class="icon flaticon-loyalty"></i>

                                            <div class="text">
                                                <strong>
                                                    {{ $about->experience_no ?? '3800' }}
                                                </strong>

                                                {{ $about->experience_title ?? 'Satisfied Clients' }}
                                            </div>

                                        </div>
                                    </div>

                                </div>
                            </div>

                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>
    <!--End About Section -->



    <!-- Start Education Section -->
    <section class="services-section">
        <div class="auto-container">
            <div class="sec-title text-center">
                <span class="sub-title">our education</span>
                <h2><span class="color3">Our Educational Programs</span></h2>
            </div>

            <!-- Swiper -->
            <div class="swiper educationSwiper">
                <div class="swiper-wrapper">

                    @foreach ($educations as $education)
                        <div class="swiper-slide">
                            <div class="training-block mb-4">
                                <div class="inner-box">
                                    <div class="image-box">
                                        <figure class="image">
                                            <img src="{{ !empty($education->image) ? url('upload/education/' . $education->image) : url('upload/no_image.jpg') }}"
                                                alt="">
                                        </figure>
                                        <div class="overlay">
                                            <a href="{{ route('single.education.page', $education->slug) }}"
                                                class="read-more">
                                                <i class="fa fa-long-arrow-alt-right"></i>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="lower-content">
                                        <a href="{{ route('single.education.page', $education->slug) }}" class="read-more">
                                            <i class="fa fa-long-arrow-alt-right"></i>
                                        </a>
                                        <h5 class="title">
                                            <a href="{{ route('single.education.page', $education->slug) }}">
                                                {{ $education->course_name ?? '' }}
                                            </a>
                                        </h5>
                                        <div class="text">
                                            {!! Str::limit($education->description, 100) !!}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach

                </div>

                <!-- Pagination (optional) -->
                <div class="swiper-pagination"></div>
            </div>
        </div>
    </section>


    <!-- Start Gallery Section -->
    <section class="gallery-section">
        <div class="auto-container">
            <div class="sec-title text-center">
                <span class="sub-title">our gallery</span>
                <h2><span class="color3">Our Recent Gallery</span></h2>
            </div>

            <!-- Swiper -->
            <div class="swiper gallerySwiper">
                <div class="swiper-wrapper">

                    @foreach ($gallerys as $gallery)
                        <div class="swiper-slide">
                            <div class="gallery-block mb-4">
                                <div class="inner-box">
                                    <figure class="image">
                                        <img src="{{ !empty($gallery->image) ? url('upload/gallery/' . $gallery->image) : url('upload/no_image.jpg') }}"
                                            alt="">
                                    </figure>
                                </div>
                            </div>
                        </div>
                    @endforeach

                </div>
                <!-- arrows -->
                <div class="swiper-button-next"></div>
                <div class="swiper-button-prev"></div>
                <!-- dots -->
                <div class="swiper-pagination"></div>
            </div>
        </div>
    </section>
    <!-- End Gallery Section -->

    <!-- Training Section -->
    <section class="training-section">
        <div class="auto-container">
            <div class="sec-title text-center">
                <span class="sub-title">Training & Certification</span>
                <h2><span class="color3">Professional Development</span></h2>
            </div>

            <!-- Swiper -->
            <div class="swiper trainingSwiper">
                <div class="swiper-wrapper">

                    @foreach ($trainings as $training)
                        <div class="swiper-slide">
                            <div class="training-block">
                                <div class="inner-box">
                                    <div class="image-box">
                                        <figure class="image">
                                            <img src="{{ asset('storage/' . $training->image) }}"
                                                alt="{{ $training->title }}">
                                        </figure>
                                        <div class="overlay">
                                            <a href="{{ $training->link ?? '#' }}" class="read-more">
                                                <i class="fa fa-long-arrow-alt-right"></i>
                                            </a>
                                        </div>
                                    </div>

                                    <div class="lower-content">
                                        <a href="{{ $training->link ?? '#' }}" class="read-more">
                                            <i class="fa fa-long-arrow-alt-right"></i>
                                        </a>
                                        <h5 class="title">
                                            <a href="{{ $training->link ?? '#' }}">{{ $training->title }}</a>
                                        </h5>
                                        <div class="text">
                                            {{ Str::limit($training->description, 100) }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach

                </div>

                <!-- dots -->
                <div class="swiper-pagination"></div>
            </div>
        </div>
    </section>
    <!-- End Training Section -->

    <!-- Services Section -->
    <section class="service-section">
        <div class="auto-container">
            <div class="sec-title text-center">
                <span class="sub-title">Services</span>
                <h2><span class="color3">Our Services</span></h2>
            </div>
            <!-- Swiper -->
            <div class="swiper serviceSwiper">
                <div class="swiper-wrapper">

                    @forelse($services as $service)
                        <div class="swiper-slide">
                            <div class="service-block wow fadeInUp">
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
                                            {!! Str::limit($service->description, 80) !!}
                                        </div>

                                        <a href="{{ route('single.service.page', $service->slug) }}" class="read-more">
                                            More <i class="fa fa-long-arrow-right"></i>
                                        </a>
                                    </div>

                                </div>
                            </div>
                        </div>

                    @empty
                        <p>No services found</p>
                    @endforelse

                </div>

                <!-- pagination -->
                <div class="swiper-pagination"></div>
            </div>

        </div>
    </section>
    <!-- End Services Section-->

    <!-- Countries Section -->
    <section class="country-section mt-3">
        <div class="auto-container">
            <div class="sec-title text-center">
                <span class="sub-title">Countries</span>
                <h2><span class="color3">Our Countries</span></h2>
            </div>
            <div class="swiper countrySwiper">
                <div class="swiper-wrapper">

                    @forelse($countries as $country)
                        <div class="swiper-slide">
                            <div class="text-center">
                                <div class="inner-box">
                                    <div class="flag">
                                        @if ($country->flag)
                                            <img src="{{ asset('storage/' . $country->flag) }}"
                                                alt="{{ $country->name }} flag">
                                        @else
                                            <span>No flag</span>
                                        @endif
                                    </div>

                                    <a href="{{ $country->link ?? '#' }}" class="theme-btn">
                                        {{ $country->name }}
                                    </a>
                                </div>
                            </div>
                        </div>

                    @endforeach

                </div>
                <!-- pagination -->
                <div class="swiper-pagination"></div>
            </div>

        </div>
    </section>

    <!--End Countries Section Two -->

    <!-- Team Section -->
    <section class="team-section">
        <div class="auto-container">
            <div class="sec-title text-center">
                <span class="sub-title">our team members</span>
                <h2><span class="color3">Meet Our Experts</span></h2>
            </div>

            <!-- Swiper -->
            <div class="swiper teamSwiper">
                <div class="swiper-wrapper">
                    @foreach ($teams as $team)
                        <div class="swiper-slide">
                            <div class="team-block wow fadeInUp">
                                <div class="inner-box"
                                    style="background: linear-gradient(to right, red, orange, yellow, green);">
                                    <div class="image-box">
                                        <figure class="image">
                                            <a href="#">
                                                <img src="{{ !empty($team->image) ? url('upload/team/' . $team->image) : url('upload/avatar5.png') }}"
                                                    alt="">
                                            </a>
                                        </figure>
                                    </div>
                                    <div class="info-box">
                                        <h5 class="card-title mb-1 text-light font-weight-bold">{{ $team->name }}</h5>

                                        <p class="text-light mb-2">
                                            {{ $team->designation }}
                                        </p>

                                        <p class="mb-1 text-light">
                                            <i class="fa fa-phone"></i> {{ $team->phone }}
                                        </p>

                                        <p class="small text-light mb-0">
                                            {{ $team->address }}
                                        </p>
                                    </div>

                                </div>
                            </div>
                        </div>
                    @endforeach

                </div>

                <!-- pagination -->
                <div class="swiper-pagination"></div>
            </div>
        </div>
    </section>
    <!-- End Team Section -->

    <!-- Agent Section -->
    <section class="team-section">
        <div class="auto-container">

            <div class="sec-title text-center">
                <span class="sub-title">Our Partners</span>
                <h2><span class="color3">Meet our professional Partners</span></h2>
            </div>

            <!-- Swiper -->
            <div class="swiper partnerSwiper">
                <div class="swiper-wrapper">

                    @foreach ($agents as $agent)
                        <div class="swiper-slide">
                            <div class="team-block wow fadeInUp">
                                <div class="inner-box"
                                    style="background: linear-gradient(to right, red, orange, yellow, green);">

                                    <div class="image-box">
                                        <figure class="image">
                                            <a href="#">
                                                <img src="{{ asset('storage/' . $agent->photo) }}" alt="">
                                            </a>
                                        </figure>
                                    </div>

                                    <div class="info-box">
                                        <h5 class="card-title mb-1 text-light font-weight-bold">{{ $agent->agent_name }}
                                        </h5>

                                        <p class="text-light mb-2">
                                            {{ $agent->no_area }}
                                        </p>

                                        <p class="mb-1 text-light">
                                            <i class="fa fa-phone"></i> {{ $agent->mobile_number }}
                                        </p>

                                        {{-- <p class="small text-light mb-0">
                                            {{ $agent->agent_id }}
                                        </p> --}}
                                    </div>

                                </div>
                            </div>
                        </div>
                    @endforeach

                </div>
                <!-- pagination -->
                <div class="swiper-pagination"></div>

            </div>
        </div>
    </section>
    <!-- End Agent Section -->

    <!-- Testimonial Section -->
    <section class="testimonial-section pull-down">
        <div class="bg-image" style="background-image: url({{ asset('frontend/images/background/1.jpg') }})"></div>
        <div class="anim-icons">
            <span class="icon icon-wide-map"></span>
        </div>

        <div class="auto-container">

            <div class="sec-title text-center light">
                <span class="sub-title">our testimonials</span>
                <h2>What they’re talking about<br>the <span class="color3">consultancy</span></h2>
            </div>

            <div class="carousel-outer">
                <div class="testimonial-carousel owl-carousel owl-theme">

                    @forelse($testimonials as $testimonial)
                        <!-- Testimonial Block -->
                        <div class="testimonial-block">
                            <div class="inner-box">

                                <div class="content-box">
                                    <span class="icon fa fa-quote-left"></span>

                                    <div class="rating">
                                        @for ($i = 1; $i <= 5; $i++)
                                            <i class="fa fa-star {{ $i <= $testimonial->rating ? 'checked' : '' }}"></i>
                                        @endfor
                                    </div>

                                    <div class="text">
                                        {{ $testimonial->description }}
                                    </div>
                                </div>

                                <div class="info-box">
                                    <figure class="thumb">
                                        <img src="{{ !empty($testimonial->image) ? url('upload/testimonial/' . $testimonial->image) : url('upload/no_image.jpg') }}"
                                            alt="{{ $testimonial->name }}">
                                    </figure>
                                    <h6 class="name">{{ $testimonial->name ?? 'Anonymous' }}</h6>
                                    <span class="designation">{{ $testimonial->designation ?? 'Customer' }}</span>
                                </div>

                            </div>
                        </div>

                    @empty

                        <!-- Default Testimonial 1 -->
                        <div class="testimonial-block">
                            <div class="inner-box">
                                <div class="content-box">
                                    <span class="icon fa fa-quote-left"></span>
                                    <div class="rating">
                                        <i class="fa fa-star checked"></i>
                                        <i class="fa fa-star checked"></i>
                                        <i class="fa fa-star checked"></i>
                                        <i class="fa fa-star checked"></i>
                                        <i class="fa fa-star checked"></i>
                                    </div>
                                    <div class="text">I was very impressed by the Remons service. Lorem ipsum is
                                        simply
                                        free text used by copy typing refreshing.</div>
                                </div>
                                <div class="info-box">
                                    <figure class="thumb"><img
                                            src="{{ asset('frontend/images/resource/testi-thumb-1.jpg') }}"
                                            alt=""></figure>
                                    <h6 class="name">Jessica Brown</h6>
                                    <span class="designation">Customer</span>
                                </div>
                            </div>
                        </div>

                        <!-- Default Testimonial 2 -->
                        <div class="testimonial-block">
                            <div class="inner-box">
                                <div class="content-box">
                                    <span class="icon fa fa-quote-left"></span>
                                    <div class="rating">
                                        <i class="fa fa-star checked"></i>
                                        <i class="fa fa-star checked"></i>
                                        <i class="fa fa-star checked"></i>
                                        <i class="fa fa-star checked"></i>
                                        <i class="fa fa-star checked"></i>
                                    </div>
                                    <div class="text">I was very impressed by the Remons service. Lorem ipsum is
                                        simply
                                        free text used by copy typing refreshing.</div>
                                </div>
                                <div class="info-box">
                                    <figure class="thumb"><img
                                            src="{{ asset('frontend/images/resource/testi-thumb-2.jpg') }}"
                                            alt=""></figure>
                                    <h6 class="name">Kevin Martin</h6>
                                    <span class="designation">Customer</span>
                                </div>
                            </div>
                        </div>

                        <!-- Default Testimonial 3 -->
                        <div class="testimonial-block">
                            <div class="inner-box">
                                <div class="content-box">
                                    <span class="icon fa fa-quote-left"></span>
                                    <div class="rating">
                                        <i class="fa fa-star checked"></i>
                                        <i class="fa fa-star checked"></i>
                                        <i class="fa fa-star checked"></i>
                                        <i class="fa fa-star checked"></i>
                                        <i class="fa fa-star checked"></i>
                                    </div>
                                    <div class="text">I was very impressed by the Remons service. Lorem ipsum is
                                        simply
                                        free text used by copy typing refreshing.</div>
                                </div>
                                <div class="info-box">
                                    <figure class="thumb"><img
                                            src="{{ asset('frontend/images/resource/testi-thumb-3.jpg') }}"
                                            alt=""></figure>
                                    <h6 class="name">Sarah Albert</h6>
                                    <span class="designation">Customer</span>
                                </div>
                            </div>
                        </div>
                    @endforelse

                </div>
            </div>

        </div>
    </section>
    <!-- End Testimonial Section -->

    <!-- Contact Section -->
    {{-- <section class="contact-section">
        <div class="outer-box">
            <div class="bg bg-pattern-6"></div>
            <div class="auto-container">
                <div class="row">
                    <!-- Title Column -->
                    <div class="title-column col-lg-7 col-md-12 wow fadeInLRight">
                        <div class="inner-column">
                            <div class="sec-title">
                                <span class="sub-title">contact with us</span>
                                <h2>Book your <span class="color3">consultation</span></h2>
                                <div class="text">There cursus massa at urnaaculis estie. Sed aliquamellus vitae
                                    ultrs condmentum leo massa mollis.</div>
                            </div>

                            <ul class="list-style-two">
                                <li><i class="fa fa-check-circle"></i> Making this the first true generator on the
                                    Internet</li>
                                <li><i class="fa fa-check-circle"></i> Lorem Ipsum is not simply random text</li>
                                <li><i class="fa fa-check-circle"></i> If you are going to use a passage</li>
                            </ul>

                            <div class="ceo-info">
                                <figure class="thumb"><img src="{{ asset('frontend/images/resource/ceo-thumb.jpg') }}"
                                        alt="">
                                </figure>
                                <h6 class="name">Aleesha Brown</h6>
                                <div class="designation">CEO & CO Founder</div>
                            </div>
                        </div>
                    </div>

                    <!-- Form Column -->
                    <div class="form-column col-lg-5 col-md-12 col-sm-12">
                        <div class="inner-column">
                            <div class="form-outer">

                                <!-- Contact Form -->
                                <div class="contact-form wow fadeInLeft">
                                    <!--Contact Form-->
                                    <form method="post" action="https://html.kodesolution.com/2023/immigro-html/get"
                                        id="contact-form">
                                        <div class="form-group">
                                            <input type="text" name="full_name" placeholder="Your Name" required>
                                        </div>

                                        <div class="form-group">
                                            <input type="text" name="Email" placeholder="Email Address" required>
                                        </div>

                                        <div class="form-group">
                                            <textarea name="message" placeholder="Write a Message" required></textarea>
                                        </div>

                                        <div class="form-group">
                                            <button class="theme-btn btn-style-three" type="submit"
                                                name="submit-form"><span class="btn-title">Send a
                                                    Message</span></button>
                                        </div>
                                    </form>
                                </div>
                                <!--End Contact Form -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section> --}}
    <!-- End Contact Section -->
@endsection
@push('js')
    <script>
        // education slider
        var swiper = new Swiper(".educationSwiper", {
            slidesPerView: 3,
            spaceBetween: 30,
            loop: true,

            autoplay: {
                delay: 2500, // 2.5 seconds
                disableOnInteraction: false, // user swipe korleo stop hobe na
            },

            navigation: {
                nextEl: ".swiper-button-next",
                prevEl: ".swiper-button-prev",
            },

            pagination: {
                el: ".swiper-pagination",
                clickable: true,
            },

            breakpoints: {
                320: {
                    slidesPerView: 1
                },
                768: {
                    slidesPerView: 2
                },
                1024: {
                    slidesPerView: 3
                }
            }
        });

        // gallery slider
        var swiper = new Swiper(".gallerySwiper", {
            slidesPerView: 3,
            spaceBetween: 20,
            loop: true,

            autoplay: {
                delay: 2000,
                disableOnInteraction: false,
                pauseOnMouseEnter: true,
            },

            navigation: {
                nextEl: ".gallerySwiper .swiper-button-next",
                prevEl: ".gallerySwiper .swiper-button-prev",
            },

            pagination: {
                el: ".gallerySwiper .swiper-pagination",
                clickable: true,
            },

            breakpoints: {
                320: {
                    slidesPerView: 1
                },
                576: {
                    slidesPerView: 2
                },
                992: {
                    slidesPerView: 3
                }
            }
        });

        // training slider
        var swiper = new Swiper(".trainingSwiper", {
            slidesPerView: 3,
            spaceBetween: 30,
            loop: true,

            autoplay: {
                delay: 2500,
                disableOnInteraction: false,
                pauseOnMouseEnter: true,
            },

            navigation: {
                nextEl: ".trainingSwiper .swiper-button-next",
                prevEl: ".trainingSwiper .swiper-button-prev",
            },

            pagination: {
                el: ".trainingSwiper .swiper-pagination",
                clickable: true,
            },

            breakpoints: {
                320: {
                    slidesPerView: 1
                },
                768: {
                    slidesPerView: 2
                },
                1024: {
                    slidesPerView: 3
                }
            }
        });

        // service slider
        var swiper = new Swiper(".serviceSwiper", {
            slidesPerView: 4,
            spaceBetween: 20,
            loop: true,

            autoplay: {
                delay: 2500,
                disableOnInteraction: false,
                pauseOnMouseEnter: true,
            },

            navigation: {
                nextEl: ".serviceSwiper .swiper-button-next",
                prevEl: ".serviceSwiper .swiper-button-prev",
            },

            pagination: {
                el: ".serviceSwiper .swiper-pagination",
                clickable: true,
            },

            breakpoints: {
                320: {
                    slidesPerView: 1
                },
                576: {
                    slidesPerView: 2
                },
                768: {
                    slidesPerView: 3
                },
                1200: {
                    slidesPerView: 3
                }
            }
        });
        // country slider
        var swiper = new Swiper(".countrySwiper", {
            slidesPerView: 5,
            spaceBetween: 20,
            loop: true,
            speed: 4000, // smooth speed

            autoplay: {
                delay: 0, // no delay = continuous scroll
                disableOnInteraction: false,
            },

            freeMode: true,
            freeModeMomentum: false,

            breakpoints: {
                320: {
                    slidesPerView: 2
                },
                576: {
                    slidesPerView: 3
                },
                768: {
                    slidesPerView: 4
                },
                1024: {
                    slidesPerView: 3
                }
            }
        });
        // team section
        var swiper = new Swiper(".teamSwiper", {
            slidesPerView: 3,
            spaceBetween: 30,
            loop: true,

            autoplay: {
                delay: 2500,
                disableOnInteraction: false,
                pauseOnMouseEnter: true,
            },

            navigation: {
                nextEl: ".teamSwiper .swiper-button-next",
                prevEl: ".teamSwiper .swiper-button-prev",
            },

            pagination: {
                el: ".teamSwiper .swiper-pagination",
                clickable: true,
            },

            breakpoints: {
                320: {
                    slidesPerView: 1
                },
                576: {
                    slidesPerView: 2
                },
                992: {
                    slidesPerView: 3
                }
            }
        });
        // partner section
        var swiper = new Swiper(".partnerSwiper", {
            slidesPerView: 3,
            spaceBetween: 30,
            loop: true,

            autoplay: {
                delay: 2500,
                disableOnInteraction: false,
                pauseOnMouseEnter: true,
            },

            navigation: {
                nextEl: ".partnerSwiper .swiper-button-next",
                prevEl: ".partnerSwiper .swiper-button-prev",
            },

            pagination: {
                el: ".partnerSwiper .swiper-pagination",
                clickable: true,
            },

            breakpoints: {
                320: {
                    slidesPerView: 1
                },
                576: {
                    slidesPerView: 2
                },
                992: {
                    slidesPerView: 3
                }
            }
        });
    </script>
@endpush
