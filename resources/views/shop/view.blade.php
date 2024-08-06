
<x-home :title="$title">
    @push('styles')
        <link rel="stylesheet" type="text/css" href="{{ asset('/assets/css/style.min.css') }}">
    @endpush
    @include('partials._topbar')
    
    <main class="main mb-10 pb-1 mt-5">
        <!-- Start of Page Content -->
        <div class="page-content">
            <div class="container">
                <div class="row gutter-lg">
                    <div class="main-content">
                        @include('errors.validation-errors')
                        <div class="product product-single row mt-2">
                            <div class="col-md-6 mb-6">
                                <div class="product-gallery product-gallery-sticky">
                                    <div class="swiper-container product-single-swiper swiper-theme nav-inner"
                                         data-swiper-options="{
                                            'navigation': {
                                                'nextEl': '.swiper-button-next',
                                                'prevEl': '.swiper-button-prev'
                                            }
                                        }">
                                        <div class="swiper-wrapper row cols-1 gutter-no">
                                            <div class="swiper-slide">
                                                <figure class="product-image">
                                                    <img src="{{ serverPath ($product -> image) }}"
                                                         data-zoom-image="{{ serverPath ($product -> image) }}"
                                                         alt="{{ $product -> title() }}" width="800" height="900">
                                                </figure>
                                            </div>
                                            @if(count ($product -> product_images) > 0)
                                                 @foreach($product -> product_images as $image)
                                                    <div class="swiper-slide">
                                                        <figure class="product-image">
                                                            <img src="{{ $image -> image }}"
                                                                 data-zoom-image="{{ $image -> image }}"
                                                                 alt="{{ $product -> title() }}" width="488"
                                                                 height="549">
                                                        </figure>
                                                    </div>
                                                @endforeach
                                            @endif
                                        </div>
                                        <button class="swiper-button-next"></button>
                                        <button class="swiper-button-prev"></button>
                                        <a href="#" class="product-gallery-btn product-image-full">
                                            <i class="w-icon-zoom"></i>
                                        </a>
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
                                                        <img src="{{ $image -> image }}"
                                                             alt="{{ $product -> title() }}" width="800" height="900">
                                                    </div>
                                                @endforeach
                                            @endif
                                        </div>
                                        <button class="swiper-button-next"></button>
                                        <button class="swiper-button-prev"></button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 mb-4 mb-md-6">
                                <div class="product-details" data-sticky-options="{'minWidth': 767}">
                                    <h1 class="product-title">{{ $product -> title() }}</h1>
                                    <div class="product-bm-wrapper">
                                        <figure class="brand">
                                            <img src="{{ serverPath ($product -> image) }}"
                                                 alt="Brand"
                                                 width="102" height="48" />
                                        </figure>
                                        <div class="product-meta">
                                            <div class="product-categories">
                                                Category:
                                                <span class="product-category">
                                                    <a href="#">{{ $product -> category ?-> title }}</a>
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
                                    
                                    @include('product-ratings', ['product' => $product])
                                    
                                    <div class="product-short-desc">
                                        {!! $product -> excerpt !!}
                                    </div>
                                    
                                    <hr class="product-divider">
                                    
                                    @if(count ($variations) > 0)
                                        @foreach($variations as $variation)
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
                                    @if($product -> variations() -> count() < 1)
                                        @if($product -> available_quantity() > 0)
                                            <div class="fix-bottom product-sticky-content sticky-content">
                                                <div class="product-form container">
                                                    <div class="product-qty-form" style="margin-bottom: 0">
                                                        <div class="input-group">
                                                            <input class="quantity form-control" type="number" min="1"
                                                                   max="{{ $product -> available_quantity()  }}"
                                                                   id="cart-quantity">
                                                            <button class="quantity-plus w-icon-plus"></button>
                                                            <button class="quantity-minus w-icon-minus"></button>
                                                        </div>
                                                    </div>
                                                    <button class="btn btn-primary"
                                                            onclick="addToCart(this, '{{ route ('cart.store', ['product' => $product -> slug]) }}', {{ $product -> available_quantity() }})">
                                                        <i class="w-icon-cart mr-2"></i>
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
                                        <div class="social-links">
                                            <div class="social-icons social-no-color border-thin">
                                                <!-- Facebook -->
                                                <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(url()->current()) }}" 
                                                   target="_blank" 
                                                   class="social-icon social-facebook w-icon-facebook" 
                                                   title="Share on Facebook"></a>
                                                
                                                <!-- Twitter -->
                                                <a href="https://twitter.com/intent/tweet?url={{ urlencode(url()->current()) }}&text={{ urlencode($product->title()) }}" 
                                                   target="_blank" 
                                                   class="social-icon social-twitter w-icon-twitter" 
                                                   title="Share on Twitter"></a>
                                                
                                                <!-- Pinterest -->
                                                <a href="https://pinterest.com/pin/create/button/?url={{ urlencode(url()->current()) }}&media={{ urlencode($product->image) }}&description={{ urlencode($product->title()) }}" 
                                                   target="_blank" 
                                                   class="social-icon social-pinterest fab fa-pinterest-p" 
                                                   title="Share on Pinterest"></a>
                                                
                                                <!-- WhatsApp -->
                                                <a href="https://api.whatsapp.com/send?text={{ urlencode($product->title()) }}%20{{ urlencode(url()->current()) }}" 
                                                   target="_blank" 
                                                   class="social-icon social-whatsapp fab fa-whatsapp" 
                                                   title="Share on WhatsApp"></a>
                                                
                                                <!-- LinkedIn -->
                                                <a href="https://www.linkedin.com/sharing/share-offsite/?url={{ urlencode(url()->current()) }}" 
                                                   target="_blank" 
                                                   class="social-icon social-linkedin fab fa-linkedin-in" 
                                                   title="Share on LinkedIn"></a>
                                            </div>
                                              
                                        </div>
                                        

                                        <div class="product-link-wrapper d-flex">
                                            <a href="javascript:void(0)" id="wishlist-{{ $product -> id }}"
                                               onclick="addToWishList('{{ route ('products.add-to-wishlist', ['product' => $product -> slug]) }}')"
                                               class="btn-product-icon btn-wishlist {{ isWishList($product -> id) ? 'w-icon-heart-full' : 'w-icon-heart' }}"><span></span></a>
                                        </div>
                                    </div>
                                </div>
                            </div> 
                        </div>
                        <div class="tab tab-nav-boxed tab-nav-underline product-tabs">
                            <ul class="nav nav-tabs" role="tablist">
                                <li class="nav-item">
                                    <a href="#product-tab-description" class="nav-link active">Description</a>
                                </li>
                                <li class="nav-item">
                                    <a href="#product-tab-reviews" class="nav-link">Customer Reviews
                                                                                    ({{ $product -> reviews -> count() }}
                                                                                    )</a>
                                </li>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane active" id="product-tab-description">
                                    <div class="row mb-4">
                                        {!! $product -> description !!}
                                    </div>
                                </div>
                                @include('shop.product-reviews', ['product' => $product])
                            </div>
                        </div>
                        @include('shop.related-products')
                    </div>
                    <!-- End of Main Content -->
                    <aside class="sidebar product-sidebar sidebar-fixed right-sidebar sticky-sidebar-wrapper">
                        <div class="sidebar-overlay"></div>
                        <a class="sidebar-close" href="#"><i class="close-icon"></i></a>
                        <a href="#" class="sidebar-toggle d-flex d-lg-none"><i class="fas fa-chevron-left"></i></a>
                        <div class="sidebar-content scrollable">
                            <div class="sticky-sidebar">
                                <div class="widget widget-icon-box mb-6">
                                    <div class="icon-box icon-box-side">
                                            <span class="icon-box-icon text-dark">
                                                <i class="w-icon-bag"></i>
                                            </span>
                                        <div class="icon-box-content">
                                            <h4 class="icon-box-title">Secure Payment</h4>
                                            <p>We ensure secure payment</p>
                                        </div>
                                    </div>
                                    <div class="icon-box icon-box-side">
                                            <span class="icon-box-icon text-dark">
                                                <i class="w-icon-money"></i>
                                            </span>
                                        <div class="icon-box-content">
                                            <h4 class="icon-box-title">Money Back Guarantee</h4>
                                            <p>Any back within 5 days</p>
                                        </div>
                                    </div>
                                </div>
                                <!-- End of Widget Icon Box -->
                                
                                @if(!empty(trim (optional (siteSettings () -> settings) -> sidebar_image)))
                                    <div class="widget widget-banner mb-9">
                                        <div class="banner banner-fixed br-sm">
                                            <figure>
                                                <img src="{{ serverPath (optional (siteSettings () -> settings) -> sidebar_image) }}"
                                                     alt="Banner"
                                                     width="266"
                                                     height="220" style="background-color: #1D2D44;" />
                                            </figure>
                                        </div>
                                    </div>
                                @endif
                                <!-- End of Widget Banner -->
                            </div>
                        </div>
                    </aside>
                    <!-- End of Sidebar -->
                </div>
            </div>
        </div>
        <!-- End of Page Content -->
    </main>
    @include('partials._footer')

</x-home>
