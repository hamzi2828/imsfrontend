<!-- Start of Header -->
<header class="header">
    <div class="header-top">
        <div class="container">
            <div class="header-left">
                <p class="welcome-msg">{{ optional (siteSettings () -> settings) -> tagline }}</p>
            </div>
            <div class="header-right">
                <a href="#" class="d-lg-show">Contact Us</a>
                
                @if(auth () -> check ())
                    <a href="#" class="d-lg-show">My Account</a>
                @endif
                
                <a href="{{ route ('login') }}" class="d-lg-show login sign-in">
                    <i class="w-icon-account"></i>Sign In
                </a>
                <span class="delimiter d-lg-show">/</span>
                <a href="{{ route ('login') }}" class="ml-0 d-lg-show login register">Register</a>
            </div>
        </div>
    </div>
    <!-- End of Header Top -->
    
    @include('partials._searchbar')
    {!! $categories_sidebar !!}
</header>
<!-- End of Header -->