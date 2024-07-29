{{-- partials._cartslider --}}
<style>

@media (max-width: 767px) {
    sticky-footer .cart-dropdown .dropdown-b{
        display: none;
    }
}
    .dropdown-box {
    /* Adjust height as needed */
    overflow-y: auto; /* Enable scrolling */
    display: flex;
    flex-direction: column;
}

    .products {
        flex: 1; /* Take up available space */
        /* overflow-y: auto; Allow scrolling */
        max-height: 100%  !important;
    }

    .cart-action {
        position: sticky;
        bottom: 0;
        background: #fff; /* Adjust background to match design */
        padding: 10px; /* Adjust padding as needed */
        border-top: 1px solid #ddd; /* Optional: Add a border to separate from products */
    }

    .product {
        border-bottom: 1px solid #ddd; /* Optional: Add a border to separate products */
        padding: 10px;
    }

    .cart-dropdown .cart-action {
    display: flex;
    margin-bottom: 50px;
}

</style>

@php
    $currency = optional(siteSettings()->settings)->currency;
@endphp
<div class="dropdown-box">
    <div class="cart-header">
        <span>Shopping Cart</span>
        <a href="#" class="btn-close">Close<i class="w-icon-long-arrow-right"></i></a>
    </div>

    <div class="products" id="cart-details">
        <!-- Products will be inserted here dynamically -->
    </div>

    <div class="cart-total">
        <label>Subtotal :</label>
        <span class="price" id="cart-subtotal">0.00 {{ $currency }}</span>
    </div>

    <div class="cart-action">
        <a href="{{ route('cart.index') }}" class="btn btn-dark btn-outline btn-rounded">View Cart</a>
        <a href="{{ route('checkout.index') }}" class="btn btn-primary btn-rounded">Checkout</a>
    </div>
</div>


<!-- End of Header Middle -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    var currency = "{{ $currency }}";
   $(document).ready(function() {
    $('.cart-toggle').on('click', function(e) {
        e.preventDefault(); // Prevent default action

        $.ajax({
            url: '/cart-slider', // Your API endpoint
            method: 'GET',
            success: function(response) {
                if (response.status === 'success') {
                    var products = response.products;
                    var itemCount = Object.keys(products).length;
                    var details = '';
                    var subtotal = 0;

                    if (itemCount > 0) {
                        for (var key in products) {
                            if (products.hasOwnProperty(key)) {
                                var item = products[key];
                                details += '<div class="product product-cart">' +
                                    '<div class="product-detail">' +
                                    '<a href="' + item.options.path + '" class="product-name">' + item.name + '</a>' +
                                    '<div class="price-box">' +
                                    '<span class="product-quantity">' + item.qty + '</span>' +
                                    '<span class="product-price">'   + item.price + ' '+ currency + '</span>' +
                                    '</div>' +
                                    '</div>' +
                                    '<figure class="product-media">' +
                                    '<a href="' + item.options.path + '">' +
                                    '<img src="' + item.options.image + '" alt="product" width="84" height="94" />' +
                                    '</a>' +
                                    '</figure>' +
                                    // '<button class="btn btn-link btn-close" aria-label="button">' +
                                    // '<i class="fas fa-times"></i>' +
                                    // '</button>' +
                                    '</div>';

                                // Calculate subtotal
                                subtotal += parseFloat(item.subtotal);
                            }
                        }
                    } else {
                        details = '<p>No items in the cart.</p>';
                        subtotal = 0;
                    }

                    // Update UI
                    $('#cart-details').html(details);
                    $('#cart-subtotal').text( subtotal.toFixed(2) + ' ' + currency);
                }
            },
            error: function(xhr, status, error) {
                console.error('AJAX Error:', status, error);
            }
        });
    });
});



</script>