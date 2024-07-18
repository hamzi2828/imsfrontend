<div class="product-wrap">
    <div class="product text-center">
        <figure class="product-media">
            <a href="{{ route ('products.show', ['product' => $product -> slug]) }}">
                <img src="{{ serverPath ($product -> image) }}" alt="{{ $product -> title() }}" width="300"
                     height="338" />
            </a>
            <div class="product-action-horizontal">
                <a href="javascript:void(0)"
                   onclick="initProductQuickView('{{ route ('products.quick-view', ['product' => $product -> slug]) }}')"
                   class="btn-product-icon w-icon-search"
                   title="Quick View"></a>
            </div>
        </figure>
        <div class="product-details">
            <div class="product-cat">
                <a href="{{ route ('products.show', ['product' => $product -> slug]) }}">
                    {{ $product -> category ?-> title }}
                </a>
            </div>
            <h3 class="product-name">
                <a href="{{ route ('products.show', ['product' => $product -> slug]) }}">
                    {{ $product -> title() }}
                </a>
            </h3>
            @include('product-ratings', ['product' => $product])
            <div class="product-pa-wrapper">
                <div class="product-price">
                    @include('product-price', ['product' => $product])
                </div>
            </div>
        </div>
    </div>
</div>
