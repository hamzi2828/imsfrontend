<x-home :title="$title">
    @push('styles')
        <link rel="stylesheet" type="text/css" href="{{ asset('/assets/css/style.min.css') }}">
    @endpush
    @include('partials._topbar')
    
    <main class="main login-page">
        <!-- Start of Page Header -->
        <div class="page-header">
            <div class="container">
                <h1 class="page-title mb-0">Create Account</h1>
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
                                <form method="post" action="{{ route ('register') }}">
                                    @csrf
                                    <div class="form-group">
                                        <label for="full-name">Full name *</label>
                                        <input type="text" class="form-control form-control-md" name="full-name"
                                               required="required"
                                               value="{{ old ('full-name') }}"
                                               id="full-name">
                                    </div>
                                    <div class="form-group">
                                        <label for="email">Email address *</label>
                                        <input type="email" id="email"
                                               value="{{ old ('email') }}"
                                               class="form-control form-control-md" name="email" required="required">
                                    </div>
                                    <div class="form-group">
                                        <label for="phone">Phone *</label>
                                        <input type="text" class="form-control form-control-md" name="phone" id="phone"
                                               required="required"
                                               value="{{ old ('phone') }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="password">Password *</label>
                                        <input type="password" class="form-control" name="password" id="password"
                                               required="required">
                                    </div>
                                    <div class="form-group">
                                        <label for="address">Address *</label>
                                        <input type="text" class="form-control" name="address" id="address"
                                               required="required">
                                    </div>
                                    <button type="submit" class="btn btn-primary w-100">Sign Up</button>
                                    <div class="form-checkbox d-flex align-items-center justify-content-end">
                                        Already have an account?
                                        <a href="{{ route ('login') }}" style="margin-left: 5px">Login</a>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    
    @include('partials._footer')
</x-home>