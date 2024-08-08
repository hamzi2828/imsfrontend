 
<!-- Start of Mobile Menu -->
<div class="mobile-menu-wrapper">
    <div class="mobile-menu-overlay"></div>
    <!-- End of .mobile-menu-overlay -->

    <a href="#" class="mobile-menu-close"><i class="close-icon"></i></a>
    <!-- End of .mobile-menu-close -->

    <div class="mobile-menu-container scrollable">
        <form action="{{ route('products.index') }}" method="get" class="input-wrapper">
            <input type="text" class="form-control" name="search" autocomplete="off" placeholder="Search" required />
            <button class="btn btn-search" type="submit">
                <i class="w-icon-search"></i>
            </button>
        </form>
    
        <div class="tab">
            <ul class="nav nav-tabs" role="tablist">
                <li class="nav-item">
                    <a href="#main-menu" class="nav-link active" data-toggle="tab">Main Menu</a>
                </li>
                <li class="nav-item">
                    <a href="#categories" class="nav-link" data-toggle="tab">Categories</a>
                </li>
            </ul>
        </div>
    
        <div class="tab-content">
            <div class="tab-pane active" id="main-menu">
                <!-- Main Menu Content (if any) -->
                <ul class="mobile-menu">
                    <li><a href="{{ route('home') }}">Home</a></li>
                    <li><a href="{{ route('products.index') }}">Shop</a></li>
                    <li><a href="{{ route('pages.index', ['page' => 'about-us']) }}">About Us</a></li>
                    <li><a href="{{ route('contact-us') }}">Contact Us</a></li>
                </ul>
            </div>
            <div class="tab-pane" id="categories">
                <!-- Dynamic Categories Menu -->
                {!! $mobilemenu !!}
            </div>
        </div>
    </div>
    
</div>
<!-- End of Mobile Menu -->

<!-- Inline CSS for Mobile Menu -->
<style>
    /* Hide submenus by default */
    .toggle-btn {
        display: none;
    }
    .has-submenu>a:after {
    display: none;
    /* display: inline-block;
    position: absolute;
    right: 0;
    top: 50%;
    line-height: 0;
    vertical-align: middle;
    font-family: "Font Awesome 5 Free";
    font-size: 1rem;
    color: inherit;
    content: ""; */
}
    .mobile-menu ul {
        display: none;
        list-style-type: none;
        padding-left: 20px;
    }

    /* Show submenus when parent has the 'open' class */
    .mobile-menu .open > ul {
        display: block;
    }

    /* Arrow styles */
    .submenu-arrow {
    display: inline-block;
    width: 0;
    height: 0;
    border-left: 5px solid transparent;
    border-right: 5px solid transparent;
    border-top: 5px solid #fff; /* Changed arrow color to white */
    position: absolute; /* Position it absolutely within the parent */
    right: 10px; /* Align it to the right side */
    top: 50%; /* Vertically center it */
    transform: translateY(-50%); /* Vertically center it */
    transition: transform 0.3s ease;
}
    /* Rotate arrow when submenu is open */
    .has-submenu.open > a .submenu-arrow {
        transform: rotate(180deg);
    }

    /* Basic styling for menu items */
    .mobile-menu a {
        text-decoration: none;
        color: #ffffff;
        padding: 10px;
        display: block;
        position: relative;
    }

    .mobile-menu li {
        position: relative;
    }
</style>

<!-- Inline JavaScript for Toggling Submenus -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('.has-submenu > a').on('click', function(event) {
            event.preventDefault(); // Prevent the default anchor behavior
            var $submenu = $(this).siblings('ul'); // Find the submenu
            $submenu.slideToggle(); // Toggle the submenu visibility
            $(this).parent().toggleClass('open'); // Add or remove 'open' class to indicate state
        });
    });
</script> 
