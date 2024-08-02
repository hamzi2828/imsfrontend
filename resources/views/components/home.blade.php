<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0">
    
    <title>{{ $title . ' - ' . config ('app.name') }}</title>
    <meta name="csrf-token" content="{{ csrf_token () }}">
    <meta name="description" content="{{ optional (siteSettings () -> settings) -> description }}">
    <meta property="og:title" content="{{ optional (siteSettings () -> settings) -> title }}">
    <meta property="og:description" content="{{ optional (siteSettings () -> settings) -> description }}">
    <meta property="og:image" content="{{ serverPath (optional (siteSettings () -> settings) -> logo) }}">
    <meta property="og:url" content="{{ route ('home') }}">
    
    <script type="application/ld+json">
        {
          "@context": "https://schema.org",
          "@type": "Organization",
          "name": "{{ optional (siteSettings () -> settings) -> description }}",
          "url": "{{ route ('home') }}",
          "logo": "{{ serverPath (optional (siteSettings () -> settings) -> logo) }}",
          "sameAs": [
            "{{ optional (siteSettings () -> settings) -> facebook }}",
            "{{ optional (siteSettings () -> settings) -> instagram }}",
            "{{ optional (siteSettings () -> settings) -> tiktok }}"
          ]
        }
    </script>
    
    <!-- Favicon -->
    {{-- {{-- <link rel="icon" type="image/png" href="{{ serverPath (optional (siteSettings () -> settings) -> logo) }}"> --}}
    <link rel="icon" type="image/png" href="{{ asset('/assets/favicon.png') }}">
    
    
    <!-- WebFont.js -->
    <script>
        WebFontConfig = {
            google: { families: [ 'Poppins:400,500,600,700,800' ] }
        };
        ( function ( d ) {
            var wf   = d.createElement ( 'script' ),
                s    = d.scripts[ 0 ];
            wf.src   = '{{ asset ('/assets/js/webfont.js') }}';
            wf.async = true;
            s.parentNode.insertBefore ( wf, s );
        } ) ( document );
    </script>
    
    <link rel="preload" href="{{ asset('/assets/vendor/fontawesome-free/webfonts/fa-regular-400.woff2') }}" as="font"
          type="font/woff2"
          crossorigin="anonymous">
    <link rel="preload" href="{{ asset('/assets/vendor/fontawesome-free/webfonts/fa-solid-900.woff2') }}" as="font"
          type="font/woff2"
          crossorigin="anonymous">
    <link rel="preload" href="{{ asset('/assets/vendor/fontawesome-free/webfonts/fa-brands-400.woff2') }}" as="font"
          type="font/woff2"
          crossorigin="anonymous">
    <link rel="preload" href="{{ asset('/assets/fonts/wolmart.woff?png09e') }}" as="font" type="font/woff"
          crossorigin="anonymous">
    
    <!-- Vendor CSS -->
    <link rel="stylesheet" type="text/css" href="{{ asset('/assets/vendor/fontawesome-free/css/all.min.css') }}">
    
    <!-- Plugins CSS -->
    <!-- <link rel="stylesheet" href="{{ asset('/assets/vendor/swiper/swiper-bundle.min.css') }}"> -->
    <link rel="stylesheet" type="text/css" href="{{ asset('/assets/vendor/animate/animate.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('/assets/vendor/magnific-popup/magnific-popup.min.css') }}">
    <!-- Link Swiper's CSS -->
    <link rel="stylesheet" href="{{ asset('/assets/vendor/swiper/swiper-bundle.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/assets/css/custom.css?ver='.rand ()) }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <style>
        .dropdown > a::after {
            display : none !important;
        }
    </style>
    @stack('styles')
</head>

<style>


@media (max-width: 767px) {
    .scroll-top {
        display: flex !important;
        justify-content: center;
        align-items: center;
        position: fixed;
        bottom: 15px;
        right: 15px;
        width: 40px;
        height: 40px;
        background-color: #f6f6f6;
        border-radius: 50%;
        z-index: 9999;
        cursor: pointer;
    }

    .scroll-top .w-icon-angle-up::before,
    .scroll-top .w-icon-angle-up::after {
        content: '';
        display: block;
        width: 2px;
        height: 10px;
        background-color: #fff;
    }

    .scroll-top .w-icon-angle-up::after {
        transform: rotateZ(-45deg);
    }

    .scroll-top .w-icon-angle-up::before {
        margin-right: 4px;
        transform: rotateZ(45deg);
    }
}



</style>
<body class="{{ request () -> routeIs ('users.*') ? 'my-account' : '' }}">
<div class="page-wrapper">
    {{ $slot }}
</div>
<!-- End of Page-wrapper-->

@include('partials._sticky-footer')

{{-- <!-- Start of Scroll Top -->
<a id="scroll-top" class="scroll-top" href="#top" title="Top" role="button"> <i class="w-icon-angle-up"></i>
    <svg
            version="1.1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 70 70">
       <circle id="progress-indicator" fill="transparent" stroke="#000000" stroke-miterlimit="10" cx="35" cy="35"
                r="34" style="stroke-dasharray: 16.4198, 400;"></circle>
    </svg>
</a>
<!-- End of Scroll Top --> --}}
 

<!-- Start of Scroll Top -->
<a id="scroll-top" class="scroll-top" href="#top" title="Top" role="button">
    <i class="w-icon-angle-up"></i>
    <svg version="1.1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 70 70">
        <circle id="progress-indicator" fill="transparent" stroke="#000000" stroke-miterlimit="10" cx="35" cy="35" r="34" style="stroke-dasharray: 16.4198, 400;"></circle>
    </svg>
</a>
<!-- End of Scroll Top -->



{!! $mobile_sidebar !!}

<div id="ajaxContent"></div>

@if(!cookie ('newsletter-'.request () -> ip ()))
    @include('partials.newsletter-popup')
@endif

@if(!empty(trim (optional (siteSettings () -> settings) -> whatsapp)))
    <div class="whatsapp-link" style="position: fixed; bottom: 165px; right: 10px; z-index: 999999">
        <a href="{{ optional (siteSettings () -> settings) -> whatsapp }}" target="_blank">
            <img src="{{ asset ('/assets/WhatsApp_icon.png.webp') }}" style="height: 55px" />
        </a>
    </div>
@endif

<!-- Plugin JS File -->
<script src="{{ asset('/assets/vendor/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('/assets/vendor/jquery.plugin/jquery.plugin.min.js') }}"></script>
<script src="{{ asset('/assets/vendor/imagesloaded/imagesloaded.pkgd.min.js') }}"></script>
<script src="{{ asset('/assets/vendor/zoom/jquery.zoom.js') }}"></script>
<script src="{{ asset('/assets/vendor/jquery.countdown/jquery.countdown.min.js') }}"></script>
<script src="{{ asset('/assets/vendor/magnific-popup/jquery.magnific-popup.min.js') }}"></script>
<script src="{{ asset('/assets/vendor/skrollr/skrollr.min.js') }}"></script>

<!-- Swiper JS -->
<script src="{{ asset('/assets/vendor/swiper/swiper-bundle.min.js') }}"></script>

<!-- Main JS -->
<script src="{{ asset('/assets/vendor/sticky/sticky.js') }}"></script>
<script src="{{ asset('/assets/js/main.min.js') }}"></script>
<script src="{{ asset('/assets/js/scripts.js?ver='.rand ()) }}"></script>
@stack('scripts')
<script type="text/javascript">
    $ ( window ).on ( 'load', function () {
        setTimeout ( function () {
            $ ( '.popup' ).css ( 'display', 'flex' );
        }, 2000 );
    } )
    
    function closePopup () {
        $ ( '.popup' ).css ( 'display', 'none' );
    }
</script>
</body>

</html>