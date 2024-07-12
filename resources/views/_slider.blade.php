<section class="intro-section">
    <div class="swiper-container swiper-theme nav-inner pg-inner swiper-nav-lg animation-slider pg-xxl-hide nav-xxl-show nav-hide"
         data-swiper-options="{
                    'slidesPerView': 1,
                    'autoplay': {
                        'delay': 8000,
                        'disableOnInteraction': false
                    }
                }">
        <div class="swiper-wrapper">
            @if(count ($sliderProducts) > 0)
                @foreach($sliderProducts as $sliderProduct)
                    <div class="swiper-slide banner banner-fixed intro-slide intro-slide1"
                         style="background-image: url({{ asset ('/assets/images/demos/demo1/sliders/slide-1.jpg') }}); background-color: #ebeef2;">
                        <div class="container">
                            <figure class="slide-image skrollable slide-animate">
                                <img src="{{ serverPath ($sliderProduct -> slider_image) }}"
                                     alt="{{ $sliderProduct -> title() }}" style="max-height: 380px"
                                     data-bottom-top="transform: translateY(10vh);"
                                     data-top-bottom="transform: translateY(-10vh);" width="474" height="397">
                            </figure>
                            <div class="banner-content y-50 text-right">
                                <h5 class="banner-subtitle font-weight-normal text-default ls-25 slide-animate mb-0"
                                    data-animation-options="{
                                        'name': 'fadeInLeftShorter',
                                        'duration': '1s',
                                        'delay': '.4s'
                                    }">
                                    {{ $sliderProduct -> category ?-> title }}
                                </h5>
                                <h3 class="banner-title font-weight-bolder text-dark mb-0 ls-25 slide-animate"
                                    data-animation-options="{
                                        'name': 'fadeInUpShorter',
                                        'duration': '1s',
                                        'delay': '.4s'
                                    }">
                                    {{ $sliderProduct -> title() }}
                                </h3>
                                @if($sliderProduct -> term ?-> term)
                                    <h3 class="banner-title font-weight-bolder ls-25 lh-1 slide-animate"
                                        data-animation-options="{
                                    'name': 'fadeInRightShorter',
                                    'duration': '1s',
                                    'delay': '.4s'
                                }">
                                        {{ $sliderProduct -> term ?-> term ?-> title }}
                                    </h3>
                                @endif
                                
                                @if($sliderProduct -> discount > 0)
                                    <p class="font-weight-normal text-default slide-animate" data-animation-options="{
                                    'name': 'fadeInRightShorter',
                                    'duration': '1s',
                                    'delay': '.6s'
                                }">
                                        Sale up to
                                        <span class="font-weight-bolder text-secondary">
                                            {{ $sliderProduct -> discount }}% OFF
                                        </span>
                                    </p>
                                @endif
                                
                                <div class="btn-group slide-animate" data-animation-options="{
                                        'name': 'fadeInLeftShorter',
                                        'duration': '1s',
                                        'delay': '.8s'
                                    }">
                                    <a href="{{ route ('products.show', ['product' => $sliderProduct -> slug]) }}"
                                       class="btn btn-dark btn-outline btn-rounded btn-icon-right">
                                        SHOP NOW
                                        <i class="w-icon-long-arrow-right"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
        <div class="swiper-pagination"></div>
        <button class="swiper-button-next"></button>
        <button class="swiper-button-prev"></button>
    </div>
    <!-- End of .swiper-container -->
</section>
<!-- End of .intro-section -->