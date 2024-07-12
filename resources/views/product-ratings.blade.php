<div class="ratings-container">
    <div class="ratings-full">
        <span class="ratings" style="width: {{ avgRating($product) }};"></span>
        <span class="tooltiptext tooltip-top"></span>
    </div>
    <a href="{{ route ('products.show', ['product' => $product -> slug]) }}" class="rating-reviews">
        ({{ $product -> reviews -> count() }})
    </a>
</div>