<x-home :title="$title">
    @push('styles')
        <link rel="stylesheet" type="text/css" href="{{ asset('/assets/css/demo1.min.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('/path-to-magnific-popup/magnific-popup.css') }}">
    @endpush
    @include('partials._topbar')
    
    <!-- Start of Main --> 
    <main class="main">
        
        @include('_slider')
        
        @includeWhen(optional (siteSettings () -> settings) -> display_top_categories, 'partials._top-categories')
        
        <div class="container">
            <div class="swiper-container appear-animate icon-box-wrapper br-sm mt-6 mb-6" data-swiper-options="{
                    'slidesPerView': 1,
                    'loop': false,
                    'breakpoints': {
                        '576': {
                            'slidesPerView': 2
                        },
                        '768': {
                            'slidesPerView': 3
                        },
                        '1200': {
                            'slidesPerView': 4
                        }
                    }
                }">
                <div class="swiper-wrapper row cols-md-4 cols-sm-3 cols-1">
                    <div class="swiper-slide icon-box icon-box-side icon-box-primary">
                            <span class="icon-box-icon icon-shipping">
                                <i class="w-icon-truck"></i>
                            </span>
                        <div class="icon-box-content">
                            <h4 class="icon-box-title font-weight-bold mb-1">Return as Per Policy</h4>
                            <p class="text-default">For all orders</p>
                        </div>
                    </div>
                    <div class="swiper-slide icon-box icon-box-side icon-box-primary">
                            <span class="icon-box-icon icon-payment">
                                <i class="w-icon-bag"></i>
                            </span>
                        <div class="icon-box-content">
                            <h4 class="icon-box-title font-weight-bold mb-1">Secure Payment</h4>
                            <p class="text-default">We ensure secure payment for COD</p>
                        </div>
                    </div>
                    <div class="swiper-slide icon-box icon-box-side icon-box-primary icon-box-money">
                            <span class="icon-box-icon icon-money">
                                <i class="w-icon-money"></i>
                            </span>
                        <div class="icon-box-content">
                            <h4 class="icon-box-title font-weight-bold mb-1">High Quality Guaranteed</h4>
                            <p class="text-default">On all products</p>
                        </div>
                    </div>
                    <div class="swiper-slide icon-box icon-box-side icon-box-primary icon-box-chat">
                            <span class="icon-box-icon icon-chat">
                                <i class="w-icon-chat"></i>
                            </span>
                        <div class="icon-box-content">
                            <h4 class="icon-box-title font-weight-bold mb-1">Customer Support</h4>
                            <p class="text-default">Call or email us 24/7</p>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End of Icon Box Wrapper -->
            
            <div class="row category-banner-wrapper appear-animate pt-6 pb-8">
                <div class="col-md-6 mb-4">
                    <div class="banner banner-fixed br-xs">
                        <figure>
                            <img src="{{ $banners -> banner_1 }}"
                                 alt="Category Banner" style="object-fit: contain"
                                 width="610" height="160" />
                        </figure>
                    </div>
                </div>
                <div class="col-md-6 mb-4">
                    <div class="banner banner-fixed br-xs">
                        <figure>
                            <img src="{{ $banners -> banner_2 }}"
                                 alt="Category Banner" style="object-fit: contain"
                                 width="610" height="160" />
                        </figure>
                    </div>
                </div>
            </div>
            <!-- End of Category Banner Wrapper -->
            
            <div class="row deals-wrapper appear-animate mb-8">
                @include('deals')
                @include('best-selling')
            </div>
            <!-- End of Deals Wrapper -->
        </div>
        <!-- End of .category-section top-category -->
        
        <div class="container">
            @include('popular-departments')
            <div class="row category-cosmetic-lifestyle appear-animate mb-5">
                <div class="col-md-6 mb-4">
                    <div class="banner banner-fixed category-banner-1 br-xs">
                        <figure>
                            <img src="{{ $banners -> banner_3 }}"
                                 alt="Category Banner" style="object-fit: contain"
                                 width="610" height="200" />
                        </figure>
                    </div>
                </div>
                <div class="col-md-6 mb-4">
                    <div class="banner banner-fixed category-banner-2 br-xs">
                        <figure>
                            <img src="{{ $banners -> banner_4 }}"
                                 alt="Category Banner" style="object-fit: contain"
                                 width="610" height="200" />
                        </figure>
                    </div>
                </div>
            </div>
            <!-- End of Category Cosmetic Lifestyle -->
            
            @include('category-wise-products')
            
            {{--   @include('blog')--}}
            <!-- Post Wrapper -->
            
            @include('recent-views', ['products' => $products])
            <!-- End of Reviewed Products -->
        </div>
        <!-- End of Container -->

        @include('popup', ['banners' => $banners])


    </main>
    <!-- End of Main -->
    
    @include('partials._footer')
</x-home>
