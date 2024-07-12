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
</div>
<!-- End of Sticky Footer -->