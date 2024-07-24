{{-- @if(count ($category_products) > 0)
    @foreach($category_products as $category)
        <div class="product-wrapper-1 appear-animate mb-5 category-products">
            <div class="title-link-wrapper pb-1 mb-4">
                <h2 class="title ls-normal mb-0">
                    @if($category -> parentCategory)
                        {{ $category -> parentCategory ?-> title }}
                        <i class="w-icon-long-arrow-right"
                           style="padding-left: 5px; padding-right: 5px; font-size: 16px;"></i>
                    @endif
                    {{ $category -> title }}
                </h2>
                <a href="{{ route ('products.index', ['category' => $category -> slug]) }}"
                   class="font-size-normal font-weight-bold ls-25 mb-0">
                    More Products
                    <i class="w-icon-long-arrow-right"></i>
                </a>
            </div>
            <div class="row">
                <div class="col-lg-3 col-sm-4 mb-4">
                    <div class="banner h-100 br-sm" style="background-image: url('{{ serverPath ($category -> image) }}');
                                background-color: #ebeced;">
                    </div>
                </div>
                <!-- End of Banner -->
                <div class="col-lg-9 col-sm-8">
                    <div class="swiper-container swiper-theme" data-swiper-options="{
                                'spaceBetween': 20,
                                'slidesPerView': 2,
                                'breakpoints': {
                                    '992': {
                                        'slidesPerView': 3
                                    },
                                    '1200': {
                                        'slidesPerView': 4
                                    }
                                }
                            }">
                        <div class="swiper-wrapper row cols-xl-4 cols-lg-3 cols-2">
                            @if(count ($category -> products) > 0)
                                @foreach($category -> products as $categoryProduct)
                                    <div class="swiper-slide product-col">
                                        <div class="product-wrap product text-center">
                                            <figure class="product-media">
                                                <a href="{{ route ('products.show', ['product' => $categoryProduct -> slug]) }}">
                                                    <img src="{{ serverPath ($categoryProduct -> image) }}"
                                                         alt="{{ $categoryProduct -> title() }}"
                                                         width="216" height="243" />
                                                </a>
                                                <div class="product-action-vertical">
                                                    @include('product-actions', ['product' => $categoryProduct])
                                                </div>
                                            </figure>
                                            <div class="product-details">
                                                <h4 class="product-name">
                                                    <a href="{{ route ('products.show', ['product' => $categoryProduct -> slug]) }}">
                                                        {{ $categoryProduct -> title() }}
                                                    </a>
                                                </h4>
                                                @include('product-ratings', ['product' => $categoryProduct])
                                                <div class="product-price">
                                                    @include('product-price', ['product' => $categoryProduct])
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                        <div class="swiper-pagination"></div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@endif --}}


@if(count($category_products) > 0)
    @php
        $count = 0; // Initialize counter
    @endphp
    @foreach($category_products as $category)
        @if($count >= 11)
            @break // Stop after 12 iterations
        @endif
        @if($category->parent_id === null && $category->status === 'active' && !$category->trashed()) 
          {{-- @if($category->status === 'active' && !$category->trashed()) <!-- Check if the category is active and not soft-deleted --> --}}
            <div class="product-wrapper-1 appear-animate mb-5 category-products">
                <div class="title-link-wrapper pb-1 mb-4">
                    <h2 class="title ls-normal mb-0">
                        @if($category->parentCategory)
                            {{ $category->parentCategory?->title }}
                            <i class="w-icon-long-arrow-right"
                               style="padding-left: 5px; padding-right: 5px; font-size: 16px;"></i>
                        @endif
                        {{ $category->title }}
                    </h2>
                    <a href="{{ route('products.index', ['category' => $category->slug]) }}"
                       class="font-size-normal font-weight-bold ls-25 mb-0">
                        More Products
                        <i class="w-icon-long-arrow-right"></i>
                    </a>
                </div>
                <div class="row">
                    <div class="col-lg-3 col-sm-4 mb-4">
                        <div class="banner h-100 br-sm" style="background-image: url('{{ serverPath($category->image) }}');
                                    background-color: #ebeced;">
                        </div>
                    </div>
                    <!-- End of Banner -->
                    <div class="col-lg-9 col-sm-8">
                        <div class="swiper-container swiper-theme" data-swiper-options="{
                                    'spaceBetween': 20,
                                    'slidesPerView': 2,
                                    'breakpoints': {
                                        '992': {
                                            'slidesPerView': 3
                                        },
                                        '1200': {
                                            'slidesPerView': 4
                                        }
                                    }
                                }">
                            <div class="swiper-wrapper row cols-xl-4 cols-lg-3 cols-2">
                                @if(count($category->products) > 0)
                                    @foreach($category->products as $categoryProduct)
                                        @if($loop->iteration > 12) @break @endif
                                        <div class="swiper-slide product-col">
                                            <div class="product-wrap product text-center">
                                                <figure class="product-media">
                                                    <a href="{{ route('products.show', ['product' => $categoryProduct->slug]) }}">
                                                        <img src="{{ serverPath($categoryProduct->image) }}"
                                                             alt="{{ $categoryProduct->title() }}"
                                                             width="216" height="243" />
                                                    </a>
                                                    <div class="product-action-vertical">
                                                        @include('product-actions', ['product' => $categoryProduct])
                                                    </div>
                                                </figure>
                                                <div class="product-details">
                                                    <h4 class="product-name">
                                                        <a href="{{ route('products.show', ['product' => $categoryProduct->slug]) }}">
                                                            {{ $categoryProduct->title() }}
                                                        </a>
                                                    </h4>
                                                    @include('product-ratings', ['product' => $categoryProduct])
                                                    <div class="product-price">
                                                        @include('product-price', ['product' => $categoryProduct])
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                            <div class="swiper-pagination"></div>
                        </div>
                    </div>
                </div>
            </div>
        @endif

        @php
            $count++; // Increment counter
        @endphp
    @endforeach
@endif
