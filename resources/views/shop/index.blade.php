<x-home :title="$title">
    @push('styles')
        <link rel="stylesheet" type="text/css" href="{{ asset('/assets/css/style.min.css') }}">
    @endpush
    @include('partials._topbar')

    <main class="main mt-5">
        <!-- Start of Page Content -->
        <div class="page-content">
            <div class="container">
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
                                        @php $existingParams = request () -> query (); @endphp
                                        @if(count ($categories) > 0)
                                            @foreach($categories as $category)
                                                @php $queryParams = array_merge ( $existingParams, [ 'category' => $category -> slug ] ); @endphp
                                                <li style="{{ request ('category') == $category -> slug ? 'font-weight: 700' : '' }}">
                                                    <a href="{{ route ('products.index', $queryParams) }}">
                                                        @if($category -> parentCategory)
                                                            {{ $category -> parentCategory ?-> title }}
                                                            <i class="w-icon-long-arrow-right"></i>
                                                        @endif
                                                        {{ $category -> title }}
                                                    </a>
                                                </li>
                                            @endforeach
                                        @endif
                                    </ul>
                                </div>
                                <!-- End of Collapsible Widget -->

                                <!-- Start of Collapsible Widget -->
                                <div class="widget widget-collapsible">
                                    <h3 class="widget-title {{ request () -> filled ('min-price') ? '' : 'collapsed' }}">
                                        <span>Price</span>
                                    </h3>
                                    <div class="widget-body">
                                        <ul class="filter-items search-ul">
                                            {!! $productPriceRange !!}
                                        </ul>
                                        <form class="price-range" method="get"
                                              action="{{ route ('products.index', request () -> all ()) }}">
                                            <label>
                                                <input type="number" step="any" name="min-price"
                                                       class="min_price text-center"
                                                       placeholder="min" value="{{ request ('min-price') }}">
                                            </label>
                                            <span class="delimiter">-</span>
                                            <label>
                                                <input type="number" step="any" name="max-price"
                                                       class="max_price text-center"
                                                       placeholder="1max" value="{{ request ('max-price') }}">
                                            </label>
                                            <button type="submit" class="btn btn-primary btn-rounded">Go</button>
                                        </form>
                                    </div>
                                </div>
                                <!-- End of Collapsible Widget -->

                                <!-- Start of Collapsible Widget -->
                                <div class="widget widget-collapsible">
                                    <h3 class="widget-title {{ request () -> filled('manufacturer') ? '' : 'collapsed'}}">
                                        <span>Brand</span></h3>
                                    <ul class="widget-body filter-items search-ul">
                                        @if(count ($manufacturers) > 0)
                                            @foreach($manufacturers as $manufacturer)
                                                @php $queryParams = array_merge ( $existingParams, [ 'manufacturer' => $manufacturer -> slug ] ); @endphp
                                                <li style="{{ request ('category') == $category -> slug ? 'font-weight: 700' : '' }}">
                                                    <a href="{{ route ('products.index', $queryParams) }}">
                                                        {{ $manufacturer -> title }}
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
                        <form method="get" action="{{ route ('products.index', request () -> all ()) }}">
                            @foreach(request()->all() as $key => $value)
                                @if(!in_array($key, ['orderBy', 'per-page', 'default', 'latest', 'asc', 'desc']))
                                    <input type="hidden" name="{{ $key }}" value="{{ $value }}">
                                @endif
                            @endforeach
                            <nav class="toolbox sticky-toolbox sticky-content fix-top">
                                <div class="toolbox-left">
                                    <a href="#" class="btn btn-primary btn-outline btn-rounded left-sidebar-toggle
                                        btn-icon-left d-block d-lg-none">
                                        <i class="w-icon-category"></i><span>Filters</span>
                                    </a>
                                    <div class="toolbox-item toolbox-sort select-box text-dark">
                                        <label for="orderBy">Sort By :</label>
                                        <select name="orderBy" class="form-control" id="orderBy"
                                                onchange="this.form.submit()">
                                            <option value="default" @selected(request ('orderBy') == 'default')>
                                                Default sorting
                                            </option>
                                            <option value="latest" @selected(request ('orderBy') == 'latest')>
                                                Sort by latest
                                            </option>
                                            <option value="asc" @selected(request ('orderBy') == 'asc')>
                                                Sort by price: low to high
                                            </option>
                                            <option value="desc" @selected(request ('orderBy') == 'desc')>
                                                Sort by price: high to low
                                            </option>
                                        </select>
                                    </div>
                                </div>
                                <div class="toolbox-right">
                                    <div class="toolbox-item toolbox-show select-box">
                                        <select name="per-page" class="form-control" onchange="this.form.submit()">
                                            <option value="25" @selected(request ('per-page') == 25)>Show 25</option>
                                            <option value="50" @selected(request ('per-page') == 50)>Show 50</option>
                                            <option value="100" @selected(request ('per-page') == 100)>Show 100</option>
                                        </select>
                                    </div>
                                    <div class="toolbox-item toolbox-layout">
                                        <a href="{{ route ('products.index', ['view' => 'grid']) }}"
                                           class="icon-mode-grid btn-layout {{ request ('view') == 'grid' ? 'active' : '' }}">
                                            <i class="w-icon-grid"></i>
                                        </a>
                                        <a href="{{ route ('products.index', ['view' => 'list']) }}"
                                           class="icon-mode-list btn-layout {{ (request ('view') == 'list' || !request ('view')) ? 'active' : '' }}">
                                            <i class="w-icon-list"></i>
                                        </a>
                                    </div>
                                </div>
                            </nav>
                        </form>
                        <div class="product-wrapper row {{ (request ('view') == 'list' || !request ('view')) ? 'cols-md-1 cols-xs-2 cols-1' : 'cols-md-3 cols-sm-2 cols-2' }}">
                            @if(count ($products) > 0)
                            @if (count($products) > 0)
                                @foreach ($products as $product)
                                    @if ($product->available_quantity() == 0 || $product->available_quantity() > 0   )
                                        @if (request('view') == 'list' || !request('view'))
                                            <x-products-list :product="$product"></x-products-list>
                                        @else
                                            <x-products-card :product="$product"></x-products-card>
                                        @endif
                                    @endif
                                @endforeach
                        @endif
                            @endif
                        </div>
                        <div class="toolbox toolbox-pagination justify-content-between">
                            {!! $products -> onEachSide(5) -> appends(request() -> query()) -> links('shop.pagination') !!}
                        </div>
                    </div>
                    <!-- End of Shop Main Content -->
                </div>
                <!-- End of Shop Content -->
            </div>
        </div>
        <!-- End of Page Content -->
    </main>

    @include('partials._footer')
</x-home>
