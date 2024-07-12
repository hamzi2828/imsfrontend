<x-home :title="$title">
    @push('styles')
        <link rel="stylesheet" type="text/css" href="{{ asset('/assets/css/style.min.css') }}">
        <style>
            .swiper-wrapper {
                display         : flex;
                flex-direction  : column;
                justify-content : center;
                align-items     : center;
                gap             : 40px;
            }
            
            .contact-us .icon-box-content p {
                text-overflow : unset;
                overflow      : unset;
            }
            
            .swiper-slide {
                width : 100% !important;
            }
        </style>
    @endpush
    @include('partials._topbar')
    
    <!-- Start of Main-->
    <main class="main">
        <!-- Start of Page Header -->
        <div class="page-header">
            <div class="container">
                <h1 class="page-title mb-0">Contact Us</h1>
            </div>
        </div>
        <!-- End of Page Header -->
        
        <!-- Start of PageContent -->
        <div class="page-content contact-us mt-10">
            <div class="container">
                <section class="contact-section">
                    <div class="row gutter-lg pb-3">
                        <div class="col-lg-6 mb-8">
                            <div class=" swiper-container swiper-theme " data-swiper-options="{
                                    'spaceBetween': 80,
                                    'slidesPerView': 1,
                                    'breakpoints': {
                                        '480': {
                                            'slidesPerView': 2
                                        },
                                        '768': {
                                            'slidesPerView': 3
                                        },
                                        '992': {
                                            'slidesPerView': 4
                                        }
                                    }
                                }">
                                <div class="swiper-wrapper row cols-xl-4 cols-md-3 cols-sm-2 cols-1">
                                    <div class="swiper-slide icon-box text-center icon-box-primary">
                                    <span class="icon-box-icon icon-email">
                                        <i class="w-icon-envelop-closed"></i>
                                    </span>
                                        <div class="icon-box-content">
                                            <h4 class="icon-box-title">E-mail Address</h4>
                                            <p>{{ optional (siteSettings () -> settings) -> email }}</p>
                                        </div>
                                    </div>
                                    <div class="swiper-slide icon-box text-center icon-box-primary">
                                    <span class="icon-box-icon icon-headphone">
                                        <i class="w-icon-headphone"></i>
                                    </span>
                                        <div class="icon-box-content">
                                            <h4 class="icon-box-title">Phone Number</h4>
                                            <p>{{ optional (siteSettings () -> settings) -> phone }}</p>
                                        </div>
                                    </div>
                                    <div class="swiper-slide icon-box text-center icon-box-primary">
                                    <span class="icon-box-icon icon-map-marker">
                                        <i class="w-icon-map-marker"></i>
                                    </span>
                                        <div class="icon-box-content">
                                            <h4 class="icon-box-title">Address</h4>
                                            <p>{{ optional (siteSettings () -> settings) -> address }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 mb-8">
                            @include('errors.validation-errors')
                            <h4 class="title mb-3">Send Us a Message</h4>
                            <form class="form contact-us-form" action="{{ route ('contact') }}" method="post">
                                @csrf
                                <div class="form-group">
                                    <label for="username">Your Name</label>
                                    <input type="text" id="username" name="name" required="required"
                                           class="form-control" value="{{ old ('name') }}">
                                </div>
                                <div class="form-group">
                                    <label for="email_1">Your Email</label>
                                    <input type="email" id="email_1" name="email" required="required"
                                           class="form-control" value="{{ old ('email') }}">
                                </div>
                                <div class="form-group">
                                    <label for="mobile">Mobile No</label>
                                    <input type="text" id="mobile" name="mobile" required="required"
                                           class="form-control" value="{{ old ('mobile') }}">
                                </div>
                                <div class="form-group">
                                    <label for="message">Your Message</label>
                                    <textarea id="message" name="message" cols="30" rows="5"
                                              class="form-control">{{ old ('message') }}</textarea>
                                </div>
                                <button type="submit" class="btn btn-dark btn-rounded">Send Now</button>
                            </form>
                        </div>
                    </div>
                </section>
                <!-- End of Contact Section -->
            </div>
        </div>
        <!-- End of PageContent -->
    </main>
    <!-- End of Main -->
    
    @include('partials._footer')
</x-home>