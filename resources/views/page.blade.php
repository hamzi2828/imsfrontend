<x-home :title="$title">
    @push('styles')
        <link rel="stylesheet" type="text/css" href="{{ asset('/assets/css/style.min.css') }}">
    @endpush
    @include('partials._topbar')
    
    <!-- Start of Main-->
    <main class="main">
        <!-- Start of Page Header -->
        <div class="page-header">
            <div class="container">
                <h1 class="page-title mb-0">
                    {{ str () -> replace ( '-', ' ', ucwords ( $page -> page_name ) ) }}
                </h1>
            </div>
        </div>
        <!-- End of Page Header -->
        
        <!-- Start of Breadcrumb -->
        <nav class="breadcrumb-nav mb- pb-4">
            <div class="container">
                <ul class="breadcrumb">
                    <li><a href="{{ route ('home') }}">Home</a></li>
                    <li>{{ str () -> replace ( '-', ' ', ucwords ( $page -> page_name ) ) }}</li>
                </ul>
            </div>
        </nav>
        <!-- End of Breadcrumb -->
        
        <!-- Start of Page Content -->
        <div class="page-content">
            <div class="container">
                {!! $page -> content !!}
            </div>
        </div>
    </main>
    <!-- End of Main -->
    
    @include('partials._footer')
</x-home>