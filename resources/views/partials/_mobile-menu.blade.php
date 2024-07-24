 
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
        <!-- End of Search Form -->

        {!! $mobilemenu !!}
    </div>
</div>
<!-- End of Mobile Menu -->

<!-- Inline CSS for Mobile Menu -->
<style>
    /* Hide submenus by default */
    .toggle-btn {
        display: none;
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
        border-top: 5px solid #000; /* Arrow color */
        margin-left: 5px;
        vertical-align: middle;
        transition: transform 0.3s ease;
    }

    /* Rotate arrow when submenu is open */
    .has-submenu.open > a .submenu-arrow {
        transform: rotate(180deg);
    }

    /* Basic styling for menu items */
    .mobile-menu a {
        text-decoration: none;
        color: #333;
        padding: 10px;
        display: block;
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
