@if($product -> has_variations == '1')
    <a href="javascript:void(0)" class="btn-product-icon w-icon-search"
       onclick="initProductQuickView('{{ route ('products.quick-view', ['product' => $product -> slug]) }}')"
       title="Quick View"></a>
@else
    <a href="javascript:void(0)" class="btn-product-icon w-icon-cart"
       onclick="addToCart(this, '{{ route ('cart.store', ['product' => $product -> slug]) }}', {{ $product -> available_quantity() }})"
       title="Add to cart"></a>
    
    <a href="javascript:void(0)" id="wishlist-{{ $product -> id }}"
       onclick="addToWishList('{{ route ('products.add-to-wishlist', ['product' => $product -> slug]) }}')"
       class="btn-product-icon btn-wishlist {{ isWishList($product -> id) ? 'w-icon-heart-full' : 'w-icon-heart' }}"
       title="Add to wishlist"></a>
    
    <a href="javascript:void(0)" class="btn-product-icon w-icon-search"
       onclick="initProductQuickView('{{ route ('products.quick-view', ['product' => $product -> slug]) }}')"
       title="Quick View"></a>
@endif