@if($product -> variations() -> count() > 0)
    <div class="product-form pt-4 mb-2">
        <a href="{{ route ('products.show', ['product' => $product -> slug]) }}" class="btn btn-primary">
            Choose Options
        </a>
    </div>
@else
    @if($product -> available_quantity() > 0)
        <div class="product-form pt-4 mb-2">
            <div class="product-qty-form mb-0 mr-2">
                <div class="input-group">
                    <input class="quantity form-control" type="number"
                           min="1" max="{{ $product -> available_quantity() }}" id="cart-quantity">
                    <button class="quantity-plus w-icon-plus"></button>
                    <button
                            class="quantity-minus w-icon-minus"></button>
                </div>
            </div>
            <button class="btn btn-primary"
                    onclick="addToCart(this, '{{ route ('cart.store', ['product' => $product -> slug]) }}', {{ $product -> available_quantity() }})">
                <i class="w-icon-cart"></i>
                <span>Add to Cart</span>
            </button>
        </div>
    @else
        <div class="product-form pt-4 mb-2">
            <a href="javascript:void(0)" class="btn btn-danger">
                Out of Stock
            </a>
        </div>
    @endif
@endif