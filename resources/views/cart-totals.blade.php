

@php
    $currency = optional(siteSettings()->settings)->currency;
@endphp

<div class="sticky-sidebar">
    <div class="cart-summary mb-4">

        <h3 class="cart-title text-uppercase">Cart Totals</h3>
        <div class="cart-subtotal d-flex align-items-center justify-content-between">
            <label class="ls-25">Subtotal</label>
            <span> {{ $currency }} {{ \Gloudemans\Shoppingcart\Facades\Cart::initial () }}</span>
        </div>
        
        @if(Gloudemans\Shoppingcart\Facades\Cart::discount() > 0)
            <hr class="divider mb-6">
            <ul class="shipping-methods mb-2">
                <li>
                    <label class="shipping-title text-dark font-weight-bold">Coupon Code</label>
                </li>
                <li>
                    <div class="custom-radio">
                        <input type="radio" checked="checked" id="flat-rate"
                               class="custom-control-input" disabled="disabled">
                        <label for="flat-rate" class="custom-control-label color-dark">
                            {{ $currency }}  {{ Gloudemans\Shoppingcart\Facades\Cart::discount() }}
                            ({{ session () -> get ('coupon-code') }})
                        </label>
                    </div>
                </li>
            </ul>
        @endif
        
        <hr class="divider mb-6">
        <ul class="shipping-methods mb-2">
            <li>
                <label class="shipping-title text-dark font-weight-bold">Shipping</label>
            </li>
            <li>
                <div class="custom-radio">
                    <input type="radio" checked="checked" id="flat-rate"
                           class="custom-control-input" disabled="disabled">
                    <label for="flat-rate" class="custom-control-label color-dark">
                        {{ optional ($site_settings -> settings) -> shipping_charges > 0 ? $currency .' '. number_format (optional ($site_settings -> settings) -> shipping_charges, 2) : 'FREE' }}
                    </label>
                </div>
            </li>
        </ul>
        
        <hr class="divider mb-6">
        
        <div class="order-total d-flex justify-content-between align-items-center">
            <label>Total</label>
            <span class="ls-50">
                @php
                    $subtotal = Gloudemans\Shoppingcart\Facades\Cart::subtotal();
                    $subtotal = str_replace(',', '', $subtotal); // Remove the commas
                    $subtotal = (float)$subtotal; // Convert to float
                
                    $newSubtotal = $subtotal + optional (siteSettings () -> settings) -> shipping_charges; // Add 500
              
                    $newSubtotalFormatted = number_format($newSubtotal, 2); // Format the result
                @endphp
              {{ $currency }} {{ $newSubtotalFormatted }}
            </span>
        </div>
        <a href="{{ route ('checkout.index') }}"
           class="btn btn-block btn-dark btn-icon-right btn-rounded  btn-checkout">
            Proceed to checkout<i class="w-icon-long-arrow-right"></i></a>
    </div>
</div>