<div class="tab-pane pt-4" id="most-popular">
    <div class="row cols-xl-5 cols-md-4 cols-sm-3 cols-2">
        @if(count ($populars) > 0)
            @foreach($populars as $product)
                <div class="product-wrap">
                    <div class="product text-center">
                        <figure class="product-media">
                            <a href="{{ route ('products.show', ['product' => $product -> slug]) }}">
                                <img src="{{ serverPath ($product -> image) }}"
                                     alt="Product" style="height: 250px"
                                     width="300" height="338" />
                                <img src="{{ serverPath ($product -> image) }}"
                                     alt="Product" style="height: 250px"
                                     width="300" height="338" />
                            </a>
                            <div class="product-action-vertical">
                                @include('product-actions', ['product' => $product])
                            </div>
                        </figure>
                        <div class="product-details">
                            <h4 class="product-name">
                                <a href="{{ route ('products.show', ['product' => $product -> slug]) }}">
                                    {{ $product -> title() }}
                                </a>
                            </h4>
                            @include('product-ratings', ['product' => $product])
                            <div class="product-price">
                                @include('product-price', ['product' => $product])
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        @endif
    </div>
</div>