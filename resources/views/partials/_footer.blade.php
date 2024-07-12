<!-- Start of Footer -->
<footer class="footer appear-animate" data-animation-options="{
            'name': 'fadeIn'
        }">
    <div class="footer-newsletter bg-primary">
        <div class="container">
            <div class="row justify-content-center align-items-center">
                <div class="col-xl-5 col-lg-6">
                    <div class="icon-box icon-box-side text-white">
                        <div class="icon-box-icon d-inline-flex">
                            <i class="w-icon-envelop3"></i>
                        </div>
                        <div class="icon-box-content">
                            <h4 class="icon-box-title text-white text-uppercase font-weight-bold">
                                Subscribe To Our Newsletter
                            </h4>
                            <p class="text-white">
                                Get all the latest information on Events, Sales and Offers.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-xl-7 col-lg-6 col-md-9 mt-4 mt-lg-0 ">
                    <form action="{{ route ('newsletter') }}" method="post"
                          class="input-wrapper input-wrapper-inline input-wrapper-rounded">
                        @csrf
                        <input type="email" class="form-control mr-2 bg-white" name="email" id="email"
                               placeholder="Your E-mail Address" />
                        <button class="btn btn-dark btn-rounded" type="submit">Subscribe<i
                                    class="w-icon-long-arrow-right"></i></button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="footer-top">
            <div class="row">
                <div class="col-lg-4 col-sm-6">
                    <div class="widget widget-about">
                        <a href="{{ route ('home') }}" class="logo-footer">
                            <img src="{{ serverPath (optional (siteSettings () -> settings) -> logo) }}"
                                 alt="logo-footer"
                                 width="144"
                                 height="45" />
                        </a>
                        <div class="widget-body">
                            <p class="widget-about-title">Got Question? Call us 24/7</p>
                            <a href="tel:{{ optional (siteSettings () -> settings) -> phone }}"
                               class="widget-about-call">{{ optional (siteSettings () -> settings) -> phone }}</a>
                            <p class="widget-about-desc">
                                {{ optional (siteSettings () -> settings) -> tagline }}
                            </p>
                            
                            @php $settings = siteSettings () @endphp
                            <div class="social-icons social-icons-colored">
                                @if(!empty(trim (optional ($settings -> settings) -> facebook)))
                                    <a href="{{ optional (siteSettings () -> settings) -> facebook }}"
                                       class="social-icon social-facebook w-icon-facebook"></a>
                                @endif
                                
                                @if(!empty(trim (optional ($settings -> settings) -> twitter)))
                                    <a href="{{ optional (siteSettings () -> settings) -> twitter }}"
                                       class="social-icon social-twitter w-icon-twitter"></a>
                                @endif
                                
                                @if(!empty(trim (optional ($settings -> settings) -> instagram)))
                                    <a href="{{ optional (siteSettings () -> settings) -> instagram }}"
                                       class="social-icon social-instagram w-icon-instagram"></a>
                                @endif
                                
                                @if(!empty(trim (optional ($settings -> settings) -> youtube)))
                                    <a href="{{ optional (siteSettings () -> settings) -> youtube }}"
                                       class="social-icon social-youtube w-icon-youtube"></a>
                                @endif
                                
                                @if(!empty(trim (optional ($settings -> settings) -> pinterest)))
                                    <a href="{{ optional (siteSettings () -> settings) -> pinterest }}"
                                       class="social-icon social-pinterest w-icon-pinterest"></a>
                                @endif
                                
                                @if(!empty(trim (optional ($settings -> settings) -> tiktok)))
                                    <a href="{{ optional (siteSettings () -> settings) -> tiktok }}"
                                       class="social-icon social-tiktok w-icon-tiktok">
                                        <i class="fa-brands fa-tiktok"></i>
                                    </a>
                                @endif
                                
                                @if(!empty(trim (optional ($settings -> settings) -> whatsapp)))
                                    <a href="{{ optional (siteSettings () -> settings) -> whatsapp }}"
                                       class="social-icon social-whatsapp w-icon-whatsapp">
                                        <i class="fa-brands fa-whatsapp"></i>
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6">
                    <div class="widget">
                        <h3 class="widget-title">Company</h3>
                        <ul class="widget-body">
                            <li><a href="{{ route ('pages.index', ['page' => 'about-us']) }}">About Us</a></li>
                            <li><a href="{{ route ('contact-us') }}">Contact Us</a></li>
                            <li><a href="{{ route ('users.index') }}">Order History</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6">
                    <div class="widget">
                        <h4 class="widget-title">My Account</h4>
                        <ul class="widget-body">
                            <li><a href="{{ route ('users.index') }}">Track My Order</a></li>
                            <li><a href="{{ route ('cart.index') }}">View Cart</a></li>
                            <li><a href="{{ route ('login') }}">Sign In</a></li>
                            <li><a href="{{ route ('wishlist.index') }}">My Wishlist</a></li>
                            <li><a href="{{ route ('pages.index', ['page' => 'privacy-policy']) }}">Privacy Policy</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6">
                    <div class="widget">
                        <h4 class="widget-title">Customer Service</h4>
                        <ul class="widget-body">
                            <li><a href="{{ route ('pages.index', ['page' => 'product-returns']) }}">Product Returns</a>
                            </li>
                            <li><a href="{{ route ('contact-us') }}">Support Center</a></li>
                            <li><a href="{{ route ('pages.index', ['page' => 'shipping']) }}">Shipping</a></li>
                            <li><a href="{{ route ('pages.index', ['page' => 'terms-and-conditions']) }}">
                                    Term and Conditions
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer-bottom">
            <div class="footer-left"></div>
            <div class="footer-right">
                <span class="payment-label mr-lg-8">We're using safe payment for</span>
                <figure class="payment">
                    <img src="{{ asset('/assets/images/payment.png') }}" alt="payment" width="159" height="25" />
                </figure>
            </div>
        </div>
    </div>
</footer>
<!-- End of Footer -->