

<div class="header-middle">
    <div class="container">
        <div class="header-left mr-md-4">
            <a href="#" class="mobile-menu-toggle  w-icon-hamburger" aria-label="menu-toggle">
            </a>
            <a href="{{ route ('home') }}" class="logo ml-lg-0">
                <img src="{{ serverPath (optional ($settings -> settings) -> logo) }}" alt="logo" width="144"
                     height="45" />
            </a>
            @include('partials.search-form')
        </div>
        <div class="header-right ml-4">
            <div class="header-call d-xs-show d-lg-flex align-items-center">
                <a href="tel:{{ optional ($settings -> settings) -> phone }}" class="w-icon-call"></a>
                <div class="call-info d-lg-show">
                    <h4 class="chat font-weight-normal font-size-md text-normal ls-normal text-light mb-0">
                        <a href="mailto:#" class="text-capitalize">Call us at</a></h4>
                    <a href="tel:{{ optional ($settings -> settings) -> phone }}"
                       class="phone-number font-weight-bolder ls-50">
                        {{ optional ($settings -> settings) -> phone }}
                    </a>
                </div>
            </div>
            <a class="wishlist label-down link d-xs-show" href="{{ route ('wishlist.index') }}">
                <i class="w-icon-heart"></i>
                <span class="wishlist-label d-lg-show">Wishlist</span>
            </a>
            <div class="dropdown cart-dropdown cart-offcanvas mr-0 mr-lg-2">
                <div class="cart-overlay"></div>
    
                        <a href="#" class="cart-toggle label-down link">
                            <i class="w-icon-cart">
                                <span class="cart-count" style="top: 0">
                                    {{ \Gloudemans\Shoppingcart\Facades\Cart::content () -> count () }}
                                </span>
                            </i>
                            <span class="cart-label">Cart</span>
                        </a>
                            @include('partials._cartslider')
      

                <!-- End of Dropdown Box -->
            </div>
        </div>
    </div>
</div>

