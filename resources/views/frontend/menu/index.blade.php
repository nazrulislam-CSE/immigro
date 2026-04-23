@extends('layouts.frontend.app', ['pageTitle' => $page->page_title])

@section('content')
    @php
        $currentUrl = url()->current();
        $branches = App\Models\Branch::where('status', 1)->latest()->get();
    @endphp
    @if ($page->page_slug == 'visa-service')
        <!-- Start main-content -->
        <section class="page-title"
            style="margin-top: 20px !important; padding: 80px 0 !important; background-image: url({{ !empty($page->image) ? url('upload/page/' . $page->image) : url('frontend/img/slider/7.jpg') }});">
            <div class="auto-container">
                <div class="title-outer">
                    <h1 class="title">{{ $page->page_title }}</h1>
                    <ul class="page-breadcrumb">
                        <li><a href="{{ route('frontend.home') }}">Home</a></li>
                        <li><a href="#">Pages</a></li>
                        <li>{{ $page->page_title }}</li>
                    </ul>
                </div>
            </div>
        </section>
        <!-- end main-content -->

        <!-- Start Section -->
        <section class="bg-silver-light">
            <div class="container pb-100">
                <div class="row">
                    @foreach ($services as $service)
                        <!-- Course Block-->
                        <div class="col-lg-4 col-md-6 col-sm-12">
                            <!-- Training Block Three-->
                            <div class="training-block mb-4">
                                <div class="inner-box">
                                    <div class="image-box">
                                        <figure class="image">
                                            <img src="{{ !empty($service->image) ? url('upload/service/' . $service->image) : url('upload/no_image.jpg') }}"
                                                alt="">
                                        </figure>
                                        <div class="overlay">
                                            <a href="{{ route('single.service.page', $service->slug) }}" class="read-more">
                                                <i class="fa fa-long-arrow-alt-right"></i>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="lower-content">
                                        <a href="{{ route('single.service.page', $service->slug) }}" class="read-more">
                                            <i class="fa fa-long-arrow-alt-right"></i></a>
                                        <h5 class="title">
                                            <a
                                                href="{{ route('single.service.page', $service->slug) }}">{{ $service->title }}</a>
                                        </h5>
                                        <div class="text"> {!! Str::limit($service->description, 80) !!}</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
        <!-- End Section-->
    @elseif($page->page_slug == 'team')
        <!-- Start main-content -->
        <section class="page-title"
            style="margin-top: 20px !important; padding: 80px 0 !important; background-image: url({{ !empty($page->image) ? url('upload/page/' . $page->image) : url('frontend/img/slider/7.jpg') }});">
            <div class="auto-container">
                <div class="title-outer">
                    <h1 class="title">{{ $page->page_title }}</h1>
                    <ul class="page-breadcrumb">
                        <li><a href="{{ route('frontend.home') }}">Home</a></li>
                        <li><a href="#">Pages</a></li>
                        <li>{{ $page->page_title }}</li>
                    </ul>
                </div>
            </div>
        </section>
        <!-- end main-content -->

        <!-- Team Section -->
        <section class="team-section">
            <div class="auto-container">
                <div class="sec-title text-center">
                    <span class="sub-title">our team members</span>
                    <h2>Meet our qualified visa & <br>immigration <span class="color3">experts</span></h2>
                </div>

                <div class="row">
                    <!-- Team block -->
                    @foreach ($teams as $team)
                        <div class="team-block col-lg-4 col-md-6 col-sm-12 wow fadeInUp">
                            <div class="inner-box">
                                <div class="image-box">
                                    <figure class="image"><a href="#"><img
                                                src="{{ !empty($team->image) ? url('upload/team/' . $team->image) : url('upload/avatar5.png') }}"
                                                alt=""></a></figure>
                                </div>
                                <div class="info-box">
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
        <!-- End Team Section -->
    @elseif($page->page_slug == 'office-address')
        <!-- Start main-content -->
        <section class="page-title"
            style="margin-top: 20px !important; padding: 80px 0 !important; background-image: url({{ !empty($page->image) ? url('upload/page/' . $page->image) : url('frontend/img/slider/7.jpg') }});">
            <div class="auto-container">
                <div class="title-outer">
                    <h1 class="title">{{ $page->page_title }}</h1>
                    <ul class="page-breadcrumb">
                        <li><a href="{{ route('frontend.home') }}">Home</a></li>
                        <li><a href="#">Pages</a></li>
                        <li>{{ $page->page_title }}</li>
                    </ul>
                </div>
            </div>
        </section>
        <!-- end main-content -->

        <!-- Start Section -->
        <section class="bg-silver-light">
            <div class="container pb-100">
                <div class="row">
                    @foreach ($branches as $branch)
                        <div class="col-md-6 col-lg-4 mb-4">
                            <div class="card h-100 border-0 shadow-lg">

                                <!-- Header -->
                                <div class="card-header bg-success text-white text-center py-3">
                                    <h5 class="fw-bold mb-0 text-white">
                                        <i class="fa-solid fa-address-card me-2"></i>
                                        {{ $branch->branch_name }}
                                    </h5>
                                </div>

                                <!-- Body -->
                                <div class="card-body">

                                    <!-- Primary Contact -->
                                    <div class="d-flex align-items-center mb-3 p-2 bg-light rounded">
                                        <i class="fas fa-phone-alt text-primary me-3"></i>
                                        <a href="tel:{{ $branch->contact_no }}"
                                            class="fw-bold text-dark text-decoration-none">
                                            {{ $branch->contact_no }}
                                        </a>
                                    </div>

                                    <!-- Optional Contact -->
                                    @if ($branch->contact_no_optional)
                                        <div class="d-flex align-items-center mb-3 p-2 bg-light rounded">
                                            <i class="fas fa-phone-alt text-info me-3"></i>
                                            <a href="tel:{{ $branch->contact_no_optional }}"
                                                class="fw-bold text-dark text-decoration-none">
                                                {{ $branch->contact_no_optional }}
                                            </a>
                                        </div>
                                    @endif

                                    <!-- Location -->
                                    @if ($branch->area_link)
                                        <div class="d-flex align-items-start p-2 bg-light rounded">
                                            <i class="fas fa-map-marker-alt text-danger me-3 mt-1"></i>
                                            <div class="fw-bold small">
                                                {!! $branch->area_link !!}
                                            </div>
                                        </div>
                                    @endif

                                </div>

                                <!-- Footer -->
                                <div class="card-footer bg-white text-center">
                                    <a href="tel:{{ $branch->contact_no }}" class="btn btn-success btn-sm w-100 fw-bold">
                                        <i class="fas fa-phone me-1"></i> Call Now
                                    </a>
                                </div>

                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @elseif($page->page_slug == 'education')
          <!-- Start main-content -->
        <section class="page-title"
            style="margin-top: 20px !important; padding: 80px 0 !important; background-image: url({{ !empty($page->image) ? url('upload/page/' . $page->image) : url('frontend/img/slider/7.jpg') }});">
            <div class="auto-container">
                <div class="title-outer">
                    <h1 class="title">{{ $page->page_title }}</h1>
                    <ul class="page-breadcrumb">
                        <li><a href="{{ route('frontend.home') }}">Home</a></li>
                        <li><a href="#">Pages</a></li>
                        <li>{{ $page->page_title }}</li>
                    </ul>
                </div>
            </div>
        </section>
        <!-- end main-content -->

        <!-- Start Section -->
        <section class="bg-silver-light">
            <div class="container pb-100">
                <div class="row">
                    @foreach ($educations as $education)
                        <div class="col-lg-4 col-md-6 col-sm-12">
                            <!-- Training Block Three-->
                            <div class="training-block mb-4">
                                <div class="inner-box">
                                    <div class="image-box">
                                        <figure class="image"><img
                                                src="{{ !empty($education->image) ? url('upload/education/' . $education->image) : url('upload/no_image.jpg') }}"
                                                alt="">
                                        </figure>
                                        <div class="overlay"><a
                                                href="{{ route('single.education.page', $education->slug) }}"
                                                class="read-more"><i class="fa fa-long-arrow-alt-right"></i></a></div>
                                    </div>
                                    <div class="lower-content">
                                        <a href="{{ route('single.education.page', $education->slug) }}"
                                            class="read-more"><i class="fa fa-long-arrow-alt-right"></i></a>
                                        <h5 class="title"><a
                                                href="{{ route('single.education.page', $education->slug) }}">
                                                {{ $education->course_name ?? '' }}
                                            </a></h5>
                                        <div class="text">
                                            {!! Str::limit($education->description, 100) !!}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @elseif($page->page_slug == 'about-us')
        <!-- Start main-content -->
        <section class="page-title"
            style="margin-top: 20px !important; padding: 80px 0 !important; background-image: url({{ !empty($page->image) ? url('upload/page/' . $page->image) : url('frontend/img/slider/7.jpg') }});">
            <div class="auto-container">
                <div class="title-outer">
                    <h1 class="title">{{ $page->page_title }}</h1>
                    <ul class="page-breadcrumb">
                        <li><a href="{{ route('frontend.home') }}">Home</a></li>
                        <li><a href="#">Pages</a></li>
                        <li>{{ $page->page_title }}</li>
                    </ul>
                </div>
            </div>
        </section>
        <!-- end main-content -->

        <!-- Start Section -->
        <section class="bg-silver-light">
            <div class="container pb-100">
                <div class="row">
                    <!-- Content Column -->
                    <div class="content-column col-xl-6 col-lg-6 col-md-12 col-sm-12 wow fadeInRight"
                        data-wow-delay="600ms">
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
    @elseif($page->page_slug == 'apply-now')
        <!-- Start main-content -->
        <section class="page-title"
            style="margin-top: 20px !important; padding: 80px 0 !important; background-image: url({{ !empty($page->image) ? url('upload/page/' . $page->image) : url('frontend/img/slider/7.jpg') }});">
            <div class="auto-container">
                <div class="title-outer">
                    <h1 class="title">{{ $page->page_title }}</h1>
                    <ul class="page-breadcrumb">
                        <li><a href="{{ route('frontend.home') }}">Home</a></li>
                        <li><a href="#">Pages</a></li>
                        <li>{{ $page->page_title }}</li>
                    </ul>
                </div>
            </div>
        </section>
        <!-- end main-content -->

        <!-- Start Section -->
        <section class="bg-silver-light">
            <div class="container pb-100">
                <div class="row justify-content-center">
                    <div class="col-lg-12">
                        <div class="position-relative elements-block"
                            style="background: #f1ff2a;background: linear-gradient(90deg, rgb(155, 42, 42) 0%, rgba(87, 199, 133, 1) 50%, rgba(237, 221, 83, 1) 100%);">
                            <div class="inner-title text-center">
                                <h2 class="text-light">{{ $page->page_title ?? 'n/a' }} Student</h2>
                            </div>
                            <div class="primary-shadow p-1-9 p-md-5 shadow-lg">
                                <form class="" action="{{ route('ielts.store') }}" method="post"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" name="page_name" value="{{ $page->page_slug ?? '' }}">
                                    <div class="quform-elements">
                                        <div class="row">
                                            <!-- Begin Text input element -->
                                            <div class="col-md-6">
                                                <div class="quform-element form-group">
                                                    <label class="text-light" for="first_name">First Name</label>
                                                    <div class="quform-input">
                                                        <input class="form-control" id="first_name" type="text"
                                                            name="first_name" placeholder="Your First Name here"
                                                            required />
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- End Text input element -->
                                            <!-- Begin Text input element -->
                                            <div class="col-md-6">
                                                <div class="quform-element form-group">
                                                    <label class="text-light" for="last_name">Last Name</label>
                                                    <div class="quform-input">
                                                        <input class="form-control" id="last_name" type="text"
                                                            name="last_name" placeholder="Your Last Name here" required />
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- End Text input element -->

                                            <!-- Begin Text input element -->
                                            <div class="col-md-6">
                                                <div class="quform-element form-group">
                                                    <label class="text-light" for="phone">Phone Number</label>
                                                    <div class="quform-input">
                                                        <input class="form-control" id="phone" type="number"
                                                            min="0" name="phone"
                                                            placeholder="Your Phone Number here" required />
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- End Text input element -->

                                            <!-- Begin Text input element -->
                                            <div class="col-md-6">
                                                <div class="quform-element form-group">
                                                    <label class="text-light" for="email">Email</label>
                                                    <div class="quform-input">
                                                        <input class="form-control" id="email" type="email"
                                                            name="email" placeholder="Your email here" required />
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- End Text input element -->

                                            <!-- Begin Text input element -->
                                            <div class="col-md-6">
                                                <div class="quform-element form-group">
                                                    <label class="text-light" for="birth_day">Date of Birth</label>
                                                    <div class="quform-input">
                                                        <input class="form-control" id="birth_day" type="date"
                                                            name="birth_day" placeholder="Your Date Of Birth  here"
                                                            required />
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- End Text input element -->

                                            <!-- Begin Text input element -->
                                            <div class="col-md-6">
                                                <div class="quform-element form-group">
                                                    <label class="text-light" for="school_name">School Name</label>
                                                    <div class="quform-input">
                                                        <input class="form-control" id="school_name" type="text"
                                                            name="school_name" placeholder="Your School Name here"
                                                            required />
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- End Text input element -->

                                            <!-- Begin Text input element -->
                                            <div class="col-md-6">
                                                <div class="quform-element form-group">
                                                    <label class="text-light" for="school_passing_year">Passing
                                                        Year</label>
                                                    <div class="quform-input">
                                                        <?php
                                                        // Assuming you want the range of years from current year to 30 years back
                                                        $currentYear = date('Y');
                                                        $yearsBack = 30;
                                                        ?>

                                                        <select name="school_passing_year" class="form-control"
                                                            id="school_passing_year" required>
                                                            <option value="">Select Passing Year</option>
                                                            <?php
                                                            for ($i = $currentYear; $i >= $currentYear - $yearsBack; $i--) {
                                                                echo "<option value='$i'>$i</option>";
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- End Text input element -->

                                            <!-- Begin Text input element -->
                                            <div class="col-md-6">
                                                <div class="quform-element form-group">
                                                    <label class="text-light" for="school_gpa">GPA</label>
                                                    <div class="quform-input">
                                                        <input class="form-control" id="school_gpa" type="number"
                                                            min="0" name="school_gpa" placeholder="Your GPA here"
                                                            required />
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- End Text input element -->

                                            <!-- Begin Text input element -->
                                            <div class="col-md-6">
                                                <div class="quform-element form-group">
                                                    <label class="text-light" for="collage_name">Collage Name</label>
                                                    <div class="quform-input">
                                                        <input class="form-control" id="collage_name" type="text"
                                                            name="collage_name" placeholder="Your Collage Name here"
                                                            required />
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- End Text input element -->

                                            <!-- Begin Text input element -->
                                            <div class="col-md-6">
                                                <div class="quform-element form-group">
                                                    <label class="text-light" for="collage_passing_year">Passing
                                                        Year</label>
                                                    <div class="quform-input">
                                                        <?php
                                                        // Assuming you want the range of years from current year to 30 years back
                                                        $currentYear = date('Y');
                                                        $yearsBack = 30;
                                                        ?>

                                                        <select name="collage_passing_year" class="form-control"
                                                            id="collage_passing_year" required>
                                                            <option value="">Select Passing Year</option>
                                                            <?php
                                                            for ($i = $currentYear; $i >= $currentYear - $yearsBack; $i--) {
                                                                echo "<option value='$i'>$i</option>";
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- End Text input element -->

                                            <!-- Begin Text input element -->
                                            <div class="col-md-6">
                                                <div class="quform-element form-group">
                                                    <label class="text-light" for="collage_gpa">GPA</label>
                                                    <div class="quform-input">
                                                        <input class="form-control" id="collage_gpa" type="number"
                                                            min="0" name="collage_gpa" placeholder="Your GPA here"
                                                            required />
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- End Text input element -->

                                            <!-- Begin Text input element -->
                                            <div class="col-md-6">
                                                <div class="quform-element form-group">
                                                    <label class="text-light" for="department">Department</label>
                                                    <div class="quform-input">
                                                        <select name="department" class="form-control" id="department"
                                                            required>
                                                            <option value="">Chose Your Department</option>
                                                            <option value="science">Science</option>
                                                            <option value="commerce">Commerce</option>
                                                            <option value="arts">Arts</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- End Text input element -->


                                            <!-- Begin Text input element -->
                                            <div class="col-md-6">
                                                <div class="quform-element form-group">
                                                    <label class="text-light" for="subject">Subject Name</label>
                                                    <div class="quform-input">
                                                        <input class="form-control" id="subject" type="text"
                                                            name="subject" placeholder="Your Subject Name here"
                                                            required />
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- End Text input element -->

                                            <!-- Begin Text input element -->
                                            <div class="col-md-6">
                                                <div class="quform-element form-group">
                                                    <label class="text-light" for="country">Interested Country</label>
                                                    <div class="quform-input">
                                                        <select class="form-control select2" name="country"
                                                            id="country" required>
                                                            <option class=""> Select Country </option>
                                                            <option class="" country="Albania" value="AL">
                                                                Albania</option>
                                                            <option class="" country="Algeria" value="DZ">
                                                                Algeria</option>
                                                            <option class="" country="American Samoa"
                                                                value="AS">
                                                                American Samoa</option>
                                                            <option class="" country="Andorra" value="AD">
                                                                Andorra</option>
                                                            <option class="" country="Angola" value="AO">Angola
                                                            </option>
                                                            <option class="" country="Anguilla" value="AI">
                                                                Anguilla</option>
                                                            <option class="" country="Antarctica" value="AQ">
                                                                Antarctica</option>
                                                            <option class="" country="Antigua and Barbuda"
                                                                value="AG">Antigua and Barbuda</option>
                                                            <option class="" country="Argentina" value="AR">
                                                                Argentina</option>
                                                            <option class="" country="Armenia" value="AM">
                                                                Armenia</option>
                                                            <option class="" country="Aruba" value="AW">Aruba
                                                            </option>
                                                            <option class="" country="Australia" value="AU">
                                                                Australia</option>
                                                            <option class="" country="Austria" value="AT">
                                                                Austria</option>
                                                            <option class="" country="Azerbaijan" value="AZ">
                                                                Azerbaijan</option>
                                                            <option class="" country="Bahamas" value="BS">
                                                                Bahamas</option>
                                                            <option class="" country="Bahrain" value="BH">
                                                                Bahrain</option>
                                                            <option class="" country="Bangladesh" value="BD">
                                                                Bangladesh</option>
                                                            <option class="" country="Barbados" value="BB">
                                                                Barbados</option>
                                                            <option class="" country="Belarus" value="BY">
                                                                Belarus</option>
                                                            <option class="" country="Belgium" value="BE">
                                                                Belgium</option>
                                                            <option class="" country="Belize" value="BZ">Belize
                                                            </option>
                                                            <option class="" country="Benin" value="BJ">Benin
                                                            </option>
                                                            <option class="" country="Bermuda" value="BM">
                                                                Bermuda</option>
                                                            <option class="" country="Bhutan" value="BT">Bhutan
                                                            </option>
                                                            <option class="" country="Bolivia" value="BO">
                                                                Bolivia</option>
                                                            <option class="" country="Bosnia and Herzegowina"
                                                                value="BA">Bosnia and Herzegowina</option>
                                                            <option class="" country="Botswana" value="BW">
                                                                Botswana</option>
                                                            <option class="" country="Bouvet Island"
                                                                value="BV">
                                                                Bouvet Island</option>
                                                            <option class="" country="Brazil" value="BR">Brazil
                                                            </option>
                                                            <option class=""
                                                                country="British Indian Ocean Territory" value="IO">
                                                                British Indian Ocean Territory</option>
                                                            <option class="" country="Brunei Darussalam"
                                                                value="BN">Brunei Darussalam</option>
                                                            <option class="" country="Bulgaria" value="BG">
                                                                Bulgaria</option>
                                                            <option class="" country="Burkina Faso" value="BF">
                                                                Burkina Faso</option>
                                                            <option class="" country="Burundi" value="BI">
                                                                Burundi</option>
                                                            <option class="" country="Cambodia" value="KH">
                                                                Cambodia</option>
                                                            <option class="" country="Cameroon" value="CM">
                                                                Cameroon</option>
                                                            <option class="" country="Canada" value="CA">Canada
                                                            </option>
                                                            <option class="" country="Cape Verde" value="CV">
                                                                Cape Verde</option>
                                                            <option class="" country="Cayman Islands"
                                                                value="KY">
                                                                Cayman Islands</option>
                                                            <option class="" country="Central African Republic"
                                                                value="CF">Central African Republic</option>
                                                            <option class="" country="Chad" value="TD">Chad
                                                            </option>
                                                            <option class="" country="Chile" value="CL">Chile
                                                            </option>
                                                            <option class="" country="China" value="CN">China
                                                            </option>
                                                            <option class="" country="Christmas Island"
                                                                value="CX">
                                                                Christmas Island</option>
                                                            <option class="" country="Cocos (Keeling) Islands"
                                                                value="CC">Cocos (Keeling) Islands</option>
                                                            <option class="" country="Colombia" value="CO">
                                                                Colombia</option>
                                                            <option class="" country="Comoros" value="KM">
                                                                Comoros</option>
                                                            <option class="" country="Congo" value="CG">Congo
                                                            </option>
                                                            <option class=""
                                                                country="Congo, the Democratic Republic of the"
                                                                value="CD">Congo, the Democratic Republic of the
                                                            </option>
                                                            <option class="" country="Cook Islands" value="CK">
                                                                Cook Islands</option>
                                                            <option class="" country="Costa Rica" value="CR">
                                                                Costa Rica</option>
                                                            <option class="" country="Cote d'Ivoire"
                                                                value="CI">
                                                                Cote d'Ivoire</option>
                                                            <option class="" country="Croatia (Hrvatska)"
                                                                value="HR">Croatia (Hrvatska)</option>
                                                            <option class="" country="Cuba" value="CU">Cuba
                                                            </option>
                                                            <option class="" country="Cyprus" value="CY">Cyprus
                                                            </option>
                                                            <option class="" country="Czech Republic"
                                                                value="CZ">
                                                                Czech Republic</option>
                                                            <option class="" country="Denmark" value="DK">
                                                                Denmark</option>
                                                            <option class="" country="Djibouti" value="DJ">
                                                                Djibouti</option>
                                                            <option class="" country="Dominica" value="DM">
                                                                Dominica</option>
                                                            <option class="" country="Dominican Republic"
                                                                value="DO">Dominican Republic</option>
                                                            <option class="" country="East Timor" value="TP">
                                                                East Timor</option>
                                                            <option class="" country="Ecuador" value="EC">
                                                                Ecuador</option>
                                                            <option class="" country="Egypt" value="EG">Egypt
                                                            </option>
                                                            <option class="" country="El Salvador" value="SV">
                                                                El Salvador</option>
                                                            <option class="" country="Equatorial Guinea"
                                                                value="GQ">Equatorial Guinea</option>
                                                            <option class="" country="Eritrea" value="ER">
                                                                Eritrea</option>
                                                            <option class="" country="Estonia" value="EE">
                                                                Estonia</option>
                                                            <option class="" country="Ethiopia" value="ET">
                                                                Ethiopia</option>
                                                            <option class="" country="Falkland Islands (Malvinas)"
                                                                value="FK">Falkland Islands (Malvinas)</option>
                                                            <option class="" country="Faroe Islands"
                                                                value="FO">
                                                                Faroe Islands</option>
                                                            <option class="" country="Fiji" value="FJ">Fiji
                                                            </option>
                                                            <option class="" country="Finland" value="FI">
                                                                Finland</option>
                                                            <option class="" country="France" value="FR">France
                                                            </option>
                                                            <option class="" country="rance, Metropolitan"
                                                                value="FX">France, Metropolitan</option>
                                                            <option class="" country="French Guiana"
                                                                value="GF">
                                                                French Guiana</option>
                                                            <option class="" country="French Polynesia"
                                                                value="PF">
                                                                French Polynesia</option>
                                                            <option class="" country="French Southern Territories"
                                                                value="TF">French Southern Territories</option>
                                                            <option class="" country="Gabon" value="GA">Gabon
                                                            </option>
                                                            <option class="" country="Gambia" value="GM">Gambia
                                                            </option>
                                                            <option class="" country="Georgia" value="GE">
                                                                Georgia</option>
                                                            <option class="" country="Germany" value="DE">
                                                                Germany</option>
                                                            <option class="" country="Ghana" value="GH">Ghana
                                                            </option>
                                                            <option class="" country="Gibraltar" value="GI">
                                                                Gibraltar</option>
                                                            <option class="" country="Greece" value="GR">Greece
                                                            </option>
                                                            <option class="" country="Greenland" value="GL">
                                                                Greenland</option>
                                                            <option class="" country="Grenada" value="GD">
                                                                Grenada</option>
                                                            <option class="" country="Guadeloupe" value="GP">
                                                                Guadeloupe</option>
                                                            <option class="" country="Guam" value="GU">Guam
                                                            </option>
                                                            <option class="" country="Guatemala" value="GT">
                                                                Guatemala</option>
                                                            <option class="" country="Guinea" value="GN">Guinea
                                                            </option>
                                                            <option class="" country="Guinea-Bissau"
                                                                value="GW">
                                                                Guinea-Bissau</option>
                                                            <option class="" country="Guyana" value="GY">Guyana
                                                            </option>
                                                            <option class="" country="Haiti" value="HT">Haiti
                                                            </option>
                                                            <option class="" country="Heard and Mc Donald Islands"
                                                                value="HM">Heard and Mc Donald Islands</option>
                                                            <option class="" country="Holy See (Vatican City State)"
                                                                value="VA">Holy See (Vatican City State)</option>
                                                            <option class="" country="Honduras" value="HN">
                                                                Honduras</option>
                                                            <option class="" country="Hong Kong" value="HK">
                                                                Hong Kong</option>
                                                            <option class="" country="Hungary" value="HU">
                                                                Hungary</option>
                                                            <option class="" country="Iceland" value="IS">
                                                                Iceland</option>
                                                            <option class="" country="India" value="IN">India
                                                            </option>
                                                            <option class="" country="Indonesia" value="ID">
                                                                Indonesia</option>
                                                            <option class="" country="Iran (Islamic Republic of)"
                                                                value="IR">Iran (Islamic Republic of)</option>
                                                            <option class="" country="Iraq" value="IQ">Iraq
                                                            </option>
                                                            <option class="" country="Ireland" value="IE">
                                                                Ireland</option>
                                                            <option class="" country="Israel" value="IL">Israel
                                                            </option>
                                                            <option class="" country="Italy" value="IT">Italy
                                                            </option>
                                                            <option class="" country="Jamaica" value="JM">
                                                                Jamaica</option>
                                                            <option class="" country="Japan" value="JP">Japan
                                                            </option>
                                                            <option class="" country="Jordan" value="JO">Jordan
                                                            </option>
                                                            <option class="" country="Kazakhstan" value="KZ">
                                                                Kazakhstan</option>
                                                            <option class="" country="KenyaKenya" value="KE">
                                                                Kenya</option>
                                                            <option class="" country="Kiribati" value="KI">
                                                                Kiribati</option>
                                                            <option class=""
                                                                country="Korea, Democratic People's Republic of"
                                                                value="KP">Korea, Democratic People's Republic of
                                                            </option>
                                                            <option class="" country="Korea, Republic of"
                                                                value="KR">Korea, Republic of</option>
                                                            <option class="" country="Kuwait" value="KW">Kuwait
                                                            </option>
                                                            <option class="" country="Kyrgyzstan" value="KG">
                                                                Kyrgyzstan</option>
                                                            <option class=""
                                                                country="Lao People's Democratic Republic" value="LA">
                                                                Lao People's Democratic Republic</option>
                                                            <option class="" country="Latvia" value="LV">Latvia
                                                            </option>
                                                            <option class="" country="Lebanon" value="LB">
                                                                Lebanon</option>
                                                            <option class="" country="Lesotho" value="LS">
                                                                Lesotho</option>
                                                            <option class="" country="Liberia" value="LR">
                                                                Liberia</option>
                                                            <option class="" country="Libyan Arab Jamahiriya"
                                                                value="LY">Libyan Arab Jamahiriya</option>
                                                            <option class="" country="Liechtenstein"
                                                                value="LI">
                                                                Liechtenstein</option>
                                                            <option class="" country="Lithuania" value="LT">
                                                                Lithuania</option>
                                                            <option class="" country="Luxembourg" value="LU">
                                                                Luxembourg</option>
                                                            <option class="" country="Macau" value="MO">Macau
                                                            </option>
                                                            <option class="" country="North Macedonia"
                                                                value="MK">
                                                                North Macedonia</option>
                                                            <option class="" country="Madagascar" value="MG">
                                                                Madagascar</option>
                                                            <option class="" country="Malawi" value="MW">Malawi
                                                            </option>
                                                            <option class="" country="Malaysia" value="MY">
                                                                Malaysia</option>
                                                            <option class="" country="Maldives" value="MV">
                                                                Maldives</option>
                                                            <option class="" country="Mali" value="ML">Mali
                                                            </option>
                                                            <option class="" country="Malta" value="MT">Malta
                                                            </option>
                                                            <option class="" country="Marshall Islands"
                                                                value="MH">
                                                                Marshall Islands</option>
                                                            <option class="" country="Martinique" value="MQ">
                                                                Martinique</option>
                                                            <option class="" country="Mauritania" value="MR">
                                                                Mauritania</option>
                                                            <option class="" country="Mauritius" value="MU">
                                                                Mauritius</option>
                                                            <option class="" country="Mayotte" value="YT">
                                                                Mayotte</option>
                                                            <option class="" country="Mexico" value="MX">Mexico
                                                            </option>
                                                            <option class=""
                                                                country="Micronesia, Federated States of" value="FM">
                                                                Micronesia, Federated States of</option>
                                                            <option class="" country="Moldova, Republic of"
                                                                value="MD">Moldova, Republic of</option>
                                                            <option class="" country="Monaco" value="MC">Monaco
                                                            </option>
                                                            <option class="" country="Mongolia" value="MN">
                                                                Mongolia</option>
                                                            <option class="" country="Montserrat" value="MS">
                                                                Montserrat</option>
                                                            <option class="" country="Morocco" value="MA">
                                                                Morocco</option>
                                                            <option class="" country="Myanmar" value="MM">
                                                                Myanmar</option>
                                                            <option class="" country="Namibia" value="NA">
                                                                Namibia</option>
                                                            <option class="" country="Nauru" value="NR">Nauru
                                                            </option>
                                                            <option class="" country="Nepal" value="NP">Nepal
                                                            </option>
                                                            <option class="" country="Netherlands" value="NL">
                                                                Netherlands</option>
                                                            <option class="" country="Netherlands Antilles"
                                                                value="AN">Netherlands Antilles</option>
                                                            <option class="" country="New Caledonia"
                                                                value="NC">New
                                                                Caledonia</option>
                                                            <option class="" country="New Zealand" value="NZ">
                                                                New Zealand</option>
                                                            <option class="" country="Nicaragua" value="NI">
                                                                Nicaragua</option>
                                                            <option class="" country="Niger" value="NE">Niger
                                                            </option>
                                                            <option class="" country="Nigeria" value="NG">
                                                                Nigeria</option>
                                                            <option class="" country="Niue" value="NU">Niue
                                                            </option>
                                                            <option class="" country="Norfolk Island"
                                                                value="NF">
                                                                Norfolk Island</option>
                                                            <option class="" country="Northern Mariana Islands"
                                                                value="MP">Northern Mariana Islands</option>
                                                            <option class="" country="Norway" value="NO">Norway
                                                            </option>
                                                            <option class="" country="Oman" value="OM">Oman
                                                            </option>
                                                            <option class="" country="Pakistan" value="PK">
                                                                Pakistan</option>
                                                            <option class="" country="Palau" value="PW">Palau
                                                            </option>
                                                            <option class="" country="Panama" value="PA">Panama
                                                            </option>
                                                            <option class="" country="Papua New Guinea"
                                                                value="PG">
                                                                Papua New Guinea</option>
                                                            <option class="" country="Paraguay" value="PY">
                                                                Paraguay</option>
                                                            <option class="" country="Peru" value="PE">Peru
                                                            </option>
                                                            <option class="" country="Philippines" value="PH">
                                                                Philippines</option>
                                                            <option class="" country="Pitcairn" value="PN">
                                                                Pitcairn</option>
                                                            <option class="" country="Poland" value="PL">Poland
                                                            </option>
                                                            <option class="" country="Portugal" value="PT">
                                                                Portugal</option>
                                                            <option class="" country="Puerto Rico" value="PR">
                                                                Puerto Rico</option>
                                                            <option class="" country="Qatar" value="QA">Qatar
                                                            </option>
                                                            <option class="" country="Reunion" value="RE">
                                                                Reunion</option>
                                                            <option class="" country="RomaniaRomania"
                                                                value="RO">
                                                                Romania</option>
                                                            <option class="" country="Russian Federation"
                                                                value="RU">Russian Federation</option>
                                                            <option class="" country="Rwanda" value="RW">Rwanda
                                                            </option>
                                                            <option class="" country="Saint Kitts and Nevis"
                                                                value="KN">Saint Kitts and Nevis</option>
                                                            <option class="" country="Saint LUCIA" value="LC">
                                                                Saint LUCIA</option>
                                                            <option class=""
                                                                country="Saint Vincent and the Grenadines" value="VC">
                                                                Saint Vincent and the Grenadines</option>
                                                            <option class="" country="Samoa" value="WS">Samoa
                                                            </option>
                                                            <option class="" country="San Marino<" value="SM">
                                                                San Marino</option>
                                                            <option class="" country="Sao Tome and Principe"
                                                                value="ST">Sao Tome and Principe</option>
                                                            <option class="" country="Saudi Arabia" value="SA">
                                                                Saudi Arabia</option>
                                                            <option class="" country="Senegal" value="SN">
                                                                Senegal</option>
                                                            <option class="" country="Seychelles" value="SC">
                                                                Seychelles</option>
                                                            <option class="" country="Sierra Leone" value="SL">
                                                                Sierra Leone</option>
                                                            <option class="" country="Singapore" value="SG">
                                                                Singapore</option>
                                                            <option class="" country="Slovakia (Slovak Republic)"
                                                                value="SK">Slovakia (Slovak Republic)</option>
                                                            <option class="" country="Slovenia" value="SI">
                                                                Slovenia</option>
                                                            <option class="" country="Solomon Islands"
                                                                value="SB">
                                                                Solomon Islands</option>
                                                            <option class="" country="Somalia" value="SO">
                                                                Somalia</option>
                                                            <option class="" country="South Africa" value="ZA">
                                                                South Africa</option>
                                                            <option class=""
                                                                country="South Georgia and the South Sandwich Islands"
                                                                value="GS">South Georgia and the South Sandwich Islands
                                                            </option>
                                                            <option class="" country="Spain" value="ES">Spain
                                                            </option>
                                                            <option class="" country="Sri Lanka" value="LK">Sri
                                                                Lanka</option>
                                                            <option class="" country="St. Helena" value="SH">
                                                                St. Helena</option>
                                                            <option class="" country="St. Pierre and Miquelon"
                                                                value="PM">St. Pierre and Miquelon</option>
                                                            <option class="" country="Sudan" value="SD">Sudan
                                                            </option>
                                                            <option class="" country="Suriname" value="SR">
                                                                Suriname</option>
                                                            <option class=""
                                                                country="Svalbard and Jan Mayen Islands" value="SJ">
                                                                Svalbard and Jan Mayen Islands</option>
                                                            <option class="" country="Swaziland" value="SZ">
                                                                Swaziland</option>
                                                            <option class="" country="Sweden" value="SE">Sweden
                                                            </option>
                                                            <option class="" country="Switzerland" value="CH">
                                                                Switzerland</option>
                                                            <option class="" country="Syrian Arab Republic"
                                                                value="SY">Syrian Arab Republic</option>
                                                            <option class="" country="Taiwan, Province of China"
                                                                value="TW">Taiwan, Province of China</option>
                                                            <option class="" country="Tajikistan" value="TJ">
                                                                Tajikistan</option>
                                                            <option class="" country="Tanzania, United Republic of"
                                                                value="TZ">Tanzania, United Republic of</option>
                                                            <option class="" country="Thailand" value="TH">
                                                                Thailand</option>
                                                            <option class="" country="Togo" value="TG">Togo
                                                            </option>
                                                            <option class="" country="Tokelau" value="TK">
                                                                Tokelau</option>
                                                            <option class="" country="Tonga" value="TO">Tonga
                                                            </option>
                                                            <option class="" country="Trinidad and Tobago"
                                                                value="TT">Trinidad and Tobago</option>
                                                            <option class="" country="Tunisia" value="TN">
                                                                Tunisia</option>
                                                            <option class="" country="Turkey" value="TR">Turkey
                                                            </option>
                                                            <option class="" country="Turkmenistan" value="TM">
                                                                Turkmenistan</option>
                                                            <option class="" country="Turks and Caicos Islands"
                                                                value="TC">Turks and Caicos Islands</option>
                                                            <option class="" country="Tuvalu" value="TV">Tuvalu
                                                            </option>
                                                            <option class="" country="Uganda" value="UG">Uganda
                                                            </option>
                                                            <option class="" country="Ukraine" value="UA">
                                                                Ukraine</option>
                                                            <option class="" country="United Arab Emirates"
                                                                value="AE">United Arab Emirates</option>
                                                            <option class="" country="United Kingdom"
                                                                value="GB">
                                                                United Kingdom</option>
                                                            <option class="" country="United States"
                                                                value="US">
                                                                United States</option>
                                                            <option class=""
                                                                country="United States Minor Outlying Islands"
                                                                value="UM">
                                                                United States Minor Outlying Islands
                                                            </option>
                                                            <option class="" country="Uruguay" value="UY">
                                                                Uruguay</option>
                                                            <option class="" country="Uzbekistan"
                                                                value="UZ">
                                                                Uzbekistan</option>
                                                            <option class="" country="Vanuatu" value="VU">
                                                                Vanuatu</option>
                                                            <option class="" country="Venezuela" value="VE">
                                                                Venezuela</option>
                                                            <option class="" country="Viet Nam" value="VN">
                                                                Viet
                                                                Nam</option>
                                                            <option class="" country="Virgin Islands (British)"
                                                                value="VG">Virgin Islands (British)</option>
                                                            <option class="" country="Virgin Islands (U.S.)"
                                                                value="VI">Virgin Islands (U.S.)</option>
                                                            <option class="" country="Wallis and Futuna Islands"
                                                                value="WF">Wallis and Futuna Islands</option>
                                                            <option class="" country="Western Sahara"
                                                                value="EH">
                                                                Western Sahara</option>
                                                            <option class="" country="Yemen" value="YE">
                                                                Yemen
                                                            </option>
                                                            <option class="" country="Yugoslavia"
                                                                value="YU">
                                                                Yugoslavia</option>
                                                            <option class="" country="Zambia" value="ZM">
                                                                Zambia
                                                            </option>
                                                            <option class="" country="Zimbabwe" value="ZW">
                                                                Zimbabwe</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- End Text input element -->

                                            <!-- Begin Text input element -->
                                            <div class="col-md-6">
                                                <div class="quform-element form-group">
                                                    <label class="text-light" for="proficiency">English Proficiency
                                                        Test</label>
                                                    <div class="quform-input">
                                                        <select name="proficiency" class="form-control"
                                                            id="proficiency" required>
                                                            <option value="">Chose Your English Proficiency Test
                                                            </option>
                                                            <option value="ielts">Ielts</option>
                                                            <option value="gre">GRE</option>
                                                            <option value="gmt">GMT</option>
                                                            <option value="duolingo">Duolingo</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- End Text input element -->

                                            <!-- Begin Text input element -->
                                            <div class="col-md-6">
                                                <div class="quform-element form-group">
                                                    <label class="text-light" for="study_type">Study Type</label>
                                                    <div class="quform-input">
                                                        <select name="study_type" class="form-control" id="study_type"
                                                            required>
                                                            <option value="">Chose Your Study Type</option>
                                                            <option value="bachelor">Bachelor</option>
                                                            <option value="nursing">Nursing</option>
                                                            <option value="diploma">Diploma</option>
                                                            <option value="mbbs">MBBS</option>
                                                            <option value="masters">Masters</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- End Text input element -->

                                            <!-- Begin Text input element -->
                                            <div class="col-md-6">
                                                <div class="quform-element form-group">
                                                    <label class="text-light" for="address">Address</label>
                                                    <div class="quform-input">
                                                        <input class="form-control" id="address" type="text"
                                                            name="address" placeholder="Your Address Name here"
                                                            required />
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- End Text input element -->

                                            <!-- Begin Text input element -->
                                            <div class="col-md-6">
                                                <div class="quform-element form-group">
                                                    <label class="text-light" for="village">Village</label>
                                                    <div class="quform-input">
                                                        <input class="form-control" id="village" type="text"
                                                            name="village" placeholder="Your Village Name here"
                                                            required />
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- End Text input element -->

                                            <!-- Begin Text input element -->
                                            <div class="col-md-6">
                                                <div class="quform-element form-group">
                                                    <label class="text-light" for="thana">Thana</label>
                                                    <div class="quform-input">
                                                        <input class="form-control" id="thana" type="text"
                                                            name="thana" placeholder="Your Thana Name here"
                                                            required />
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- End Text input element -->

                                            <!-- Begin Text input element -->
                                            <div class="col-md-6">
                                                <div class="quform-element form-group">
                                                    <label class="text-light" for="district">District</label>
                                                    <div class="quform-input">
                                                        <input class="form-control" id="district" type="text"
                                                            name="district" placeholder="Your District Name here"
                                                            required />
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- End Text input element -->

                                            <!-- Begin Textarea element -->
                                            <div class="col-md-12">
                                                <div class="quform-element form-group">
                                                    <label class="text-light" for="message">Message</label>
                                                    <div class="quform-input">
                                                        <textarea class="form-control" id="message" name="message" rows="3" placeholder="Tell us a few words"></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- End Textarea element -->

                                            <!-- Begin Submit button -->
                                            <div class="col-md-12 mt-5 text-center">
                                                <div class="quform-submit-inner">
                                                    <button class="btn btn-danger w-100 border-0"
                                                        type="submit"><span>Submit</span></button>
                                                </div>
                                                <div class="quform-loading-wrap text-start"><span
                                                        class="quform-loading"></span></div>
                                            </div>

                                            <!-- End Submit button -->

                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- end Section -->
    @elseif($page->page_slug == 'contact-us')
        <!-- Start main-content -->
        <section class="page-title"
            style="margin-top: 20px !important; padding: 80px 0 !important; background-image: url({{ !empty($page->image) ? url('upload/page/' . $page->image) : url('frontend/img/slider/7.jpg') }});">
            <div class="auto-container">
                <div class="title-outer">
                    <h1 class="title">{{ $page->page_title }}</h1>
                    <ul class="page-breadcrumb">
                        <li><a href="{{ route('frontend.home') }}">Home</a></li>
                        <li><a href="#">Pages</a></li>
                        <li>{{ $page->page_title }}</li>
                    </ul>
                </div>
            </div>
        </section>
        <!-- end main-content -->

        <!-- Start Section -->
        <section class="bg-silver-light">
            <div class="container pb-100">
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
                                        <input name="form_email" class="form-control required email" type="email"
                                            placeholder="Enter Email">
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
                                <input name="form_botcheck" class="form-control" type="hidden" value="" />
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
                <!-- Map Section -->
                <div class="row mt-5">
                    <div class="col-lg-12">
                        <!-- Google Map HTML Codes -->
                        <iframe
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d58144.787229144335!2d88.60616015!3d24.37959175!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x39fbefa96a38d031%3A0x10f93a950ed6f410!2sRajshahi!5e0!3m2!1sen!2sbd!4v1773211282518!5m2!1sen!2sbd"
                            width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy"
                            referrerpolicy="no-referrer-when-downgrade"></iframe>
                    </div>
                </div>
            </div>
        </section>
        <!-- end Section -->
    @endif
@endsection
