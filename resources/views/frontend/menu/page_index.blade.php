@extends('layouts.frontend.app', [$pageTitle => 'Page Title'])
@section('content')
    <style>
        .banner_image {
            padding-top: 0px !important;
        }

        .single_container {
            padding-top: 0px !important;
        }
    </style>
    @php
        $currentUrl = url()->current();

    @endphp

    @if (\Str::contains($currentUrl, 'contact-us'))
        <!-- Page Content -->
        <section class="page-content">
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
                                <form id="contact_form" name="contact_form" class=""
                                    action="#"
                                    method="post">
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
                                                <a href="tel:{{ get_setting('phone')->value ?? '' }}"><span>Free</span> {{ get_setting('phone')->value ?? '' }}</a>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="icon">
                                                <span class="lnr-icon-envelope1"></span>
                                            </div>
                                            <div class="text">
                                                <h6>Write email</h6>
                                                <a href="mailto:{{ get_setting('email')->value ?? '' }}">{{ get_setting('email')->value ?? '' }}</a>
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
                            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d58144.787229144335!2d88.60616015!3d24.37959175!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x39fbefa96a38d031%3A0x10f93a950ed6f410!2sRajshahi!5e0!3m2!1sen!2sbd!4v1773211282518!5m2!1sen!2sbd" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                        </div>
                    </div>
                </section>
            </div>
        </section>
    @else
        <section class="page-content pt-5 pb-5">
            <div class="container">
                <h3>{{ $page->page_title ?? 'No content available' }}</h3>
                <p>{!! $page->page_description ?? 'No content available' !!}</p>
            </div>
        </section>
    @endif
    @push('frontend-js')
    @endpush
@endsection
