<x-home :title="$title">
    @push('styles')
        <link rel="stylesheet" type="text/css" href="{{ asset('/assets/css/style.min.css') }}">
    @endpush
    @include('partials._topbar')
    
    <main class="main">
        <!-- Start of Page Header -->
        <div class="page-header">
            <div class="container">
                <h1 class="page-title mb-0">My Account</h1>
            </div>
        </div>
        <!-- End of Page Header -->
        
        <!-- Start of PageContent -->
        <div class="page-content pt-2">
            <div class="container">
                <div class="tab tab-vertical row gutter-lg">
                    <ul class="nav nav-tabs mb-6" role="tablist">
                        <li class="nav-item">
                            <a href="#account-orders" class="nav-link active">Orders</a>
                        </li>
                        <li class="nav-item">
                            <a href="#account-details" class="nav-link">Account details</a>
                        </li>
                        <li class="link-item">
                            <a href="{{ route ('wishlist.index') }}">Wishlist</a>
                        </li>
                        <li class="link-item">
                            <a href="{{ route ('login.logout') }}">Logout</a>
                        </li>
                    </ul>
                    
                    <div class="tab-content mb-6">
                        @include('errors.validation-errors')
                        @include('user.orders')
                        @include('user.edit')
                    </div>
                </div>
            </div>
        </div>
        <!-- End of PageContent -->
    </main>
    
    @include('partials._footer')
</x-home>