function ajaxSetup () {
    jQuery.ajaxSetup ( {
                           headers: {
                               'X-CSRF-TOKEN': jQuery ( 'meta[name="csrf-token"]' ).attr ( 'content' )
                           }
                       } );
}

function ajaxErrors ( xHR, exception ) {
    let msg = '';
    if ( xHR.status === 0 ) {
        msg = 'Not connect.\n Verify Network.';
    }
    else if ( xHR.status === 404 ) {
        msg = 'Requested page not found. [404]';
    }
    else if ( xHR.status === 500 ) {
        msg = 'Internal Server Error [500].';
    }
    else if ( exception === 'parsererror' ) {
        msg = 'Requested JSON parse failed.';
    }
    else if ( exception === 'timeout' ) {
        msg = 'Time out error.';
    }
    else if ( exception === 'abort' ) {
        msg = 'Ajax request aborted.';
    }
    else {
        msg = 'Uncaught Error.\n' + xHR.responseText;
    }
    alert ( msg );
}

function initProductQuickView ( route ) {
    if ( route.length > 0 ) {
        ajaxSetup ();
        
        jQuery.ajax ( {
                          type   : 'GET',
                          url    : route,
                          success: function ( response ) {
                              Wolmart.popup ( {
                                                  items    : {
                                                      src: response
                                                  },
                                                  callbacks: {
                                                      open : function () {
                                                          Wolmart.productSingle ( $ ( '.mfp-product .product-single' ) );
                                                      },
                                                      close: function () {
                                                          $ ( '.mfp-product .swiper-container' ).data ( 'slider' ).destroy ();
                                                      }
                                                  }
                                              }, 'quickview' );
                          },
                          error  : function ( xHR, exception ) {
                              ajaxErrors ( xHR, exception );
                          }
                      } )
    }
}

function addToCart ( event, route, availableQty ) {
    
    let $this    = $ ( event ),
        $product = $this.closest ( '.product, .product-popup' );
    $this.toggleClass ( 'added' ).addClass ( 'load-more-overlay loading' );
    
    let quantity = $ ( '#cart-quantity' ).val ();
    
    if ( !quantity )
        quantity = 1;
    
    if ( parseInt ( availableQty ) < parseInt ( quantity ) ) {
        alert ( 'Required quantity is out of stock' );
        $this.removeClass ( 'load-more-overlay loading' );
        return;
    }
    
    if ( route.length > 0 ) {
        ajaxSetup ();
        
        jQuery.ajax ( {
                          type   : 'POST',
                          url    : route,
                          data   : {
                              quantity
                          },
                          success: function ( product ) {
                              $this.removeClass ( 'load-more-overlay loading' );
                              
                              Wolmart.Minipopup.open ( {
                                                           productClass  : ' product-cart',
                                                           name          : product.title,
                                                           nameLink      : $product.find ( '.product-name > a, .product-title > a' ).attr ( 'href' ),
                                                           imageSrc      : $product.find ( '.product-media img, .product-image:first-child img' ).attr ( 'src' ),
                                                           imageLink     : $product.find ( '.product-name > a' ).attr ( 'href' ),
                                                           message       : '<p>has been added to cart:</p>',
                                                           actionTemplate: '<a href="/cart" class="btn btn-rounded btn-sm">View Cart</a><a href="/checkout" class="btn btn-dark btn-rounded btn-sm">Checkout</a>'
                                                       } );
                              
                              let cartCount = $ ( '.cart-count' );
                              let cartTotal = parseInt ( cartCount.html () ) + 1;
                              cartCount.html ( cartTotal );
                          },
                          error  : function ( xHR, exception ) {
                              ajaxErrors ( xHR, exception );
                          }
                      } )
    }
}

function updateVariation ( route ) {
    const form     = document.getElementById ( 'product-variation-form' );
    const formData = new FormData ( form );
    
    // Build query string from selected terms
    let queryString = '';
    formData.forEach ( ( value, key ) => {
        if ( value ) {
            queryString += `${ key }=${ value }&`;
        }
    } );
    
    if ( queryString ) {
        fetch ( route + `?${ queryString }` )
            .then ( response => response.json () )
            .then ( data => {
                if ( data.success ) {
                    document.getElementById ( 'variation-sku' ).innerText   = `SKU: ${ data.variation.sku }`;
                    document.getElementById ( 'variation-price' ).innerText = `Price: $${ data.variation.price }`;
                    document.getElementById ( 'variation-stock' ).innerText = `Stock: ${ data.variation.stock }`;
                }
                else {
                    document.getElementById ( 'variation-sku' ).innerText   = '';
                    document.getElementById ( 'variation-price' ).innerText = '';
                    document.getElementById ( 'variation-stock' ).innerText = 'No such variation available';
                }
            } );
    }
    else {
        document.getElementById ( 'variation-sku' ).innerText   = '';
        document.getElementById ( 'variation-price' ).innerText = '';
        document.getElementById ( 'variation-stock' ).innerText = '';
    }
}

function addToWishList ( route ) {
    if ( route.length > 0 ) {
        ajaxSetup ();
        
        jQuery.ajax ( {
                          type   : 'POST',
                          url    : route,
                          success: function ( product_id ) {
                              let element = $ ( '#wishlist-' + product_id );
                              element.removeClass ( 'w-icon-heart' );
                              element.addClass ( 'w-icon-heart-full' );
                          },
                          error  : function ( xHR, exception ) {
                              ajaxErrors ( xHR, exception );
                          }
                      } )
    }
}