@push('styles')
    <style>
        .megamenu {
            display   : flex !important;
            flex-wrap : wrap !important;
        }
        
        .megamenu > li {
            flex : 50% !important;
        }
        .w-icon-angle-right:before{
            font-size: 11px;
        }
        
    </style>
@endpush
<div class="header-bottom sticky-content fix-top sticky-header has-dropdown" style="border-bottom: 1px solid #eee">
    <div class="container">
        <div class="inner-wrap">
            <div class="header-left">
                <div class="dropdown category-dropdown has-border" data-visible="true">
                    <a href="#" class="category-toggle text-dark" role="button" data-toggle="dropdown"
                       aria-haspopup="true" aria-expanded="true" data-display="static"
                       title="Browse Categories">
                        <i class="w-icon-category"></i>
                        <span>Browse Categories</span>
                    </a>
                    
                    <div class="dropdown-box">
                        <ul class="menu vertical-menu category-menu">
                            {!! $menu !!}
                            <li>
                                <a href="{{ route ('products.index') }}"
                                   class="font-weight-bold text-primary text-uppercase ls-25" style="padding-left: 0;">
                                    View All Categories<i class="w-icon-angle-right"></i>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <nav class="main-nav">
                    <ul class="menu active-underline">
                        <li class="{{ request () -> routeIs ('home') ? 'active' : '' }}">
                            <a href="{{ route ('home') }}">Home</a>
                        </li>
                        <li class="{{ request () -> routeIs ('products.index') ? 'active' : '' }}">
                            <a href="{{ route ('products.index') }}">Shop</a>
                        </li>
                        <li>
                            <a href="{{ route ('pages.index', ['page' => 'about-us']) }}">About Us</a>
                        </li>
                        <li>
                            <a href="{{ route ('contact-us') }}">Contact Us</a>
                        </li>
                    </ul>
                </nav>
            </div>
             <div class="header-right">
                 <a href="#" class="d-xl-show mr-0">
                     <i class="w-icon-map-marker"></i>Track Order
                 </a>
             </div>
        </div>
    </div>
</div>