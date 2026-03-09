<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">

    <!-- Title -->
    <title>{{ get_setting('site_name')->value ?? env('APP_NAME') }} | {{ $pageTitle ?? '' }}</title>

    <!-- SEO Meta -->
    <meta name="title" content="{{ $pageTitle ?? get_setting('site_name')->value }}">
    <meta name="description" content="{{ get_setting('meta_description')->value ?? '' }}">
    <meta name="keywords" content="{{ get_setting('meta_keywords')->value ?? '' }}">
    <meta name="author" content="{{ get_setting('site_name')->value ?? '' }}">
    <meta name="robots" content="index, follow">

    <!-- Open Graph (Facebook SEO) -->
    <meta property="og:title" content="{{ $pageTitle ?? get_setting('site_name')->value }}">
    <meta property="og:description" content="{{ get_setting('meta_description')->value ?? '' }}">
    <meta property="og:image" content="{{ asset(get_setting('site_logo')->value ?? 'frontend/images/logo.png') }}">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:type" content="website">
    <meta property="og:site_name" content="{{ get_setting('site_name')->value ?? '' }}">

    <!-- Twitter SEO -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="{{ $pageTitle ?? get_setting('site_name')->value }}">
    <meta name="twitter:description" content="{{ get_setting('meta_description')->value ?? '' }}">
    <meta name="twitter:image" content="{{ asset(get_setting('site_logo')->value ?? 'frontend/images/logo.png') }}">

    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ asset(get_setting('site_favicon')->value ?? 'frontend/images/favicon.png') }}" type="image/x-icon">
    <link rel="icon" href="{{ asset(get_setting('site_favicon')->value ?? 'frontend/images/favicon.png') }}" type="image/x-icon">

    <!-- Stylesheets -->
    <link href="{{ asset('frontend/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('frontend/plugins/revolution/css/settings.css') }}" rel="stylesheet">
    <link href="{{ asset('frontend/plugins/revolution/css/layers.css') }}" rel="stylesheet">
    <link href="{{ asset('frontend/plugins/revolution/css/navigation.css') }}" rel="stylesheet">
    <link href="{{ asset('frontend/css/style.css') }}" rel="stylesheet">

    <!-- Responsive -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">

    @stack('css')
</head>

<body>

    <div class="page-wrapper">

        <!-- Preloader -->
        <div class="preloader"></div>

        <!-- Main Header-->
		@include('layouts.frontend.navbar')
        <!--End Main Header -->

        @yield('content')

        <!-- Main Footer -->
        @include('layouts.frontend.footer')
        <!--End Main Footer -->

    </div><!-- End Page Wrapper -->

    <!-- Scroll To Top -->
    <div class="scroll-to-top scroll-to-target" data-target="html"><span class="fa fa-angle-up"></span></div>

    <script src="{{ asset('frontend/js/jquery.js') }}"></script>
    <script src="{{ asset('frontend/js/popper.min.js') }}"></script>
    <!--Revolution Slider-->
    <script src="{{ asset('frontend/plugins/revolution/js/jquery.themepunch.revolution.min.js') }}"></script>
    <script src="{{ asset('frontend/plugins/revolution/js/jquery.themepunch.tools.min.js') }}"></script>
    <script src="{{ asset('frontend/plugins/revolution/js/extensions/revolution.extension.actions.min.js') }}"></script>
    <script src="{{ asset('frontend/plugins/revolution/js/extensions/revolution.extension.carousel.min.js') }}"></script>
    <script src="{{ asset('frontend/plugins/revolution/js/extensions/revolution.extension.kenburn.min.js') }}"></script>
    <script src="{{ asset('frontend/plugins/revolution/js/extensions/revolution.extension.layeranimation.min.js') }}">
    </script>
    <script src="{{ asset('frontend/plugins/revolution/js/extensions/revolution.extension.migration.min.js') }}"></script>
    <script src="{{ asset('frontend/plugins/revolution/js/extensions/revolution.extension.navigation.min.js') }}"></script>
    <script src="{{ asset('frontend/plugins/revolution/js/extensions/revolution.extension.parallax.min.js') }}"></script>
    <script src="{{ asset('frontend/plugins/revolution/js/extensions/revolution.extension.slideanims.min.js') }}"></script>
    <script src="{{ asset('frontend/plugins/revolution/js/extensions/revolution.extension.video.min.js') }}"></script>
    <script src="{{ asset('frontend/js/main-slider-script.js') }}"></script>
    <!--Revolution Slider-->
    <script src="{{ asset('frontend/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('frontend/js/jquery.fancybox.js') }}"></script>
    <script src="{{ asset('frontend/js/jquery-ui.js') }}"></script>
    <script src="{{ asset('frontend/js/wow.js') }}"></script>
    <script src="{{ asset('frontend/js/appear.js') }}"></script>
    <script src="{{ asset('frontend/js/select2.min.js') }}"></script>
    <script src="{{ asset('frontend/js/swiper.min.js') }}"></script>
    <script src="{{ asset('frontend/js/owl.js') }}"></script>
    <script src="{{ asset('frontend/js/script.js') }}"></script>
    @stack('js')
</body>

</html>
