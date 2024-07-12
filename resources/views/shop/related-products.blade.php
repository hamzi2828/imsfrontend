@if(count ($relatedProducts) > 0)
    <section class="related-product-section">
        <div class="title-link-wrapper mb-4">
            <h4 class="title">Related Products</h4>
            <a href="{{ route ('products.index') }}" class="btn btn-dark btn-link btn-slide-right btn-icon-right">
                More Products
                <i class="w-icon-long-arrow-right"></i>
            </a>
        </div>
        <div class="swiper-container swiper-theme" data-swiper-options="{
                                    'spaceBetween': 20,
                                    'slidesPerView': 2,
                                    'breakpoints': {
                                        '576': {
                                            'slidesPerView': 3
                                        },
                                        '768': {
                                            'slidesPerView': 4
                                        },
                                        '992': {
                                            'slidesPerView': 3
                                        }
                                    }
                                }">
            <div class="swiper-wrapper row cols-lg-3 cols-md-4 cols-sm-3 cols-2">
                @foreach($relatedProducts as $relatedProduct)
                    <div class="swiper-slide product">
                        <figure class="product-media">
                            <a href="{{ route ('products.show', ['product' => $relatedProduct -> slug]) }}">
                                <img src="{{ serverPath ($relatedProduct -> image) }}"
                                     alt="{{ $relatedProduct -> title() }}"
                                     style="max-height: 250px" />
                            </a>
                            <div class="product-action-vertical">
                                @include('product-actions', ['product' => $relatedProduct])
                            </div>
                            <div class="product-action">
                                <a href="javascript:void(0)" class="btn-product" title="Quick View"
                                   onclick="initProductQuickView('{{ route ('products.quick-view', ['product' => $relatedProduct -> slug]) }}')">
                                    Quick View
                                </a>
                            </div>
                        </figure>
                        <div class="product-details">
                            <h4 class="product-name">
                                <a href="{{ route ('products.show', ['product' => $relatedProduct -> slug]) }}">
                                    {{ $relatedProduct -> title() }}
                                </a>
                            </h4>
                            @include('product-ratings', ['product' => $relatedProduct])
                            <div class="product-pa-wrapper">
                                <div class="product-price">
                                    {{ number_format ($relatedProduct -> discountPrice(), 2) }}
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endif