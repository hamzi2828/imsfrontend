<x-home :title="$title">
    @push('styles')
        <link rel="stylesheet" type="text/css" href="{{ asset('/assets/css/style.min.css') }}">
    @endpush
    @include('partials._topbar')
<style>
 .widget-body ul {
    list-style: none;
    padding-left: 20px;
}

.widget-body ul ul {
    display: none;
}

.widget-body li.open > ul {
    display: block;
}

.arrow {
    display: inline-block;
    width: 0;
    height: 0;
    border-style: solid;
    border-width: 5px 5px 0 5px;
    border-color: #000 transparent transparent transparent;
    margin-left: 5px; /* Adjust spacing as needed */
    transition: transform 0.3s ease; /* Optional: add transition for smooth animation */
}

.arrow.open {
    transform: rotate(180deg); /* Rotate arrow for open state */
}




</style>

@php
    $display_shop_banner = optional(siteSettings()->settings)->display_shop_banner;


    $display_shop_categories = optional(siteSettings()->settings)->display_shop_categories;
@endphp



    <main class="main mt-5">
        <!-- Start of Page Content -->
        <div class="page-content">
            <div class="container">
                 @if($display_shop_banner === 'yes')
            <!-- Start of Shop Banner -->
            <div class="shop-default-banner banner d-flex align-items-center mb-5 br-xs"
                style="background-image: url({{ asset($home_settings->shop_banner_image ?? 'assets/images/shop/banner1.jpg') }}); background-color: #FFC74E;">
                <div class="banner-content">
                    <h4 class="banner-subtitle font-weight-bold">{{ $home_settings->shop_banner_subtitle ?? 'All Collection' }}</h4>
                    <h3 class="banner-title text-white text-uppercase font-weight-bolder ls-normal">{{ $home_settings->shop_banner_title ?? 'Discover New Collection ' }}</h3>
                    <a href="{{ $home_settings->shop_banner_link ?? 'shop-banner-sidebar.html' }}" class="btn btn-dark btn-rounded btn-icon-right">
                        {{ $home_settings->shop_banner_button_text ?? 'Discover Now' }}<i class="w-icon-long-arrow-right"></i>
                    </a>
                </div>
            </div>
            <!-- End of Shop Banner -->

               @endif

               @if($display_shop_categories === 'yes')
                 <!-- Start of Shop Category -->
                <div class="shop-default-category category-ellipse-section mb-6">
                    <div class="swiper-container swiper-theme shadow-swiper"
                        data-swiper-options="{
                        'spaceBetween': 20,
                        'slidesPerView': 2,
                        'breakpoints': {
                            '480': {
                                'slidesPerView': 3
                            },
                            '576': {
                                'slidesPerView': 4
                            },
                            '768': {
                                'slidesPerView': 6
                            },
                            '992': {
                                'slidesPerView': 7
                            },
                            '1200': {
                                'slidesPerView': 8,
                                'spaceBetween': 30
                            }
                        }
                    }">
                        <div class="swiper-wrapper row gutter-lg cols-xl-8 cols-lg-7 cols-md-6 cols-sm-4 cols-xs-3 cols-2">
                            @if(count ($top_categories) > 0)
                            @foreach($top_categories as $category)

                            <div class="swiper-slide category-wrap">
                                <div class="category category-ellipse">
                                    <figure class="category-media">
                                        <a href="{{ route ('products.index', ['category' => $category -> slug]) }}">
                                            <img src="{{ serverPath ($category -> image) }}" alt="Categroy"
                                                width="190" height="190" style="background-color: #5C92C0;" />
                                        </a>
                                    </figure>
                                    <div class="category-content">
                                        <h4 class="category-name">
                                            <a href="{{ route ('products.index', ['category' => $category -> slug]) }}">{{ $category -> title }}</a>
                                        </h4>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                      @endif
                        </div>
                        <div class="swiper-pagination"></div>
                    </div>
                </div>
                <!-- End of Shop Category -->           
                @endif


                <!-- Start of Shop Content -->
                <div class="shop-content row gutter-lg mb-10">
                    <!-- Start of Sidebar, Shop Sidebar -->
                    <aside class="sidebar shop-sidebar sticky-sidebar-wrapper sidebar-fixed">
                        <!-- Start of Sidebar Overlay -->
                        <div class="sidebar-overlay"></div>
                        <a class="sidebar-close" href="#"><i class="close-icon"></i></a>


                        <!-- Start of Sidebar Content -->
                        <div class="sidebar-content scrollable">
                            <!-- Start of Sticky Sidebar -->
                            <div class="sticky-sidebar">
                                <div class="filter-actions">
                                    <label>Filter :</label>
                                    <a href="#" class="btn btn-dark btn-link filter-clean">Clean All</a>
                                </div>
                                <!-- Start of Collapsible widget -->
                                <div class="widget widget-collapsible">
                                    <h3 class="widget-title"><span>All Categories</span></h3>
                                     <ul class="widget-body filter-items search-ul">
                                        @php $existingParams = request()->query(); @endphp
                                        @if (count($categories) > 0)
                                            @foreach ($categories as $category)
                                                @if ($category->parent_id == null && $category->status !== 'inactive')
                                                    @php $queryParams = array_merge($existingParams, ['category' => $category->slug]); @endphp
                                                    <li style="{{ request('category') == $category->slug ? 'font-weight: 700' : '' }}">
                                                        <a href="{{ route('products.index', $queryParams) }}">
                                                            {{ $category->title }}
                                                        </a>
                                                        @if ($category->subcategories->count() > 0)
                                                            <ul>
                                                                @foreach ($category->subcategories as $subCategory)
                                                                    @if ($subCategory->status !== 'inactive')
                                                                        @php $subQueryParams = array_merge($existingParams, ['category' => $subCategory->slug]); @endphp
                                                                        <li style="{{ request('category') == $subCategory->slug ? 'font-weight: 700' : '' }}">
                                                                            <a href="{{ route('products.index', $subQueryParams) }}">
                                                                                {{ $subCategory->title }}
                                                                            </a>
                                                                            @if ($subCategory->subcategories->count() > 0)
                                                                                <ul class="child-ul">
                                                                                    @foreach ($subCategory->subcategories as $childCategory)
                                                                                        @if ($childCategory->status !== 'inactive')
                                                                                            @php $childQueryParams = array_merge($existingParams, ['category' => $childCategory->slug]); @endphp
                                                                                            <li style="{{ request('category') == $childCategory->slug ? 'font-weight: 700' : '' }}">
                                                                                                <a href="{{ route('products.index', $childQueryParams) }}">
                                                                                                    {{ $childCategory->title }}
                                                                                                </a>
                                                                                            </li>
                                                                                        @endif
                                                                                    @endforeach
                                                                                </ul>
                                                                            @endif
                                                                        </li>
                                                                    @endif
                                                                @endforeach
                                                            </ul>
                                                        @endif
                                                    </li>
                                                @endif
                                            @endforeach
                                        @endif
                                    </ul>
                                    
                                </div>
                                <!-- End of Collapsible Widget -->

                                <!-- Start of Collapsible Widget -->
                                <div class="widget widget-collapsible">
                                    <h3
                                        class="widget-title {{ request()->filled('min-price') ? '' : 'collapsed' }}">
                                        <span>Price</span>
                                    </h3>
                                    <div class="widget-body">
                                        <ul class="filter-items search-ul">
                                            {!! $productPriceRange !!}
                                        </ul>
                                        <form class="price-range" method="get"
                                            action="{{ route('products.index', request()->all()) }}">
                                            <label>
                                                <input type="number" step="any" name="min-price"
                                                    class="min_price text-center" placeholder="min"
                                                    value="{{ request('min-price') }}">
                                            </label>
                                            <span class="delimiter">-</span>
                                            <label>
                                                <input type="number" step="any" name="max-price"
                                                    class="max_price text-center" placeholder="1max"
                                                    value="{{ request('max-price') }}">
                                            </label>
                                            <button type="submit" class="btn btn-primary btn-rounded">Go</button>
                                        </form>
                                    </div>
                                </div>
                                <!-- End of Collapsible Widget -->

                                <!-- Start of Collapsible Widget -->
                                <div class="widget widget-collapsible">
                                    <h3
                                        class="widget-title {{ request()->filled('manufacturer') ? '' : 'collapsed' }}">
                                        <span>Brand</span>
                                    </h3>
                                    <ul class="widget-body filter-items search-ul">
                                        @if (count($manufacturers) > 0)
                                            @foreach ($manufacturers as $manufacturer)
                                                @php $queryParams = array_merge ( $existingParams, [ 'manufacturer' => $manufacturer -> slug ] ); @endphp
                                                <li
                                                    style="{{ request('category') == $category->slug ? 'font-weight: 700' : '' }}">
                                                    <a href="{{ route('products.index', $queryParams) }}">
                                                        {{ $manufacturer->title }}
                                                    </a>
                                                </li>
                                            @endforeach
                                        @endif
                                    </ul>
                                </div>
                                <!-- End of Collapsible Widget -->
                            </div>
                            <!-- End of Sidebar Content -->
                        </div>
                        <!-- End of Sidebar Content -->
                    </aside>
                    <!-- End of Shop Sidebar -->

                    <!-- Start of Shop Main Content -->
                    <div class="main-content">
                        <form method="get" action="{{ route('products.index', request()->all()) }}">
                            @foreach (request()->all() as $key => $value)
                                @if (!in_array($key, ['orderBy', 'per-page', 'default', 'latest', 'asc', 'desc']))
                                    <input type="hidden" name="{{ $key }}" value="{{ $value }}">
                                @endif
                            @endforeach
                            <nav class="toolbox sticky-toolbox sticky-content fix-top">
                                <div class="toolbox-left">
                                    <a href="#"
                                        class="btn btn-primary btn-outline btn-rounded left-sidebar-toggle
                                        btn-icon-left d-block d-lg-none">
                                        <i class="w-icon-category"></i><span>Filters</span>
                                    </a>
                                    <div class="toolbox-item toolbox-sort select-box text-dark">
                                        <label for="orderBy">Sort By :</label>
                                        <select name="orderBy" class="form-control" id="orderBy"
                                            onchange="this.form.submit()">
                                            <option value="default" @selected(request('orderBy') == 'default')>
                                                Default sorting
                                            </option>
                                            <option value="latest" @selected(request('orderBy') == 'latest')>
                                                Sort by latest
                                            </option>
                                            <option value="asc" @selected(request('orderBy') == 'asc')>
                                                Sort by price: low to high
                                            </option>
                                            <option value="desc" @selected(request('orderBy') == 'desc')>
                                                Sort by price: high to low
                                            </option>
                                        </select>
                                    </div>
                                </div>
                                <div class="toolbox-right">
                                    <div class="toolbox-item toolbox-show select-box">
                                        <select name="per-page" class="form-control" onchange="this.form.submit()">
                                            <option value="25" @selected(request('per-page') == 25)>Show 25</option>
                                            <option value="50" @selected(request('per-page') == 50)>Show 50</option>
                                            <option value="100" @selected(request('per-page') == 100)>Show 100</option>
                                        </select>
                                    </div>
                                    <div class="toolbox-item toolbox-layout">
                                        <a href="{{ route('products.index', ['view' => 'grid']) }}"
                                            class="icon-mode-grid btn-layout {{ request('view') == 'grid' ? 'active' : '' }}">
                                            <i class="w-icon-grid"></i>
                                        </a>
                                        <a href="{{ route('products.index', ['view' => 'list']) }}"
                                            class="icon-mode-list btn-layout {{ request('view') == 'list' || !request('view') ? 'active' : '' }}">
                                            <i class="w-icon-list"></i>
                                        </a>
                                    </div>
                                </div>
                            </nav>
                        </form>
                        <div
                            class="product-wrapper row {{ request('view') == 'list' || !request('view') ? 'cols-md-1 cols-xs-2 cols-1' : 'cols-md-3 cols-sm-2 cols-2' }}">
                            @if (count($products) > 0)
                                @foreach ($products as $product)
                                    @if ($product->available_quantity() == 0 && $displayOutOfStockProducts != 1)
                                        @continue
                                        <!-- Skip to the next iteration if out of stock products should not be displayed -->
                                    @endif

                                    @if (request('view') == 'list' || !request('view'))
                                        <x-products-list :product="$product"></x-products-list>
                                    @else
                                        <x-products-card :product="$product"></x-products-card>
                                    @endif
                                @endforeach
                            @endif
                            <script>
                                document.addEventListener("DOMContentLoaded", function() {
                                    // Check if 'view' parameter is not already set in the URL
                                    const urlParams = new URLSearchParams(window.location.search);
                                    let view = urlParams.get('view');
                                
                                    // If 'view' parameter is not present, set it to 'grid' and redirect
                                    if (!view) {
                                        // Update the URL to include the 'view=grid' parameter
                                        urlParams.set('view', 'grid');
                                        window.location.search = urlParams.toString();
                                    }
                                });
                                </script>
                                
                        </div>
                        <div class="toolbox toolbox-pagination justify-content-between">
                            {!! $products->onEachSide(5)->appends(request()->query())->links('shop.pagination') !!}
                        </div>
                    </div>
                    <!-- End of Shop Main Content -->
                </div>
                <!-- End of Shop Content -->
            </div>
        </div>
        <!-- End of Page Content -->
    </main>

    <script>
document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('.widget-body > li').forEach(parentLi => {
        let parentLink = parentLi.querySelector('a');
        let childUl = parentLi.querySelector('ul');

        if (childUl) {
            // Create arrow element
            let arrow = document.createElement('span');
            arrow.className = 'arrow';
            parentLink.appendChild(arrow);

            // Hide all child ULs initially
            childUl.style.display = 'none';

            // Add click event listener
            parentLink.addEventListener('click', function(event) {
                event.preventDefault();
                parentLi.classList.toggle('open');
                childUl.style.display = childUl.style.display === 'block' ? 'none' : 'block';
                arrow.classList.toggle('open');
            });

            // Open second child by default
            let secondChildUl = childUl.querySelector('ul.child-ul');
            if (secondChildUl) {
                childUl.style.display = 'block'; // Open first level UL
                arrow.classList.add('open'); // Add open arrow icon
                secondChildUl.style.display = 'block'; // Open second level UL
            }
        }
    });
});


    </script>

    @include('partials._footer')
</x-home>
