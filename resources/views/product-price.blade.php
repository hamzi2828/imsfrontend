@php
    $currency = optional(siteSettings()->settings)->currency;
@endphp

@if($product->has_variations == '1')
    @php
        $minPrice = null;
        $maxPrice = null;
        foreach ($product->variations as $variation) {
            $price = $variation->productStocks()->avg('sale_box');
            if ($price !== null) {
                if ($minPrice === null || $price < $minPrice) {
                    $minPrice = $price;
                }
                if ($maxPrice === null || $price > $maxPrice) {
                    $maxPrice = $price;
                }
            }
        }
    @endphp
    <ins class="new-price ls-50">
        {{ $currency }}  {{ number_format($minPrice, 2) }} - {{ number_format($maxPrice, 2) }} 
    </ins>
@else
    @if($product->discount > 0)
        <ins class="new-price ls-50">
            {{ $currency }}    {{ number_format($product->discountPrice(), 2) }} 
        </ins>
        <del class="old-price">
            {{ $currency }}    {{ number_format($product->productPrice(), 2) }} 
        </del>
    @else
        <ins class="new-price ls-50">
            {{ $currency }}    {{ number_format($product->productPrice(), 2) }} 
        </ins>
    @endif
@endif
