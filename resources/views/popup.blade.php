<style>
.newsletter-popup {
    position: relative;
    z-index: 30;
    width: 72rem !important;
    max-width: 78rem;
    margin: auto;
    background-position: center;
    background-size: cover;
    border-radius: 1rem;
    background-color: #fff;
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
    display: flex;
    gap: 10px;
    justify-content: center;
}

.newsletter-popup .input-wrapper-inline .form-control {
    min-height: 4.4rem;
    border-color: #ccc;
    border-radius: 3rem;
    padding-left: 2.7rem;
    padding-right: 2.7rem;
    color: #666;
    flex: 1;
    width: auto;
}

.newsletter-popup .input-wrapper-inline .btn {
    padding-top: 0.9em;
    border-radius: 3rem;
    padding-bottom: 0.9em;
    white-space: nowrap;
    display: inline-block;
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
    background: rgba(0, 0, 0, 0.7); /* Semi-transparent background */
}

.newsletter-content {
    padding: 8.1rem 4.8rem;
}

.newsletter-form {
    display: flex;
    flex-direction: column; /* Default is column, changes to row on larger screens */
    align-items: center;
    justify-content: center;
    gap: 15px; /* Spacing between input and button */
    margin-top: 20px;
}

/* Style for the input field */
.email-input {
    width: 100%;
    max-width: 400px; /* Adjust as needed */
    padding: 10px 70px;
    border-radius: 30px;
    border: 1px solid #ccc;
    font-size: 1rem;
}

/* Style for the subscribe button */
.subscribe-button {
    width: 100%;
    max-width: 250px; /* Adjust as needed */
    padding: 10px 15px;
    border-radius: 30px;
    font-size: 1rem;
    text-align: center;
    margin-bottom: 10px;
}

/* Responsive adjustments */
@media screen and (max-width: 787px) {
    .newsletter-popup {
        max-width: 90%;
        flex-direction: column;
    }

    .newsletter-image {
        display: none; /* Hide the image on mobile */
    }

    .newsletter-content {
        text-align: center;
    }

    .newsletter-form {
        flex-direction: column;
    }

    .email-input, .subscribe-button {
        width: 100%;
        margin-bottom: 10px;
    }

    .newsletter-popup-wrapper {
        margin-bottom: 100px;
    }
}

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
  
        {{-- <form action="{{ route('newsletter') }}" method="post" class="input-wrapper input-wrapper-inline input-wrapper-round">
          @csrf
          <input type="email" class="form-control email font-size-md" name="email" id="email" placeholder="Your E-mail Address" />
          <button class="btn btn-dark btn-rounded" type="submit">Subscribe</button>
        </form>
   --}}
   <!-- Form Section -->
        <form action="{{ route('newsletter') }}" method="post" class="newsletter-form">
          @csrf
          <input type="email" class="form-control email-input" name="email" id="email" placeholder="Your E-mail Address" />
          <button class="btn btn-dark subscribe-button" type="submit">Subscribe</button>
        </form>

        <div class="form-checkbox d-flex align-items-center">
            <input type="checkbox" class="custom-checkbox" id="hide-newsletter-popup" name="hide-newsletter-popup">
            <label for="hide-newsletter-popup" class="font-size-sm text-light">Don't show this popup again.</label>
        </div>
    </div>

    <div class="newsletter-image ">
      @if(!empty($banners->newsletter_image))
      <div class="newsletter-image">
          <img src="{{ asset($banners->newsletter_image) }}" alt="Newsletter Image" style="max-width: 100%; height: 100%;">
      </div>
      @else
          <div class="newsletter-image">
              <img src="https://tjcuk.sirv.com/Products/content/Email-Subscription/Desktop-A.png" alt="Newsletter Image" style="max-width: 100%; height: 100%; object-fit: cover">
          </div>
      @endif
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