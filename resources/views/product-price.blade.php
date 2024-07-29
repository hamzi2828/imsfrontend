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
        {{ number_format($minPrice, 2) }} - {{ number_format($maxPrice, 2) }} {{ $currency }}
    </ins>
@else
    @if($product->discount > 0)
        <ins class="new-price ls-50">
            {{ number_format($product->discountPrice(), 2) }} {{ $currency }}
        </ins>
        <del class="old-price">
            {{ number_format($product->productPrice(), 2) }} {{ $currency }}
        </del>
    @else
        <ins class="new-price ls-50">
            {{ number_format($product->productPrice(), 2) }} {{ $currency }}
        </ins>
    @endif
@endif
