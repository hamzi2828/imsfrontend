<!-- Start of Quick View -->
<div class="product product-single product-popup">
    <div class="row gutter-lg">
        <div class="col-md-6 mb-4 mb-md-0">
            <div class="product-gallery product-gallery-sticky">
                <div class="swiper-container product-single-swiper swiper-theme nav-inner">
                    <div class="swiper-wrapper row cols-1 gutter-no">
                        @if(count ($product -> product_images) > 0)
                            @foreach($product -> product_images as $image)
                                <div class="swiper-slide">
                                    <figure class="product-image">
                                        <img src="{{ $image -> image }}"
                                             data-zoom-image="{{ $image -> image }}"
                                             alt="{{ $product -> title() }}" width="800" height="900">
                                    </figure>
                                </div>
                            @endforeach
                        @else
                            <div class="swiper-slide">
                                <figure class="product-image">
                                    <img src="{{ serverPath($product -> image) }}"
                                         data-zoom-image="{{ serverPath($product -> image) }}"
                                         alt="{{ $product -> title() }}" width="800" height="900">
                                </figure>
                            </div>
                        @endif
                    </div>
                    <button class="swiper-button-next"></button>
                    <button class="swiper-button-prev"></button>
                </div>
                <div class="product-thumbs-wrap swiper-container" data-swiper-options="{
                        'navigation': {
                            'nextEl': '.swiper-button-next',
                            'prevEl': '.swiper-button-prev'
                        }
                    }">
                    <div class="product-thumbs swiper-wrapper row cols-4 gutter-sm">
                        @if(count ($product -> product_images) > 0)
                            @foreach($product -> product_images as $image)
                                <div class="product-thumb swiper-slide">
                                    <img src="{{ $image -> image }}" alt="{{ $product -> title() }}"
                                         width="103"
                                         height="116">
                                </div>
                            @endforeach
                        @else
                            <div class="product-thumb swiper-slide">
                                <img src="{{ serverPath($product -> image) }}" alt="{{ $product -> title() }}"
                                     width="103"
                                     height="116">
                            </div>
                        @endif
                    </div>
                    <button class="swiper-button-next"></button>
                    <button class="swiper-button-prev"></button>
                </div>
            </div>
        </div>
        <div class="col-md-6 overflow-hidden p-relative">
            <div class="product-details scrollable pl-0">
                <h2 class="product-title">{{ $product -> title() }}</h2>
                <div class="product-bm-wrapper">
                    <figure class="brand">
                        <img src="{{ serverPath($product -> image) }}" alt="{{ $product -> title() }}" width="102"
                             height="48" />
                    </figure>
                    <div class="product-meta">
                        <div class="product-categories">
                            Category:
                            <span class="product-category">
                                <a href="{{ route ('products.index', ['category' => $product -> category ?-> slug]) }}">
                                    {{ $product -> category ?-> title }}
                                </a>
                            </span>
                        </div>
                        <div class="product-sku">
                            SKU: <span>{{ $product -> sku }}</span>
                        </div>
                    </div>
                </div>
                
                <hr class="product-divider">
                
                <div class="product-price">
                    @include('product-price', ['product' => $product])
                </div>
                
                <div class="ratings-container">
                    <div class="ratings-full">
                        <span class="ratings" style="width: 80%;"></span>
                        <span class="tooltiptext tooltip-top"></span>
                    </div>
                    <a href="#" class="rating-reviews">(3 Reviews)</a>
                </div>
                
                <div class="product-short-desc">
                    {!! $product -> excerpt !!}
                </div>
                
                <hr class="product-divider">
                
                @if(count ($pVariations) > 0)
                    @foreach($pVariations as $variation)
                        <div class="product-form product-variation-form product-size-swatch">
                            @php
                                $attribute  = \App\Models\Attribute::find($variation -> attribute_id);
                                $terms      = explode (',', $variation -> terms);
                                $products   = explode (',', $variation -> products);
                            @endphp
                            <label class="mb-1">
                                {{ $attribute -> title }}:
                            </label>
                            @if(count ($terms) > 0)
                                <div class="flex-wrap d-flex align-items-center" style="gap: 10px">
                                    @foreach($terms as $key => $term_id)
                                        @php
                                            $term           = \App\Models\Term::find($term_id);
                                            $productInfo    = \App\Models\Product::find($products[$key]);
                                        @endphp
                                        <a href="{{ route ('products.show', ['product' => $productInfo -> slug]) }}"
                                           class="size">
                                            {{ $term -> title }}
                                        </a>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    @endforeach
                @endif
                
                @if($product -> variations -> count() < 1)
                    @if($product -> available_quantity() > 0)
                        <div class="fix-bottom product-sticky-content sticky-content">
                            <div class="product-form container">
                                <div class="product-qty-form" style="margin-bottom: 0">
                                    <div class="input-group">
                                        <input class="quantity form-control" type="number" min="1"
                                               max="{{ $product -> available_quantity()  }}" id="cart-quantity">
                                        <button class="quantity-plus w-icon-plus"></button>
                                        <button class="quantity-minus w-icon-minus"></button>
                                    </div>
                                </div>
                                <button class="btn btn-primary"
                                        onclick="addToCart(this, '{{ route ('cart.store', ['product' => $product -> slug]) }}', {{ $product -> available_quantity() }})">
                                    <i class="w-icon-cart"></i>
                                    <span>Add to Cart</span>
                                </button>
                            </div>
                        </div>
                    @else
                        <div class="fix-bottom product-sticky-content sticky-content">
                            <div class="product-form container">
                                <button class="btn btn-danger">
                                    <span>Out of Stock</span>
                                </button>
                            </div>
                        </div>
                    @endif
                @endif
                
                <div class="social-links-wrapper">
{{--                     <div class="social-links"> --}}
{{--                         @include('product-share-icons', ['product' => $product, 'class' => 'social-icons social-no-color border-thin']) --}}
{{--                     </div> --}}
{{--                     <span class="divider d-xs-show"></span> --}}
                    <div class="product-link-wrapper d-flex">
                        <a href="javascript:void(0)" id="wishlist-{{ $product -> id }}"
                           onclick="addToWishList('{{ route ('products.add-to-wishlist', ['product' => $product -> slug]) }}')"
                           class="btn-product-icon btn-wishlist {{ isWishList($product -> id) ? 'w-icon-heart-full' : 'w-icon-heart' }}"><span></span></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End of Quick view -->