<div class="tab tab-nav-boxed tab-nav-outline appear-animate">
    <ul class="nav nav-tabs justify-content-center" role="tablist">
        <li class="nav-item mr-2 mb-2">
            <a class="nav-link active br-sm font-size-md ls-normal"
               href="#new-arrivals">
                New Arrivals
            </a>
        </li>
        <li class="nav-item mr-2 mb-2">
            <a class="nav-link br-sm font-size-md ls-normal"
               href="#best-seller">
                Best Seller
            </a>
        </li>
        <li class="nav-item mr-2 mb-2">
            <a class="nav-link br-sm font-size-md ls-normal"
               href="#most-popular">
                Most Popular
            </a>
        </li>
        <li class="nav-item mr-2 mb-2">
            <a class="nav-link br-sm font-size-md ls-normal"
               href="#featured">
                Featured
            </a>
        </li>
    </ul>
</div>
<!-- End of Tab -->
<div class="tab-content product-wrapper appear-animate">
    @include('new-arrivals')
    @include('best-seller')
    @include('most-popular')
    @include('featured')
</div>
<!-- End of Tab Content -->