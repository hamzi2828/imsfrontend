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
                    <a href="{{ route ('users.index') }}" class="d-lg-show">My Account</a>
                    <a href="{{ route ('login.logout') }}" class="d-lg-show">Logout</a>
                @endif
                
                @if(!auth () -> check ())
                    <a href="{{ route ('login') }}">
                        <i class="w-icon-account"></i>Sign In
                    </a>
                @endif
                
                @if(!auth () -> check ())
                    <a href="{{ route ('signup') }}">
                        <i class="w-icon-account"></i>Sign Up
                    </a>
                @endif
            </div>
        </div>
    </div>
    <!-- End of Header Top -->
    
    @include('partials._searchbar')
    {!! $categories_sidebar !!}
</header>
<!-- End of Header -->