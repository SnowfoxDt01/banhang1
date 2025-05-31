<!doctype html>
<html class="no-js" lang="zxx">
    
<!-- Mirrored from preview.colorlib.com/theme/estore/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 04 May 2025 08:21:39 GMT -->
<head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>
            @section('title')
                Shop Cáo Tuyết | 
            @show
        </title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="manifest" href="{{ asset('site.html') }}">
		<link rel="shortcut icon" type="image/x-icon" href="{{ asset('client/img/logo/logo-cao-tuyet.png') }}">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />


		<!-- CSS here -->
            <link rel="stylesheet" href="{{ asset('client/css/bootstrap.min.css') }}">
            <link rel="stylesheet" href="{{ asset('client/css/owl.carousel.min.css') }}">
            <link rel="stylesheet" href="{{ asset('client/css/flaticon.css') }}">
            <link rel="stylesheet" href="{{ asset('client/css/slicknav.css') }}">
            <link rel="stylesheet" href="{{ asset('client/css/animate.min.css') }}">
            <link rel="stylesheet" href="{{ asset('client/css/magnific-popup.css') }}">
            <link rel="stylesheet" href="{{ asset('client/css/fontawesome-all.min.css') }}">
            <link rel="stylesheet" href="{{ asset('client/css/themify-icons.css') }}">
            <link rel="stylesheet" href="{{ asset('client/css/slick.css') }}">
            <link rel="stylesheet" href="{{ asset('client/css/nice-select.css') }}">
            <link rel="stylesheet" href="{{ asset('client/css/style.css') }}">
            {{-- @stack('styles'); --}}
            <style>
               
                .img-logo {
                    width: 70%;
                    height: auto;
                }
                
            </style> 
        
   </head>

   <body>
       
    <!-- Preloader Start -->
    <div id="preloader-active">
        <div class="preloader d-flex align-items-center justify-content-center">
            <div class="preloader-inner position-relative">
                <div class="preloader-circle"></div>
                <div class="preloader-img pere-text">
                    <img src="{{ asset('client/img/logo/logo-cao-tuyet.png') }}" alt="">
                </div>
            </div>
        </div>
    </div>
    <!-- Preloader Start -->

    <header>
        <!-- Header Start -->
        @include('client.layout.header')
        <!-- Header End -->
    </header>

    <main>

        
        <!-- Category Area End-->
        @yield('content')

    </main>
    <!-- Footer -->
    @include('client.layout.footer')
    <!-- Footer End-->

	<!-- JS here -->
	
		<!-- All JS Custom Plugins Link Here here -->
        <script src="{{ asset('client/js/vendor/modernizr-3.5.0.min.js') }}"></script>
		<!-- Jquery, Popper, Bootstrap -->
		<script src="{{ asset('client/js/vendor/jquery-1.12.4.min.js') }}"></script>
        <script src="{{ asset('client/js/popper.min.js') }}"></script>
        <script src="{{ asset('client/js/bootstrap.min.js') }}"></script>
	    <!-- Jquery Mobile Menu -->
        <script src="{{ asset('client/js/jquery.slicknav.min.js') }}"></script>

		<!-- Jquery Slick , Owl-Carousel Plugins -->
        <script src="{{ asset('client/js/owl.carousel.min.js') }}"></script>
        <script src="{{ asset('client/js/slick.min.js') }}"></script>

		<!-- One Page, Animated-HeadLin -->
        <script src="{{ asset('client/js/wow.min.js') }}"></script>
		<script src="{{ asset('client/js/animated.headline.js') }}"></script>
        <script src="{{ asset('client/js/jquery.magnific-popup.js') }}"></script>

		<!-- Scrollup, nice-select, sticky -->
        <script src="{{ asset('client/js/jquery.scrollUp.min.js') }}"></script>
        <script src="{{ asset('client/js/jquery.nice-select.min.js') }}"></script>
		<script src="{{ asset('client/js/jquery.sticky.js') }}"></script>
        
        <!-- contact js -->
        <script src="{{ asset('client/js/contact.js') }}"></script>
        <script src="{{ asset('client/js/jquery.form.js') }}"></script>
        <script src="{{ asset('client/js/jquery.validate.min.js') }}"></script>
        <script src="{{ asset('client/js/mail-script.js') }}"></script>
        <script src="{{ asset('client/js/jquery.ajaxchimp.min.js') }}"></script>
        
		<!-- Jquery Plugins, main Jquery -->	
        <script src="{{ asset('client/js/plugins.js') }}"></script>
        <script src="{{ asset('client/js/main.js') }}"></script>
        

 <!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-23581568-13"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-23581568-13');
</script>
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

    <script defer src="https://static.cloudflareinsights.com/beacon.min.js/vcd15cbe7772f49c399c6a5babf22c1241717689176015" integrity="sha512-ZpsOmlRQV6y907TI0dKBHq9Md29nnaEIPlkf84rnaERnq6zvWvPUqr2ft8M1aS28oN72PdrCzSjY4U6VaAw1EQ==" data-cf-beacon='{"rayId":"93a695f6dd9985b5","version":"2025.4.0-1-g37f21b1","serverTiming":{"name":{"cfExtPri":true,"cfL4":true,"cfSpeedBrain":true,"cfCacheStatus":true}},"token":"cd0b4b3a733644fc843ef0b185f98241","b":1}' crossorigin="anonymous"></script>
@stack('scripts')
</body>

<!-- Mirrored from preview.colorlib.com/theme/estore/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 04 May 2025 08:22:02 GMT -->
</html>