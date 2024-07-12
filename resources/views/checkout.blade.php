<x-home :title="$title">
    @push('styles')
        <link rel="stylesheet" type="text/css" href="{{ asset('/assets/css/style.min.css') }}">
    @endpush
    @include('partials._topbar')
    
    <main class="main cart mt-5">
        <div class="page-content">
            <div class="container">
                <form class="form checkout-form" action="{{ route ('checkout.store') }}" method="post">
                    @csrf
                    <div class="row mb-9">
                        <div class="col-lg-7 pr-lg-4 mb-4">
                            @include('errors.validation-errors')
                            <h3 class="title billing-title text-uppercase ls-10 pt-1 pb-3 mb-0">
                                Billing Details
                            </h3>
                            <div class="row gutter-sm">
                                <div class="col-xs-12">
                                    <div class="form-group">
                                        <label for="full-name">Full name *</label>
                                        <input type="text" class="form-control form-control-md" name="full-name"
                                               required="required"
                                               value="{{ old ('full-name', auth () -> user () ?-> name) }}"
                                               id="full-name">
                                    </div>
                                </div>
                            </div>
                            
                            <div class="row gutter-sm">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="phone">Phone *</label>
                                        <input type="text" class="form-control form-control-md" name="phone" id="phone"
                                               required="required"
                                               value="{{ old ('phone', auth () -> user () ?-> mobile) }}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="email">Email address *</label>
                                        <input type="email" id="email"
                                               value="{{ old ('email', auth () -> user () ?-> email) }}"
                                               class="form-control form-control-md" name="email" required="required">
                                    </div>
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label for="address">Address *</label>
                                <input type="text" id="address"
                                       value="{{ old ('address', auth () -> user () ?-> address) }}"
                                       class="form-control form-control-md mb-2" name="address" required="required">
                            </div>
                            
                            <div class="form-group mt-3">
                                <label for="order-notes">Order notes (optional)</label>
                                <textarea class="form-control mb-0" id="order-notes" name="order-notes" cols="30"
                                          rows="4"
                                          placeholder="Notes about your order, e.g special notes for delivery">{{ old ('order-notes') }}</textarea>
                            </div>
                        </div>
                        <div class="col-lg-5 mb-4 sticky-sidebar-wrapper">
                            <div class="order-summary-wrapper sticky-sidebar">
                                <h3 class="title text-uppercase ls-10">Your Order</h3>
                                <div class="order-summary">
                                    <table class="order-table">
                                        <thead>
                                        <tr>
                                            <th colspan="2">
                                                <b>Product</b>
                                            </th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @if(count ($products) > 0)
                                            @foreach($products as $product)
                                                <tr class="bb-no">
                                                    <td class="product-name">
                                                        {{ $product -> name }}
                                                        <i class="fas fa-times"></i>
                                                        <span class="product-quantity">
                                                            {{ $product -> qty }}
                                                        </span>
                                                    </td>
                                                    <td class="product-total">
                                                        {{ number_format (($product -> options ?-> net * $product -> qty), 2) }}
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @endif
                                        <tr class="cart-subtotal bb-no">
                                            <td>
                                                <b>Subtotal</b>
                                            </td>
                                            <td>
                                                <b>{{ \Gloudemans\Shoppingcart\Facades\Cart::initial () }}</b>
                                            </td>
                                        </tr>
                                        </tbody>
                                        <tfoot>
                                        @if(Gloudemans\Shoppingcart\Facades\Cart::discount() > 0)
                                            <tr class="shipping-methods">
                                                <td colspan="2" class="text-left">
                                                    <h4 class="title title-simple bb-no mb-1 pb-0 pt-3">Coupon Code
                                                    </h4>
                                                    <ul id="shipping-method" class="mb-4">
                                                        <li>
                                                            <div class="custom-radio">
                                                                <input type="radio" id="coupon-code" disabled="disabled"
                                                                       checked="checked"
                                                                       class="custom-control-input" name="coupon-code">
                                                                <label for="coupon-code"
                                                                       class="custom-control-label color-dark">
                                                                    {{ Gloudemans\Shoppingcart\Facades\Cart::discount() }}
                                                                    ({{ session () -> get ('coupon-code') }})
                                                                </label>
                                                            </div>
                                                        </li>
                                                    </ul>
                                                </td>
                                            </tr>
                                        @endif
                                        
                                        <tr class="shipping-methods">
                                            <td colspan="2" class="text-left">
                                                <h4 class="title title-simple bb-no mb-1 pb-0 pt-3">Shipping
                                                </h4>
                                                <ul id="shipping-method" class="mb-4">
                                                    <li>
                                                        <div class="custom-radio">
                                                            <input type="radio" id="flat-rate" disabled="disabled"
                                                                   checked="checked"
                                                                   class="custom-control-input" name="shipping">
                                                            <label for="flat-rate"
                                                                   class="custom-control-label color-dark">
                                                                {{ optional ($site_settings -> settings) -> shipping_charges > 0 ? number_format (optional ($site_settings -> settings) -> shipping_charges, 2) : 'FREE' }}
                                                            </label>
                                                        </div>
                                                    </li>
                                                </ul>
                                            </td>
                                        </tr>
                                        <tr class="order-total">
                                            <th>
                                                <b>Total</b>
                                            </th>
                                            <td>
                                                <b>
                                                    @php
                                                        $subtotal = Gloudemans\Shoppingcart\Facades\Cart::subtotal();
                                                        $subtotal = str_replace(',', '', $subtotal); // Remove the commas
                                                        $subtotal = (float)$subtotal; // Convert to float
                                                    
                                                        $newSubtotal = $subtotal + optional (siteSettings () -> settings) -> shipping_charges; // Add 500
                                                  
                                                        $newSubtotalFormatted = number_format($newSubtotal, 2); // Format the result
                                                    @endphp
                                                    {{ $newSubtotalFormatted }}
                                                </b>
                                            </td>
                                        </tr>
                                        </tfoot>
                                    </table>
                                    
                                    <div class="payment-methods" style="border-bottom: 0;" id="payment_method">
                                        <h4 class="title font-weight-bold ls-25 pb-0 mb-1">Payment Methods</h4>
                                        <div class="accordion payment-accordion">
                                            <div class="card">
                                                <div class="card-header">
                                                    <a href="#delivery" class="collapse">Cash on delivery</a>
                                                </div>
                                                <div id="delivery" class="card-body expanded">
                                                    <p class="mb-0">
                                                        Pay with cash upon delivery.
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group place-order pt-6">
                                        <button type="submit" class="btn btn-dark btn-block btn-rounded">Place Order
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </main>
    
    @include('partials._footer')
</x-home>