@if(count ($deals) > 0)
    <div class="col-lg-9 mb-4">
        <div class="single-product br-sm">
            <h4 class="title-sm title-underline font-weight-bolder ls-normal">
                Hot Deals of The Day
            </h4>
            <div class="swiper">
                <div class="swiper-container swiper-theme nav-top swiper-nav-lg" data-swiper-options="{
                                    'spaceBetween': 20,
                                    'slidesPerView': 1
                                }">
                    <div class="swiper-wrapper row cols-1 gutter-no">
                        @foreach($deals as $deal)
                            <div class="swiper-slide">
                                <div class="product product-single row">
                                    <div class="col-md-6">
                                        <div class="product-gallery product-gallery-sticky product-gallery-vertical">
                                            <div class="swiper-container product-single-swiper swiper-theme nav-inner">
                                                <div class="swiper-wrapper row cols-1 gutter-no">
                                                    <div class="swiper-slide">
                                                        <figure class="product-image">
                                                            <img src="{{ serverPath($deal -> image) }}"
                                                                 data-zoom-image="{{ serverPath($deal -> image) }}"
                                                                 alt="Product Image" width="800"
                                                                 height="900">
                                                        </figure>
                                                    </div>
                                                    
                                                    @if(count ($deal -> product_images) > 0)
                                                        @foreach($deal -> product_images as $productImage)
                                                            <div class="swiper-slide">
                                                                <figure class="product-image">
                                                                    <img src="{{ $productImage -> image }}"
                                                                         data-zoom-image="{{ $productImage -> image }}"
                                                                         alt="Product Image" width="800"
                                                                         height="900">
                                                                </figure>
                                                            </div>
                                                        @endforeach
                                                    @endif
                                                </div>
                                                <button class="swiper-button-next"></button>
                                                <button class="swiper-button-prev"></button>
                                            </div>
                                            <div class="product-thumbs-wrap swiper-container"
                                                 data-swiper-options="{
                                                            'direction': 'vertical',
                                                            'breakpoints': {
                                                                '0': {
                                                                    'direction': 'horizontal',
                                                                    'slidesPerView': 4
                                                                },
                                                                '992': {
                                                                    'direction': 'vertical',
                                                                    'slidesPerView': 'auto'
                                                                }
                                                            }
                                                        }">
                                                <div class="product-thumbs swiper-wrapper row cols-lg-1 cols-4 gutter-sm">
                                                    <div class="product-thumb swiper-slide">
                                                        <img src="{{ serverPath($deal -> image) }}"
                                                             alt="Product thumb" width="60" height="68" />
                                                    </div>
                                                    @if(count ($deal -> product_images) > 0)
                                                        @foreach($deal -> product_images as $productImage)
                                                            <div class="product-thumb swiper-slide">
                                                                <img src="{{ $productImage -> image }}"
                                                                     alt="Product thumb" width="60" height="68" />
                                                            </div>
                                                        @endforeach
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="product-details scrollable">
                                            <h2 class="product-title mb-1">
                                                <a href="{{ route ('products.show', ['product' => $deal -> slug]) }}">
                                                    {{ $deal -> title() }}
                                                </a>
                                            </h2>
                                            
                                            <hr class="product-divider">
                                            
                                            <div class="product-price">
                                                @include('product-price', ['product' => $deal])
                                            </div>
                                            
                                            @include('product-ratings', ['product' => $deal])
                                            @include('add-to-cart', ['product' => $deal])
                                            <div class="social-links-wrapper mt-1">
{{--                                                @include('product-share-icons', ['product' => $deal])--}}
{{--                                                 <span class="divider d-xs-show"></span> --}}
                                                <div class="product-link-wrapper d-flex">
                                                    <a href="javascript:void(0)" id="wishlist-{{ $deal -> id }}"
                                                       onclick="addToWishList('{{ route ('products.add-to-wishlist', ['product' => $deal -> slug]) }}')"
                                                       class="btn-product-icon btn-wishlist {{ isWishList($deal -> id) ? 'w-icon-heart-full' : 'w-icon-heart' }}"></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <button class="swiper-button-prev"></button>
                    <button class="swiper-button-next"></button>
                </div>
            </div>
        </div>
    </div>
@endif