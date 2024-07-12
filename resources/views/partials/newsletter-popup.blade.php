<div class="popup"
     style="position: fixed; width: 100%; height: 100%; z-index: 999999; background: rgba(0, 0, 0, 0.5); top: 0; display: none; justify-content: center; align-items: center;">
    <div class="newsletter-popup mfp-show"
         style="background: #FFFFFF none; flex-direction: column; position: relative;">
        <div class="close-btn" style="position: absolute; top: 25px; right: 25px;">
            <a href="javascript:void(0)" onclick="closePopup()">
                <i class="fa-regular fa-circle-xmark" style="font-size: 25px"></i>
            </a>
        </div>
        <div class="newsletter-content">
            <h2 class="ls-25">Sign up to Wolmart</h2>
            <p class="text-light ls-10">
                Subscribe to the Wolmart market newsletter to receive updates on special offers.
            </p>
            @include('errors.validation-errors')
            <form action="{{ route ('newsletter') }}" method="post"
                  class="input-wrapper input-wrapper-inline input-wrapper-round">
                @csrf
                <input type="email" class="form-control email font-size-md" name="email" id="email2"
                       placeholder="Your email address" required="required" value="{{ old ('email') }}">
                <button class="btn btn-dark" type="submit">SUBMIT</button>
            </form>
            <div class="form-checkbox d-flex align-items-center">
                <input type="checkbox" class="custom-checkbox" id="hide-newsletter-popup" name="hide-newsletter-popup"
                       value="1">
                <label for="hide-newsletter-popup" class="font-size-sm text-light">Don't show this popup again.</label>
            </div>
        </div>
        
        @php $settings = siteSettings () @endphp
        <div class="social-icons social-icons-colored mt-5">
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