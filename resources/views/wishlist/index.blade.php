<x-home :title="$title">
    @push('styles')
        <link rel="stylesheet" type="text/css" href="{{ asset('/assets/css/style.min.css') }}">
    @endpush
    @include('partials._topbar')
    
    <main class="main wishlist-page">
        <!-- Start of Page Header -->
        <div class="page-header">
            <div class="container">
                <h1 class="page-title mb-0">Wishlist</h1>
            </div>
        </div>
        <!-- End of Page Header -->
        
        <!-- Start of PageContent -->
        <div class="page-content mt-4">
            <div class="container">
                <table class="shop-table wishlist-table">
                    <thead>
                    <tr>
                        <th class="product-name" align="left"><span>Product</span></th>
                        <th></th>
                        <th class="product-price" align="left"><span>Price</span></th>
                        <th class="product-stock-status" align="left"><span>Stock Status</span></th>
                        <th class="wishlist-action" align="left">Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if(count ($products) > 0)
                        @foreach($products as $product)
                            <tr>
                                <td class="product-thumbnail">
                                    <div class="p-relative">
                                        <a href="{{ route ('products.show', ['product' => $product -> slug]) }}">
                                            <figure>
                                                <img src="{{ serverPath($product -> image) }}" alt="product" width="300"
                                                     height="338">
                                            </figure>
                                        </a>
                                    </div>
                                </td>
                                <td class="product-name">
                                    <a href="{{ route ('products.show', ['product' => $product -> slug]) }}">
                                        {{ $product -> title() }}
                                    </a>
                                </td>
                                <td class="product-price">
                                    @include('product-price', ['product' => $product])
                                </td>
                                <td class="product-stock-status">
                                    <span class="wishlist-in-stock">In Stock</span>
                                </td>
                                <td class="wishlist-action">
                                    <div class="d-lg-flex">
                                        <a href="javascript:void(0)"
                                           onclick="initProductQuickView('{{ route ('products.quick-view', ['product' => $product -> slug]) }}')"
                                           class="btn btn-quickview btn-outline btn-default btn-rounded btn-sm mb-2 mb-lg-0">
                                            Quick View
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    @endif
                    </tbody>
                </table>
            </div>
        </div>
        <!-- End of PageContent -->
    </main>
    
    @include('partials._footer')
</x-home>