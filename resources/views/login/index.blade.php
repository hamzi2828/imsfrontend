<x-home :title="$title">
    @push('styles')
        <link rel="stylesheet" type="text/css" href="{{ asset('/assets/css/style.min.css') }}">
    @endpush
    @include('partials._topbar')
    
    <style>
        .login-popup .tab-pane a:not(.btn):hover {
        text-decoration: none;
         }
    </style>
    <main class="main login-page">
        <!-- Start of Page Header -->
        <div class="page-header">
            <div class="container">
                <h1 class="page-title mb-0">Login</h1>
            </div>
        </div>
        <!-- End of Page Header -->
        <div class="page-content">
            <div class="container">
                <div class="login-popup">
                    <div class="tab tab-nav-boxed tab-nav-center tab-nav-underline">
                        <div class="tab-content">
                            @include('errors.validation-errors')
                            <div class="tab-pane active" id="sign-in">
                                <form method="post" action="{{ route ('authenticate') }}">
                                    @csrf
                                    @method('PATCH')
                                    <div class="form-group">
                                        <label for="email">Email Address *</label>
                                        <input type="email" aria-invalid="email" autofocus="autofocus"
                                               class="form-control"
                                               name="email"
                                               id="email" required="required" value="{{ old ('email') }}">
                                    </div>
                                    <div class="form-group mb-0">
                                        <label for="password">Password *</label>
                                        <input type="password" class="form-control" name="password" id="password"
                                               required="required">
                                    </div>
                                    <div class="form-checkbox d-flex align-items-center justify-content-between">
                                        <input type="checkbox" class="custom-checkbox" id="remember1" name="remember1">
                                        <label for="remember1">Remember me</label>
                                        <a href="{{ route ('password.request') }}">Lost your password?</a>
                                    </div>
                                    <button type="submit" class="btn btn-primary w-100">Sign In</button>
                                </form>

                                    <!-- Social Media Icons Section -->
                        {{-- <div class="social-icons social-no-color border-thin mt-4 d-flex justify-content-center"> --}}
                           @php $settings = siteSettings () @endphp
                            <div class="social-icons social-no-color border-thin mt-4 d-flex justify-content-center">
                                @if(!empty(trim (optional ($settings -> settings) -> facebook)))
                                    <a href="{{ optional (siteSettings () -> settings) -> facebook }}"
                                       class="social-icon social-facebook w-icon-facebook"></a>
                                @endif
                                
                                @if(!empty(trim (optional ($settings -> settings) -> twitter)))
                                    <a href="{{ optional (siteSettings () -> settings) -> twitter }}"
                                       class="social-icon social-twitter w-icon-twitter"></a>
                                @endif
                                
                                @if(!empty(trim (optional ($settings -> settings) -> instagram)))
                                    <a href="{{ optional (siteSettings () -> settings) -> instagram }}"
                                       class="social-icon social-instagram w-icon-instagram"></a>
                                @endif
                                
                                @if(!empty(trim (optional ($settings -> settings) -> youtube)))
                                    <a href="{{ optional (siteSettings () -> settings) -> youtube }}"
                                       class="social-icon social-youtube w-icon-youtube"></a>
                                @endif
                                
                                @if(!empty(trim (optional ($settings -> settings) -> pinterest)))
                                    <a href="{{ optional (siteSettings () -> settings) -> pinterest }}"
                                       class="social-icon social-pinterest w-icon-pinterest"></a>
                                @endif
                                
                                @if(!empty(trim (optional ($settings -> settings) -> tiktok)))
                                    <a href="{{ optional (siteSettings () -> settings) -> tiktok }}"
                                       class="social-icon social-tiktok w-icon-tiktok">
                                        <i class="fa-brands fa-tiktok"></i>
                                    </a>
                                @endif
                                
                            
                            </div>
                        
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    
    @include('partials._footer')
</x-home>