@if($product -> variations() -> count() > 0)
    <a href="{{ route ('products.show', ['product' => $product -> slug]) }}" class="btn-product"
       title="Choose Options">
        Choose Options
    </a>
@else
    @if($product -> available_quantity() > 0)
        <a href="javascript:void(0)"
           onclick="addToCart(this, '{{ route ('cart.store', ['product' => $product -> slug]) }}', {{ $product -> available_quantity() }})"
           class="btn-product" title="Add to Cart">
            <i class="w-icon-cart"></i> Add To Cart</a>

        <a href="javascript:void(0)" id="wishlist-{{ $product -> id }}"
           onclick="addToWishList('{{ route ('products.add-to-wishlist', ['product' => $product -> slug]) }}')"
           class="btn-product-icon btn-wishlist {{ isWishList($product -> id) ? 'w-icon-heart-full' : 'w-icon-heart' }}"
           title="Add to wishlist"></a>

    @else
        <a href="javascript:void(0)" class="btn-product">
            Out of Stock
        </a>
    @endif
@endif
