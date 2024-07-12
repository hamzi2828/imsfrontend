<div class="tab-pane mb-4 active in" id="account-orders">
    <div class="icon-box icon-box-side icon-box-light">
        <span class="icon-box-icon icon-orders">
            <i class="w-icon-orders"></i>
        </span>
        <div class="icon-box-content">
            <h4 class="icon-box-title text-capitalize ls-normal mb-0">Orders</h4>
        </div>
    </div>
    
    <table class="account-orders-table mb-6" border="1" cellpadding="10px">
        <thead>
        <tr>
            <th class="order-id" align="left">Order</th>
            <th class="order-date" align="left">Date</th>
            <th class="order-status" align="left">Status</th>
            <th class="order-total" align="left">Total</th>
            <th class="order-actions" align="left">Actions</th>
        </tr>
        </thead>
        <tbody>
        @if(count ($orders) > 0)
            @foreach($orders as $order)
                <tr>
                    <td class="order-id">#{{ $order -> sale_id }}</td>
                    <td class="order-date">{{ $order -> createdAt() }}</td>
                    <td class="order-status">
                        @if(!empty(trim ($order -> tracking_no)))
                            Dispatched:
                            <a href="{{ $order -> courier ?-> tracking_link . '/' . $order -> tracking_no }}" target="_blank">
                                {{ $order -> tracking_no }}
                            </a>
                        @else
                            {{ $order -> sale_closed == '1' ? 'Confirmed' : 'Pending' }}
                        @endif
                    </td>
                    <td class="order-total">
                        <span class="order-price">
                            <strong>{{ number_format ($order -> net, 2) }}</strong>
                        </span> for
                        <span class="order-quantity">
                            <strong>{{ $order -> products -> sum('quantity') }}</strong>
                        </span> item(s)
                    </td>
                    <td class="order-action">
                        <a href="{{ route ('sales.index', ['sale' => $order -> sale_id]) }}" target="_blank"
                           class="btn btn-outline btn-default btn-block btn-sm btn-rounded">View</a>
                    </td>
                </tr>
            @endforeach
        @endif
        </tbody>
    </table>
</div>