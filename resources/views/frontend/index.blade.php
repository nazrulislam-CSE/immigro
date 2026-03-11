@extends('layouts.frontend.app')
@section('content')
    <!-- Main Slider -->
    <section class="main-slider">
        <div class="rev_slider_wrapper fullwidthbanner-container" id="rev_slider_one_wrapper" data-source="gallery">
            <div class="rev_slider fullwidthabanner" id="rev_slider_one" data-version="5.4.1">
                <ul>
                    @forelse ($sliders as $slider)
                        <li data-index="rs-{{ $loop->iteration }}" data-transition="zoomout">
                            <!-- MAIN IMAGE -->
                            <img src="{{ asset('upload/slider/' . $slider->image) }}" alt="" class="rev-slidebg">
                        </li>
                    @empty
                        <!-- Default Slider -->
                        <li data-index="rs-1" data-transition="zoomout">
                            <img src="{{ asset('frontend/images/main-slider/1.jpg') }}" alt="" class="rev-slidebg">
                        </li>
                    @endforelse
                </ul>
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
                                {{ $about->mission ?? 'Canada based immigration consultant agency.' }}
                            </h4>

                            <div class="text">
                                {{ $about->description ?? 'Web designing in a powerful way of just not only professions, however, in a passion for our Company.' }}
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
                                        {{ $about->vission ?? 'We believe smart looking website is the first impression.' }}
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="btm-box">
                            <a href="#" class="theme-btn btn-style-one">
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
    <!--Emd About Section -->

    <!-- Why Choose US -->
    <section class="why-choose-us pt-0">
        <div class="bg bg-pattern-1"></div>

        <div class="auto-container">
            <div class="sec-title text-center">
                <span class="sub-title">countries you can visit</span>
                <h2>Few reasons to choose <br>our visa <span class="color3">company</span></h2>
            </div>

            <div class="row">
                <!-- Features Block -->
                <div class="feature-block col-xl-3 col-lg-6 col-md-6 col-sm-12 wow fadeInUp">
                    <div class="inner-box">
                        <i class="icon flaticon-interview"></i>
                        <span class="cat">The eget mattis</span>
                        <h6 class="title"><a href="page-about.html">Direct Interviews</a></h6>
                    </div>
                </div>

                <!-- Features Block -->
                <div class="feature-block col-xl-3 col-lg-6 col-md-6 col-sm-12 wow fadeInUp" data-wow-delay="300ms">
                    <div class="inner-box">
                        <div class="content">
                            <i class="icon flaticon-low-cost"></i>
                            <span class="cat">The eget mattis</span>
                            <h6 class="title"><a href="page-about.html">Cost Effective</a></h6>
                        </div>
                    </div>
                </div>

                <!-- Features Block -->
                <div class="feature-block col-xl-3 col-lg-6 col-md-6 col-sm-12 wow fadeInUp" data-wow-delay="600ms">
                    <div class="inner-box">
                        <div class="content">
                            <i class="icon flaticon-loyalty"></i>
                            <span class="cat">The eget mattis</span>
                            <h6 class="title"><a href="page-about.html">Trusted Customers</a></h6>
                        </div>
                    </div>
                </div>

                <!-- Features Block -->
                <div class="feature-block col-xl-3 col-lg-6 col-md-6 col-sm-12 wow fadeInUp" data-wow-delay="900ms">
                    <div class="inner-box">
                        <div class="content">
                            <i class="icon flaticon-online-support"></i>
                            <span class="cat">The eget mattis</span>
                            <h6 class="title"><a href="page-about.html">Support Team</a></h6>
                        </div>
                    </div>
                </div>
            </div>

            <div class="bottom-text">Top rated by customers & immigration firms with 100% success rate. <a
                    href="page-service.html" class="theme-btn btn-style-two">Discover More</a></div>
        </div>
    </section>
    <!--Emd Why Choose US -->

    <!-- Training Section -->
    <section class="training-section">
        <div class="bg bg-pattern-2"></div>
        <div class="bg bg-image" style="background-image: url({{ asset('frontend/images/resource/image-1.jpg') }})">
        </div>
        <div class="auto-container">
            <div class="sec-title">
                <span class="sub-title">Training & Certification</span>
                <h2>Get the Immigration <br> Trainings you <span class="color3">Deserve</span></h2>
                <a href="#" class="theme-btn btn-style-two">Discover More</a>
            </div>

            <div class="carousel-outer">
                <div class="training-carousel owl-carousel owl-theme">
                    @foreach ($trainings as $training)
                        <!-- Training Block -->
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
                                    <div class="text">{{ $training->description }}</div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
    <!-- End Training Section -->

    <!-- Services Section -->
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
    <!-- End Services Section-->

    <!-- Countries Section -->
    <section class="countries-section pt-0">
        <div class="auto-container">
            <div class="sec-title text-center">
                <span class="sub-title">countries you can visit</span>
                <h2>Countries we’re supporting <br>for the <span class="color3">immigration</span></h2>
            </div>

            <div class="carousel-outer">
                <!-- Countries Carousel -->
                <div class="countries-carousel owl-carousel owl-theme">
                    @foreach ($countries as $country)
                        <!-- Country Block-->
                        <div class="country-block">
                            <div class="inner-box">
                                <div class="flag">
                                    @if ($country->flag)
                                        <img src="{{ asset('storage/' . $country->flag) }}"
                                            alt="{{ $country->name }} flag">
                                    @else
                                        <span>No flag</span>
                                    @endif
                                </div>
                                <a href="{{ $country->link ?? '#' }}" class="theme-btn">{{ $country->name }}</a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
    <!--End Countries Section Two -->

    <!-- Clients Section   -->
    <section class="clients-section">
        <div class="auto-container">

            <div class="sponsors-outer">

                <ul class="clients-carousel owl-carousel owl-theme">

                    @forelse($partners as $partner)
                        <li class="slide-item">
                            <a href="{{ url('partner/' . $partner->slug) }}">

                                <img src="{{ !empty($partner->image) ? url('upload/partner/' . $partner->image) : url('upload/no_image.jpg') }}"
                                    alt="{{ $partner->name }}">

                            </a>
                        </li>

                    @empty

                        <!-- Default Client -->
                        <li class="slide-item">
                            <a href="#">
                                <img src="{{ asset('frontend/images/resource/client.png') }}" alt="">
                            </a>
                        </li>

                        <li class="slide-item">
                            <a href="#">
                                <img src="{{ asset('frontend/images/resource/client.png') }}" alt="">
                            </a>
                        </li>

                        <li class="slide-item">
                            <a href="#">
                                <img src="{{ asset('frontend/images/resource/client.png') }}" alt="">
                            </a>
                        </li>

                        <li class="slide-item">
                            <a href="#">
                                <img src="{{ asset('frontend/images/resource/client.png') }}" alt="">
                            </a>
                        </li>

                        <li class="slide-item">
                            <a href="#">
                                <img src="{{ asset('frontend/images/resource/client.png') }}" alt="">
                            </a>
                        </li>
                    @endforelse

                </ul>

            </div>

        </div>
    </section>
    <!--End Clients Section -->

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
                                    <div class="text">I was very impressed by the Remons service. Lorem ipsum is simply
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
                                    <div class="text">I was very impressed by the Remons service. Lorem ipsum is simply
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
                                    <div class="text">I was very impressed by the Remons service. Lorem ipsum is simply
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
    <section class="contact-section">
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
                                        alt=""></figure>
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
    </section>
    <!-- End Contact Section -->
@endsection
