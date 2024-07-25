<!-- Start of Sticky Footer -->
<div class="sticky-footer sticky-content fix-bottom">
    <a href="{{ route ('home') }}" class="sticky-link active">
        <i class="w-icon-home"></i>
        <p>Home</p>
    </a>
    <a href="{{ route ('products.index') }}" class="sticky-link">
        <i class="w-icon-category"></i>
        <p>Shop</p>
    </a>
    @if(auth () -> check ())
        <a href="{{ route ('users.index') }}" class="sticky-link">
            <i class="w-icon-account"></i>
            <p>Account</p>
        </a>
    @endif
    <div class="cart-dropdown dir-up">
        <a href="{{ route ('cart.index') }}" class="sticky-link">
            <i class="w-icon-cart"></i>
            <p>Cart</p>


        </a>
        <!-- End of Dropdown Box -->
    </div>

    <div class="cart-dropdown dir-up">
        <a href="tel:" class="sticky-link sticky-link-call ">
            <i class="w-icon-call"></i>
            <p>Call</p>
        </a>
    </div>
</div>
<!-- End of Sticky Footer -->

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        // Perform AJAX call to retrieve the phone number
        $.ajax({
            url: '/phone-number', // Your API endpoint
            method: 'GET',
            success: function(response) {
                // Update the href attribute with the phone number
                var phoneNumber = response.phone_number;
                $('.sticky-link-call').attr('href', 'tel:' + phoneNumber);
              
            },
            error: function(xhr, status, error) {
                console.error('Error fetching phone number:', error);
            }
        });
    });
</script>