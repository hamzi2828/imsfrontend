<section class="category-section top-category bg-grey pt-10 pb-10 appear-animate fadeIn appear-animation-visible"
         style="animation-duration: 1.2s;">
    <div class="container pb-2">
        <h2 class="title justify-content-center pt-1 ls-normal mb-5">Top Categories</h2>
        <div class="swiper">
            <div class="swiper-container swiper-theme pg-show swiper-container-initialized swiper-container-horizontal swiper-container-pointer-events"
                 data-swiper-options="{
                            'spaceBetween': 20,
                            'slidesPerView': 2,
                            'breakpoints': {
                                '576': {
                                    'slidesPerView': 3
                                },
                                '768': {
                                    'slidesPerView': 5
                                },
                                '992': {
                                    'slidesPerView': 6
                                }
                            }
                        }">
                <div class="swiper-wrapper " id="swiper-wrapper-9310bc3bf24b815310" aria-live="polite"
                     style="transform: translate3d(0px, 0px, 0px);">
                    @if(count ($top_categories) > 0)
                        @foreach($top_categories as $category)
                            <div class="swiper-slide category category-classic category-absolute overlay-zoom br-xs swiper-slide-active"
                                 role="group" aria-label="1 / 6" style="width: 190px; margin-right: 20px;">
                                <a href="{{ route ('products.index', ['category' => $category -> slug]) }}"
                                   class="category-media">
                                    <img src="{{ serverPath ($category -> image) }}" alt="Category" width="130"
                                         height="130">
                                </a>
                                <div class="category-content">
                                    <h4 class="category-name">{{ $category -> title }}</h4>
                                    <a href="{{ route ('products.index', ['category' => $category -> slug]) }}"
                                       class="btn btn-primary btn-link btn-underline">
                                        Shop Now
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
                <span class="swiper-notification" aria-live="assertive" aria-atomic="true"></span></div>
        </div>
    </div>
</section>