<div class="product product-list">
    <figure class="product-media">
        <a href="{{ route ('products.show', ['product' => $product -> slug]) }}">
            <img src="{{ serverPath ($product -> image) }}"
                 alt="{{ $product -> title() }}"
                 width="330"
                 height="338" />
            <img src="{{ serverPath ($product -> image) }}"
                 alt="{{ $product -> title() }}"
                 width="330"
                 height="338" />
        </a>
        <div class="product-action-vertical">
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
        <h4 class="product-name">
            <a href="{{ route ('products.show', ['product' => $product -> slug]) }}">
                {{ $product -> title() }}
            </a>
        </h4>
        @include('product-ratings', ['product' => $product])
        <div class="product-price">
            @include('product-price', ['product' => $product])
        </div>
        {!! $product -> excerpt !!}
        <div class="product-action">
            @include('add-to-cart-btns', ['product' => $product])
        </div>
    </div>
</div>
