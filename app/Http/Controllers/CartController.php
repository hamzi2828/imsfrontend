<?php
    
    namespace App\Http\Controllers;
    
    use App\Http\Requests\AddToCartRequest;
    use App\Models\Coupon;
    use App\Models\Product;
    use Gloudemans\Shoppingcart\Facades\Cart;
    use Illuminate\Contracts\View\View;
    use Illuminate\Http\JsonResponse;
    use Illuminate\Http\RedirectResponse;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Session;


    
    class CartController extends Controller {
        
        public function index (): RedirectResponse | View {
            
            if ( Cart ::content () -> count () < 1 )
                return redirect ( route ( 'home' ) );
            
            $data[ 'title' ]         = 'Cart';
            $data[ 'products' ]      = Cart ::content ();
            $data[ 'site_settings' ] = siteSettings ();
            return view ( 'cart', $data );
        }
        
        public function store ( AddToCartRequest $request ) {
            try {
                $slug     = $request -> input ( 'product' );
                $quantity = $request -> input ( 'quantity', '1' );
                $product  = Product ::where ( [ 'slug' => $slug ] ) -> first ();
                if ( $product && $product -> available_quantity () >= $quantity ) {
                    Cart ::add (
                        $product -> id,
                        $product -> title (),
                        $quantity,
                        $product -> discountPrice (),
                        0,
                        [
                            'discount'    => $product -> discount,
                            'net'         => $product -> discountPrice (),
                            'actualPrice' => $product -> productPrice (),
                            'path'        => route ( 'products.show', [ 'product' => $product -> slug ] ),
                            'image'       => serverPath ( $product -> image ),
                        ]
                    );
                    return response () -> json ( $product );
                }
                else {
                    return response () -> json ( 'Invalid product or product out of stock', 500 );
                }
            }
            catch ( \Exception $exception ) {
                return response () -> json ( $exception -> getMessage () );
            }
        }
        
        public function update ( Request $request, string $id ): RedirectResponse {
            try {
                
                if ( $request -> has ( 'clear-cart' ) ) {
                    Cart ::destroy ();
                    session()->remove('coupon-code');
                    session()->remove('coupon-id');
                    return redirect () -> back ();
                }
                
                $quantities = $request -> input ( 'quantity' );
                if ( count ( $quantities ) > 0 ) {
                    foreach ( $quantities as $rowId => $quantity ) {
                        Cart ::update ( $rowId, $quantity );
                    }
                }
                return redirect () -> back ();
            }
            catch ( \Exception $exception ) {
                return redirect () -> back ();
            }
        }
        
        public function remove ( string $id ): RedirectResponse {
            try {
                Cart ::remove ( $id );
                return redirect () -> back ();
            }
            catch ( \Exception $exception ) {
                return redirect () -> back ();
            }
        }
        
        public function apply_discount ( Request $request ): RedirectResponse {
            try {
                $request -> validate ( [
                                           'coupon-code' => [ 'required', 'string', 'exists:coupons,code' ]
                                       ] );
                $coupon_code = $request -> input ( 'coupon-code' );
                $date        = date ( 'Y-m-d' );
                $coupon      = Coupon ::where ( [ 'code' => $coupon_code ] )
                    -> where ( 'start_date', '<=', $date )
                    -> where ( 'end_date', '>=', $date )
                    ->where('status', 'active')
                    -> first ();
                
                if ( $coupon ) {
                    Cart ::setGlobalDiscount ( $coupon -> discount );
                    Session ::put ( 'coupon-code', $coupon_code );
                    Session::put('coupon-id', $coupon->id);
                    return redirect () -> back ();
                }
                else
                    return redirect () -> back () -> with ( 'Invalidcouponcode', 'Invalid coupon code.' ) -> withInput ();
            }
            catch ( \Exception $exception ) {
                return redirect () -> back () -> with ( 'Invalidcouponcode', $exception -> getMessage () );
            }
        }

     
        public function cartslider()
        {
           
                // Check if the cart is empty
            if (Cart::content()->count() != 0) {
                // Prepare the data for response 
                $data = [
                    'status' => 'success',
                    'title' => 'Cart',
                    'products' => Cart::content(),
                    'site_settings' => siteSettings()
                ];
                return response()->json($data);
            } else {
                // Redirect back if the cart is empty
                return redirect()->back();
            }
        
            // Return a JSON response with the data
           
        }
    }
