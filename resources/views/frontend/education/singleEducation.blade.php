@extends('layouts.frontend.app', [$pageTitle => 'Page Title'])
@section('content')
    <!-- =============== PAGE TITLE ============== -->
    <style>
        .single_container{
            padding-top: 0px !important; 
        }
    </style>
    <!-- =============== PAGE TITLE ============== -->
     <!-- Breadcrumb Banner Start -->
        <section class="breadcrumb-banner"
            style="
        background-image: url('{{ (!empty($singleEducation->banner)) ? url('upload/education/'.$singleEducation->banner):url('upload/page-title.jpg') }}');
        background-size: cover;
        background-position: center center;
        background-repeat: no-repeat;
        padding: 200px 0;
        text-align: center;
        color: #fff;
    ">
        </section>
        <!-- Breadcrumb Banner End -->


        <!-- ================ STUDY ABROAD DETAILS ================ -->
            <div class="container mt-5">
                <div class="row">
                    <div class="col-lg-8 mb-5 mb-lg-0">
                        <div class="row">
                            <div class="col-lg-12">
                                <article class="card border-0 primary-shadow">
                                    <img src="{{ (!empty($singleEducation->image)) ? url('upload/education/'.$singleEducation->image):url('upload/') }}" alt="..." class="wow fadeIn" data-wow-delay="200ms">
                                    <div class="card-body p-1-6 p-sm-1-9">
                                        <div class="wow fadeIn" data-wow-delay="200ms">
                                            <h3 class="mb-3">{{ $singleEducation->course_name ?? 'n/a'}}</h3>
                                            <p>
                                                {!! $singleEducation->course_materials ?? 'n/a' !!}
                                            </p>
                                            {{-- <p class="mb-2-3">
                                                {!! $singleEducation->documents ?? 'n/a' !!}
                                            </p> --}}
                                        </div>
                                    </div>
                                </article>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 ps-xl-5">
                        <div class="sidebar">
                            <div>
                                <a href="{{ route('education.all') }}" class="btn-style1 small btn btn-danger" style="float: right;"><i class="fa fa-share"></i> View All</a>
                                <div class="wow fadeIn" data-wow-delay="200ms">
                                    <div class="section-title left">
                                        <span class="sm-title">{{ $singleEducation->course_name ?? 'n/a'}} Details</span>
                                    </div>
                                    {{-- <h2 class="h1 mb-1-9">SEO & Content Writing</h2> --}}
                                </div>
                                <div>
                                    <div class="mb-4 wow fadeInUp" data-wow-delay="100ms">
                                        <h3 class="h5">Course Name</h3>
                                        <p class="mb-0">{{ $singleEducation->course_name ?? 'n/a' }}</p>
                                    </div>
                                    <div class="mb-4 wow fadeInUp" data-wow-delay="200ms">
                                        <h3 class="h5">Study Type</h3>
                                        <p class="mb-0">
                                            @if($singleEducation->study_type == 1)
                                                <span class="badge bg-pill bg-success">Spoken</span>
                                            @elseif($singleEducation->study_type == 2)
                                                <span class="badge bg-pill bg-danger">Kids Spoken</span>
                                            @elseif($singleEducation->study_type == 3)
                                                <span class="badge bg-pill bg-info">IELTS</span>
                                            @elseif($singleEducation->study_type == 4)
                                                <span class="badge bg-pill bg-warning">Japanese</span>
                                            @elseif($singleEducation->study_type == 5)
                                                <span class="badge bg-pill bg-warning">Korean</span>
                                            @else
                                                <span class="badge bg-pill bg-secondary">Diploma In English</span>
                                            @endif
                                        </p>
                                    </div>
                                    <div class="mb-4 wow fadeInUp" data-wow-delay="300ms">
                                        <h3 class="h5">Course Fee</h3>
                                        <p class="mb-0">৳{{ $singleEducation->course_fee ?? '0.00' }}</p>
                                    </div>
                                    <div class="mb-4 wow fadeInUp" data-wow-delay="300ms">
                                        <h3 class="h5">Course Discount</h3>
                                        <p class="mb-0">৳{{ $singleEducation->discount ?? '0.00' }}</p>
                                    </div>
                                    <div class="mb-4 wow fadeInUp" data-wow-delay="400ms">
                                        <h3 class="h5">Course Gross Fee</h3>
                                        <p class="mb-0">৳{{ $singleEducation->gross_course_fee ?? '0.00' }}</p>
                                    </div>
                                    <div class="mb-4 wow fadeInUp" data-wow-delay="500ms">
                                        <h3 class="h5">Duration</h3>
                                        <p class="mb-0">{{ $singleEducation->duration ?? 'n/a' }}</p>
                                    </div>
                                    <div class="mb-4 wow fadeInUp" data-wow-delay="500ms">
                                        <h3 class="h5">Experience</h3>
                                        <p class="mb-0">{{ $singleEducation->experience ?? 'n/a' }}</p>
                                    </div>
                                    <div class="mb-4 wow fadeInUp" data-wow-delay="500ms">
                                        <h3 class="h5">Coordinator Name</h3>
                                        <p class="mb-0">{{ $singleEducation->coordinator_name ?? 'n/a' }}</p>
                                    </div>
                                    <div class="mb-4 wow fadeInUp" data-wow-delay="500ms">
                                        <h3 class="h5">Coordinator Photo</h3>
                                        <img src="{{ (!empty($singleEducation->coordinator_photo)) ? url('upload/education/'.$singleEducation->coordinator_photo):url('upload/no_image.jpg') }}" width="80" alt="image" class="img-fluid">
                                    </div>
                                </div>
                            </div>
                            <div class="widget bg-secondary mb-1-9 wow fadeInUp" data-wow-delay="350ms">
                                <div class="widget-content">
                                    <h5 class="mb-3 text-white">Recent Education</h5>
                                    @foreach($educations as $education)
                                        <div class="d-flex mb-4">
                                            <div class="flex-shrink-0">
                                                <img width="80" src="{{ (!empty($education->image)) ? url('upload/education/'.$education->image):url('upload/') }}" alt="...">
                                            </div>
                                            <div class="flex-grow-1 ms-3">
                                                <h4 class="mb-2 h6"><a href="{{ route('single.education.page',$education->slug) }}" class="text-white text-white-hover-light">{{ $education->course_name ?? 'n/a' }}</a></h4>
                                                {{-- <span class="text-white opacity8 small">June 01 2022</span> --}}
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            <div class="widget bg-secondary wow fadeInUp" data-wow-delay="800ms">
                                <div class="widget-content">
                                    <h5 class="mb-3 text-white">Follow Us</h5>
                                    <ul class="social-icon-style2 ps-0">
                                        <li class="me-1"><a target="_blank" href="{{ get_setting('facebook_url')->value ?? 'null' }}"><i class="fab fa-facebook-f"></i></a></li>
                                        <li class="me-1"><a target="_blank" href="{{ get_setting('twitter_url')->value ?? 'null' }}"><i class="fab fa-twitter"></i></a></li>
                                        <li class="me-1"><a target="_blank" href="{{ get_setting('instagram_url')->value ?? 'null' }}"><i class="fab fa-instagram"></i></a></li>
                                        <li class="me-0"><a target="_blank" href="{{ get_setting('linkedin_url')->value ?? 'null' }}"><i class="fab fa-linkedin-in"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
@endsection
