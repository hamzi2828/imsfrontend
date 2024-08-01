<x-home :title="$title">
    @push('styles')
        <link rel="stylesheet" type="text/css" href="{{ asset('/assets/css/style.min.css') }}">
    @endpush
    @include('partials._topbar')
    
    @php
    $currency = optional(siteSettings()->settings)->currency;
    @endphp

    <main class="main cart mt-5">
        <div class="page-content">
            <div class="container">
                <div class="order-success text-center font-weight-bolder text-dark">
                    <i class="fas fa-check"></i>
                    Thank you. Your order has been received. 
                </div>
                <!-- End of Order Success -->
                
                <ul class="order-view list-style-none">
                    <li>
                        <label>Order number</label>
                        <strong>{{ $sale -> sale_id }}</strong>
                    </li> 
                    <li>
                        <label>Status</label>
                        <strong>
                            @if(!empty(trim ($sale -> tracking_no)))
                                Dispatched:
                                <a href="{{ $sale -> courier ?-> tracking_link . '/' . $sale -> tracking_no }}" target="_blank">
                                    {{ $sale -> tracking_no }}
                                </a>
                            @else
                                {{ $sale -> sale_closed == '1' ? 'Confirmed' : 'Pending' }}
                            @endif
                        </strong>
                    </li>
                    <li>
                        <label>Date</label>
                        <strong>{{ $sale -> createdAt() }}</strong>
                    </li>
                    <li>
                        <label>Total</label>
                        <strong>{{  $currency }} {{ number_format ($sale -> net, 2) }}</strong>
                    </li>
                    <li>
                        <label>Payment method</label>
                        <strong>Cash on Delivery</strong>
                    </li>
                </ul>
                <!-- End of Order View -->
                <hr />
                
                <div class="order-details-wrapper mb-5" style="width: 860px; margin: 50px auto 0 auto;">
                    <h4 class="title text-uppercase ls-25 mb-5">Order Details</h4>
                    <table border="1" cellpadding="8px">
                        <thead>
                        <tr>
                            <th class="text-dark" align="center" width="20%"></th>
                            <th class="text-dark" align="left">Product</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        @if(count ($sale -> products) > 0)
                            @foreach($sale -> products as $product)
                                <tr>
                                    <td align="center">
                                        <img src="{{ serverPath ($product -> product -> image) }}"
                                             alt="{{ $product -> product -> title() }}" style="width: 80px;" />
                                    </td>
                                    <td align="left">
                                        <a href="{{ route ('products.show', ['product' => $product -> product -> slug]) }}">
                                            {{ $product -> product -> title() }}
                                        </a>
                                        <strong>x {{ $product -> quantity }}</strong><br>
                                    </td>
                                    <td align="right">{{ $currency }} {{ number_format ($product -> net_price, 2) }}</td>
                                </tr>
                            @endforeach
                        @endif
                        </tbody>
                        <tfoot>
                        <tr>
                            <th></th>
                            <th align="left">Subtotal:</th>
                            <td align="right">{{ $currency }} {{ number_format ($sale -> total, 2) }}</td>
                        </tr>
                        @if($sale -> coupon_id > 0)
                            <tr>
                                <th></th>
                                <th align="left">Coupon Code:</th>
                                <td align="right">
                                    {{ $sale -> coupon ?-> code }}
                                    ({{ number_format ($sale -> percentage_discount, 2) }}%)
                                </td>
                            </tr>
                        @endif
                        <tr>
                            <th></th>
                            <th align="left">Shipping:</th>
                            <td align="right">{{ $currency }} {{ number_format ($sale -> shipping, 2) }}</td>
                        </tr>
                        <tr>
                            <th></th>
                            <th align="left">Payment method:</th>
                            <td align="right">Cash on Delivery</td>
                        </tr>
                        <tr class="total">
                            <th></th>
                            <th class="border-no" align="left">Total:</th>
                            <td class="border-no" align="right">{{ $currency }}{{ number_format ($sale -> net, 2) }}</td>
                        </tr>
                        </tfoot>
                    </table>
                </div>
                <!-- End of Order Details -->
            </div>
        </div>
    </main>
    
    @include('partials._footer')
</x-home>