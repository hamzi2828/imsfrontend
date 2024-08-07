<style>
.newsletter-popup {
  position: relative;
  z-index: 30;
    width: 72rem !important;
    max-width: 78rem;
    padding: 8.1rem 4.8rem;
    margin: auto;
    background-position: center;
    background-size: cover;
    border-radius: 1rem;
    background-image: url(../../assets/images/newsletter-11.png);
    /* position: fixed; /* Position fixed for popup */
    /* top: 50%; Center vertically */
    /* left: 50%; Center horizontally */
    /* transform: translate(-50%, -50%); Centering adjustment */ */
    z-index: 9999; /* Ensure it's above other content */
  }
  
  .newsletter-popup .popup-media {
    margin-bottom: 1.7rem;
  }
  
  .newsletter-popup h4 {
    margin-bottom: 0.4rem;
    font-size: 2rem;
  }
  
  .newsletter-popup h4 span {
    display: inline-block;
    margin-left: 0.4rem;
    font-weight: 800;
  }
  
  .newsletter-popup h2 {
    margin-bottom: 1.1rem;
    font-weight: 800;
    font-size: 2.8rem;
    line-height: 1.2;
  }
  
  .newsletter-popup p {
    margin-bottom: 2.3rem;
    line-height: 1.75;
  }
  
  .newsletter-popup .input-wrapper-inline {
    max-width: 34rem;
    margin-bottom: 3rem;
  }
  
  .newsletter-popup .input-wrapper-inline .form-control {
    min-height: 4.4rem;
    border-color: #ccc;
    color: #666;
    
  }
  
  .newsletter-popup .input-wrapper-inline .btn {
    padding-top: 0.9em;
    padding-bottom: 0.9em;
  }
  
  .newsletter-popup label {
    padding-left: 2.7rem;
  }
  
  .newsletter-popup label:before {
    border-color: #999;
  }
  
  .newsletter-popup .close-popup {
    position: absolute;
    top: 1rem; 
    right: 1rem;
    background: transparent;
    border: none;
    font-size: 2rem;
    cursor: pointer;
  }

  .newsletter-popup-wrapper {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    display: none;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    z-index: 9999;
  }

  .newsletter-backdrop {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.7); 
    z-index: 20;/* Semi-transparent background */
    /* backdrop-filter: blur(5px); Apply blur effect */
  }
  /* .main {
    filter: blur(5px);
    pointer-events: none;
} */
</style>


@php
    $display_popup = optional(siteSettings()->settings)->display_popup;
@endphp

@if($display_popup === 'yes')
<!-- Start of Newsletter popup -->
<div class="newsletter-popup-wrapper">
  <!-- Backdrop Overlay -->
  <div class="newsletter-backdrop"></div>

  <div class="newsletter-popup">
    <div class="newsletter-content">
        <button class="close-popup">×</button> <!-- Close button -->
        <!-- Display Newsletter Image -->
        @if(!empty($banners->newsletter_image))
            <div class="newsletter-image mb-4">
                <img src="{{ asset($banners->newsletter_image) }}" alt="Newsletter Image" style="max-width: 100%; height: auto;">
            </div>
        @endif
        <!-- Display Newsletter Title -->
        <h4 class="text-uppercase font-weight-normal ls-25">
            {{ $banners->newsletter_title ?? 'Get Up to 25% Off' }}
        </h4>
        <!-- Display Newsletter Subtitle -->
        <h2 class="ls-25">
            {{ $banners->newsletter_subtitle ?? 'Subscribe to the Wolmart newsletter' }}
        </h2>
        <!-- Display Newsletter Description -->
        <p class="text-light ls-10">
            {{ $banners->newsletter_description ?? 'Subscribe to the  newsletter to receive updates on special offers.' }}
        </p>
  
        <form action="{{ route('newsletter') }}" method="post" class="input-wrapper input-wrapper-inline input-wrapper-round">
          @csrf
          <input type="email" class="form-control email font-size-md" name="email" id="email" placeholder="Your E-mail Address" />
          <button class="btn btn-dark btn-rounded" type="submit">Subscribe</button>
        </form>
  
        <div class="form-checkbox d-flex align-items-center">
            <input type="checkbox" class="custom-checkbox" id="hide-newsletter-popup" name="hide-newsletter-popup">
            <label for="hide-newsletter-popup" class="font-size-sm text-light">Don't show this popup again.</label>
        </div>
    </div>
  </div>
</div>

<!-- End of Newsletter popup -->
@endif

<script>
document.addEventListener('DOMContentLoaded', function() {
    var popup = document.querySelector('.newsletter-popup-wrapper ');
    var closeButton = document.querySelector('.close-popup');
    var checkbox = document.querySelector('#hide-newsletter-popup');

    // Check if the user has opted out of seeing the popup again
    if (localStorage.getItem('hideNewsletterPopup') === 'true') {
        popup.style.display = 'none';
    } else {
        popup.style.display = 'flex';
        popup.classList.add('blurred-background');
    }

    // Close button functionality
    closeButton.addEventListener('click', function() {
        popup.style.display = 'none'; // Hide the popup
        if (checkbox.checked) {
            localStorage.setItem('hideNewsletterPopup', 'true');
        }
    });
});


</script>