@extends('layouts.frontend.app', [$pageTitle => 'Page Title'])
@section('content')
    <!-- =============== PAGE TITLE ============== -->
    <style>
        .banner_image{
            padding-top: 0px !important;
        }
        .single_container{
            padding-top: 0px !important; 
        }
    </style>
    <!-- =============== PAGE TITLE ============== -->
    <!-- Banner Section -->
    <section class="jumbotron text-center banner_image" aria-label="Banner Section">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <img width="100%" src="{{ (!empty($first_educations->banner)) ? url('upload/education/'.$first_educations->banner):url('upload/page-title.jpg') }}" alt="..." class="wow fadeIn" data-wow-delay="200ms">
                </div>
            </div>
        </div>
    </section>

    <!-- =============== START EDUCATION ALL LIST ============== -->
    <section class="single_container">
        <div class="container">
            <div class="row g-xl-5 mt-n2-2">
                @foreach($educations as $education)
                    <div class="col-md-6 col-lg-4 mt-2-2 wow fadeInUp " data-wow-delay="100ms">
                        <article class="card card-style-04 h-100 rounded-0 shadow-lg">
                            <div class="blog-img position-relative overflow-hidden">
                                <img src="{{ (!empty($education->image)) ? url('upload/education/'.$education->image):url('upload/no_image.jpg') }}" alt="...">
                                <div class="card-list">
                                    <a href="{{ route('single.education.page',$education->slug) }}">
                                        @if($education->study_type == 1)
                                            Spoken
                                        @elseif($education->study_type == 2)
                                            Kids Spoken
                                        @elseif($education->study_type == 3)
                                            IELTS
                                        @elseif($education->study_type == 4)
                                            Japanese
                                        @elseif($education->study_type == 5)
                                            Korean
                                        @else
                                            Diploma In English
                                        @endif
                                    </a>
                                </div>
                            </div>
                            <div class="card-body p-1-9">
                                {{-- <span class="text-primary d-block mb-2 font-weight-600">June 01, 2022</span> --}}
                                <h3 class="h4 mb-0">
                                    <a href="{{ route('single.education.page',$education->slug) }}">
                                        <?php $p_name_bn = strip_tags(html_entity_decode($education->course_materials)); ?>
                                        {{ Str::limit($p_name_bn, $limit = 20, $end = '. . .') }}
                                    </a>
                                </h3>
                            </div>
                            <div class="d-flex fw-bold border-top px-1-9 py-3 border-color-light-black justify-content-between">
                                <a href="{{ route('single.education.page',$education->slug) }}">Read more</a>
                                <a href="{{ route('single.education.page',$education->slug) }}"><i class="ti-arrow-right"></i></a>
                            </div>
                        </article>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    <!-- =============== END EDUCATION ALL LIST ================ -->
@endsection
