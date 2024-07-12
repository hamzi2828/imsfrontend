<x-home :title="$title">
    @push('styles')
        <link rel="stylesheet" type="text/css" href="{{ asset('/assets/css/style.min.css') }}">
    @endpush
    @include('partials._topbar')
    
    <main class="main login-page">
        <!-- Start of Page Header -->
        <div class="page-header">
            <div class="container">
                <h1 class="page-title mb-0">{{ $title }}</h1>
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
                                <form method="post" action="{{ route ('password.update', ['token' => $title]) }}">
                                    @csrf
                                    <div class="form-group">
                                        <input type="hidden" class="form-control" name="token" value="{{ $token }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="email">Email Address *</label>
                                        <input type="email" aria-invalid="email" autofocus="autofocus"
                                               class="form-control"
                                               name="email" readonly="readonly"
                                               id="email" required="required" value="{{ request ('email') }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="password">Password *</label>
                                        <input type="password" class="form-control" name="password"
                                               id="password" required="required">
                                    </div>
                                    <div class="form-group">
                                        <label for="confirm-password">Confirm Password *</label>
                                        <input type="password" class="form-control" name="password_confirmation"
                                               id="confirm-password" required="required">
                                    </div>
                                    <button type="submit" class="btn btn-primary w-100">Password Reset</button>
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