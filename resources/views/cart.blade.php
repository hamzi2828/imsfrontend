<x-home :title="$title">
    @push('styles')
        <link rel="stylesheet" type="text/css" href="{{ asset('/assets/css/style.min.css') }}">
        <style>
            .shop-table.cart-table .btn-close {
                position        : absolute;
                display         : flex;
                justify-content : center;
                align-items     : center;
            }
        </style>
    @endpush
    @include('partials._topbar')
    
    <main class="main cart mt-5">
        <!-- Start of PageContent -->
        <div class="page-content">
            <div class="container">
                <div class="row gutter-lg mb-10">
                    <div class="col-lg-8 pr-lg-4 mb-6">
                        @include('errors.validation-errors')
                        <form method="post" action="{{ route ('cart.update', ['cart' => 'fake']) }}">
                            @method('PUT')
                            @csrf
                            <table class="shop-table cart-table">
                                <thead>
                                <tr>
                                    <th class="product-name"><span>Product</span></th>
                                    <th></th>
                                    <th class="product-price"><span>Price</span></th>
                                    <th class="product-quantity"><span>Quantity</span></th>
                                    <th class="product-subtotal"><span>Subtotal</span></th>
                                </tr>
                                </thead>
                                <tbody>
                                @if(count ($products) > 0)
                                    @foreach($products as $product)
                                        <tr>
                                            <td class="product-thumbnail">
                                                <div class="p-relative">
                                                    <a href="{{ $product -> options ?-> route }}">
                                                        <figure>
                                                            <img src="{{ $product -> options ?-> image  }}"
                                                                 alt="product" height="100" style="height: 100px">
                                                        </figure>
                                                    </a>
                                                    <a href="{{ route ('cart.remove', ['cart' => $product -> rowId]) }}"
                                                       onclick="return confirm('Are you sure?')" class="btn btn-close">
                                                        <i class="fas fa-times"></i>
                                                    </a>
                                                </div>
                                            </td>
                                            <td class="product-name">
                                                <a href="{{ $product -> options ?-> route }}">
                                                    {{ $product -> name }}
                                                    <a href="{{ route ('cart.remove', ['cart' => $product -> rowId]) }}"
                                                       onclick="return confirm('Are you sure?')">
                                                        <i class="fas fa-trash"></i>
                                                    </a>
                                                </a>
                                            </td>
                                            <td class="product-price" align="center">
                                            <span class="amount">
                                                {{ number_format ($product -> options ?-> actualPrice, 2) }}
                                                @if($product -> options ?-> discount > 0)
                                                    ({{ $product -> options ?-> discount }}% OFF)
                                                @endif
                                            </span>
                                            </td>
                                            <td>
                                                <input class="form-control" type="number" min="1"
                                                       max="100000" name="quantity[{{ $product -> rowId }}]"
                                                       value="{{ $product -> qty }}">
                                            </td>
                                            <td class="product-subtotal" align="center">
                                                <span class="amount">
                                                    {{ number_format (($product -> options ?-> net * $product -> qty), 2) }}
                                                </span>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                                </tbody>
                            </table>
                            
                            <div class="cart-action mb-6">
                                <a href="{{ route ('home') }}"
                                   class="btn btn-dark btn-rounded btn-icon-left btn-shopping mr-auto">
                                    <i class="w-icon-long-arrow-left"></i>Continue Shopping
                                </a>
                                <button type="submit" class="btn btn-rounded btn-default btn-clear" name="clear-cart"
                                        value="Clear Cart">Clear Cart
                                </button>
                                <button type="submit" class="btn btn-rounded btn-update" name="update-cart"
                                        value="Update Cart">Update Cart
                                </button>
                            </div>
                        </form>
                        
                        {{-- <form class="coupon" method="post" action="{{ route ('cart.apply-discount') }}">
                            @csrf
                            <h5 class="title coupon-title font-weight-bold text-uppercase">Coupon Discount</h5>
                            <input type="text" class="form-control mb-4" placeholder="Enter coupon code here..."
                                   required="required" name="coupon-code"
                                   value="{{ old ('coupon-code', session () -> get ('coupon-code')) }}" />
                            <button class="btn btn-dark btn-outline btn-rounded" type="submit">Apply Coupon</button>
                        </form> --}}
                    </div>

                    <div class="col-lg-4 ">
                        <style>
                            .coupon-container {
                                border: 2px dotted #ddd; /* Adjust color and width as needed */
                                padding: 15px; /* Optional: Add padding inside the border */
                                border-radius: 5px; /* Optional: Add rounded corners */
                            }
                        
                            .coupon-container .form-control {
                                border: 1px solid #ddd; /* Optional: Style the input border */
                            }
                        
                            .coupon-container .btn-checkout {
                                margin-top: 10px; /* Adjust margin as needed */
                            }
                        </style>
                        <div class="coupon-container mb-6">
                            <h3 class="cart-title text-uppercase">Coupon Discount</h3>
                            <div class="cart-subtotal d-flex align-items-center w-100 justify-content-between">
                                <form class="coupon w-100" method="post" action="{{ route('cart.apply-discount') }}">
                                    @csrf
                                    <input type="text" class="form-control mb-4" placeholder="Enter coupon code here..."
                                        required="required" name="coupon-code"
                                        value="{{ old('coupon-code', session()->get('coupon-code')) }}" />
                                    <button class="btn btn-block btn-dark btn-icon-right btn-rounded btn-checkout" type="submit">Apply Coupon</button>
                                </form>
                            </div>
                        </div>
                        
                  
                        

                        <div class="sticky-sidebar-wrapper">
                            @include('cart-totals')

                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
        <!-- End of PageContent -->
    </main>
    
    @include('partials._footer')
</x-home>