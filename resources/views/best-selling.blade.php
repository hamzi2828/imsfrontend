@if(count ($best_selling) > 0)
    <div class="col-lg-3 mb-4">
        <div class="widget widget-products widget-products-bordered">
            <div class="widget-body br-sm h-100">
                <h4 class="title-sm title-underline font-weight-bolder ls-normal mb-2">
                    Top Best Seller
                </h4>
                <div class="swiper">
                    <div class="swiper-container swiper-theme nav-top" data-swiper-options="{
                                        'slidesPerView': 1,
                                        'spaceBetween': 20,
                                        'breakpoints': {
                                            '576': {
                                                'slidesPerView': 2
                                            },
                                            '768': {
                                                'slidesPerView': 3
                                            },
                                            '992': {
                                                'slidesPerView': 1
                                            }
                                        }
                                    }">
                        <div class="swiper-wrapper row cols-lg-1 cols-md-3">
                            <div class="swiper-slide product-widget-wrap">
                                @foreach($best_selling as $best_sold)
                                    <div class="product product-widget bb-no">
                                        <figure class="product-media">
                                            <a href="{{ route ('products.show', ['product' => $best_sold -> slug]) }}">
                                                <img src="{{ serverPath($best_sold -> image) }}"
                                                     alt="Product" width="105" height="118" />
                                            </a>
                                        </figure>
                                        <div class="product-details">
                                            <h4 class="product-name">
                                                <a href="{{ route ('products.show', ['product' => $best_sold -> slug]) }}">
                                                    {{ $best_sold -> title() }}
                                                </a>
                                            </h4>
                                            @include('product-ratings', ['product' => $best_sold])
                                            <div class="product-price">
                                                @include('product-price', ['product' => $best_sold])
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <button class="swiper-button-next"></button>
                        <button class="swiper-button-prev"></button>
                    </div>
                </div>
            
            </div>
        </div>
    </div>
@endif
