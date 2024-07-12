<div class="tab-pane active in" id="account-dashboard">
    <p class="greeting">
        Hello
        <span class="text-dark font-weight-bold">{{ auth () -> user () -> name }}</span>
        (not
        <span class="text-dark font-weight-bold">{{ auth () -> user () -> name }}</span>?
        <a href="#" class="text-primary">Log out</a>)
    </p>
    
    <p class="mb-4">
        From your account dashboard you can view your
        <a href="{{ route ('users.index') }}#account-orders" class="text-primary link-to-tab">recent orders</a>,
        and
        <a href="{{ route ('users.index') }}#account-details" class="text-primary link-to-tab">edit your password and account details.</a>
    </p>
    
    <div class="row">
        <div class="col-lg-4 col-md-6 col-sm-4 col-xs-6 mb-4">
            <a href="{{ route ('users.index') }}#account-orders" class="link-to-tab">
                <div class="icon-box text-center">
                    <span class="icon-box-icon icon-orders">
                        <i class="w-icon-orders"></i>
                    </span>
                    <div class="icon-box-content">
                        <p class="text-uppercase mb-0">Orders</p>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-lg-4 col-md-6 col-sm-4 col-xs-6 mb-4">
            <a href="{{ route ('users.index') }}#account-details" class="link-to-tab">
                <div class="icon-box text-center">
                    <span class="icon-box-icon icon-account">
                        <i class="w-icon-user"></i>
                    </span>
                    <div class="icon-box-content">
                        <p class="text-uppercase mb-0">Account Details</p>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-lg-4 col-md-6 col-sm-4 col-xs-6 mb-4">
            <a href="wishlist.html" class="link-to-tab">
                <div class="icon-box text-center">
                    <span class="icon-box-icon icon-wishlist">
                        <i class="w-icon-heart"></i>
                    </span>
                    <div class="icon-box-content">
                        <p class="text-uppercase mb-0">Wishlist</p>
                    </div>
                </div>
            </a>
        </div>
    </div>
</div>