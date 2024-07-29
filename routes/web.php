<?php
    
    use App\Http\Controllers\BlogController;
    use App\Http\Controllers\CartController;
    use App\Http\Controllers\CheckoutController;
    use App\Http\Controllers\ContactUsController;
    use App\Http\Controllers\HomeController;
    use App\Http\Controllers\LoginController;
    use App\Http\Controllers\PageController;
    use App\Http\Controllers\PasswordResetController;
    use App\Http\Controllers\ProductController;
    use App\Http\Controllers\ProductUserReviewController;
    use App\Http\Controllers\SaleController;
    use App\Http\Controllers\SignupController;
    use App\Http\Controllers\UserController;
    use App\Http\Controllers\WishlistController;
    use Illuminate\Support\Facades\Route;
    
    Route ::get ( '/', [ HomeController::class, 'index' ] ) -> name ( 'home' );
    
    Route ::get ( '/blog', [ BlogController::class, 'index' ] ) -> name ( 'blog' );
    Route ::get ( '/blog/{slug}', [ BlogController::class, 'view' ] ) -> name ( 'blog.view' );
    
    Route ::get ( '/products/{product:slug}/quick-view', [ ProductController::class, 'quick_view' ] ) -> name ( 'products.quick-view' );
    Route ::get ( '/products/{product:slug}/get-variation', [ ProductController::class, 'get_variation' ] ) -> name ( 'products.get-variation' );
    Route ::post ( '/product/{product:slug}/add-to-wishlist', [ ProductController::class, 'add_to_wishlist' ] ) -> name ( 'products.add-to-wishlist' );
    Route ::resource ( 'products', ProductController::class );
    
    Route ::get ( '/cart/{cart}/remove', [ CartController::class, 'remove' ] ) -> name ( 'cart.remove' );
    Route ::get ( '/cart/clear', [ CartController::class, 'clear' ] ) -> name ( 'cart.clear' );
    Route ::post ( '/cart/apply-discount', [ CartController::class, 'apply_discount' ] ) -> name ( 'cart.apply-discount' );
    Route ::resource ( 'cart', CartController::class );



    
    Route ::resource ( 'checkout', CheckoutController::class );
    Route ::resource ( 'wishlist', WishlistController::class );
    
    Route ::get ( '/pages/{page:page_name}', [ PageController::class, 'index' ] ) -> name ( 'pages.index' );
    Route ::get ( '/sales/{sale:sale_id}', [ SaleController::class, 'index' ] ) -> name ( 'sales.index' );
    
    Route ::middleware ( [ 'guest', 'throttle:60,1' ] ) -> group ( function () {
        Route ::get ( '/login', [ LoginController::class, 'index' ] ) -> name ( 'login' );
        Route ::get ( '/logout', [ LoginController::class, 'logout' ] ) -> name ( 'login.logout' ) -> withoutMiddleware ( 'guest' );
        Route ::patch ( '/authenticate', [ LoginController::class, 'authenticate' ] ) -> name ( 'authenticate' );
        Route ::get ( '/forgot-password', [ PasswordResetController::class, 'index' ] ) -> name ( 'password.request' );
        Route ::post ( '/forgot-password', [ PasswordResetController::class, 'email_password' ] ) -> name ( 'password.email' );
        Route ::get ( '/reset-password/{token}', [ PasswordResetController::class, 'password_reset' ] ) -> name ( 'password.reset' );
        Route ::post ( '/reset-password/{token}', [ PasswordResetController::class, 'password_update' ] ) -> name ( 'password.update' );
        Route ::get ( '/signup', [ SignupController::class, 'index' ] ) -> name ( 'signup' );
        Route ::post ( '/signup', [ SignupController::class, 'register' ] ) -> name ( 'register' );
    } );
    
    Route ::middleware ( [ 'throttle:60,1' ] ) -> group ( function () {
        Route ::get ( '/contact-us', [ ContactUsController::class, 'index' ] ) -> name ( 'contact-us' );
        Route ::post ( '/contact-us', [ ContactUsController::class, 'contact' ] ) -> name ( 'contact' );
        Route ::post ( '/newsletter', [ ContactUsController::class, 'newsletter' ] ) -> name ( 'newsletter' );
    } );
    
    Route ::middleware ( [ 'auth' ] ) -> group ( function () {
        Route ::resource ( 'users', UserController::class );
        Route ::post ( 'product/{product:slug}/reviews/store', [ ProductUserReviewController::class, 'store' ] ) -> name ( 'reviews.store' );
    } );
    
    Route ::get ( '/invoice/{sale:sale_id}', function ( \App\Models\Sale $sale ) {
        return ( new \App\Notifications\OrderCreatedNotification( $sale ) ) -> toMail ( \App\Models\User ::first () );
    } );


    Route::get('/phone-number', [HomeController::class, 'getPhoneNumber']);
  
Route::get('/cart-slider', [CartController::class, 'cartslider'])->name('cart.slider');

