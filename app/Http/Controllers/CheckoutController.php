<?php
    
    namespace App\Http\Controllers;
    
    use App\Http\Requests\CheckoutFormRequest;
    use App\Models\Customer;
    use App\Models\User;
    use App\Notifications\AccountInformation;
    use App\Notifications\OrderCreatedNotification;
    use App\Services\CustomerService;
    use App\Services\SaleService;
    use App\Services\UserService;
    use Gloudemans\Shoppingcart\Facades\Cart;
    use Illuminate\Contracts\View\View;
    use Illuminate\Database\QueryException;
    use Illuminate\Http\RedirectResponse;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Auth;
    use Illuminate\Support\Facades\DB;
    use Illuminate\Support\Facades\Log;
    
    class CheckoutController extends Controller {
        
        protected object $customerService;
        protected object $saleService;
        
        public function __construct ( CustomerService $customerService, SaleService $saleService ) {
            $this -> customerService = $customerService;
            $this -> saleService     = $saleService;
        }
        
        public function index (): RedirectResponse | View {
            
            if ( Cart ::content () -> count () < 1 )
                return redirect ( route ( 'home' ) );
            
            $data[ 'title' ]         = 'Cart';
            $data[ 'products' ]      = Cart ::content ();
            $data[ 'site_settings' ] = siteSettings ();
            return view ( 'checkout', $data );
        }
        
        public function store ( CheckoutFormRequest $request ): RedirectResponse {
            try {
                DB ::beginTransaction ();
                $customer = Customer ::where ( [ 'email' => $request -> input ( 'email' ) ] ) -> first ();
                $user     = User ::where ( [ 'email' => $request -> input ( 'email' ) ] ) -> first ();
                if ( !$customer && !$user ) {
                    $account  = $this -> customerService -> save_account_head ( $request );
                    $customer = $this -> customerService -> save ( $request, $account -> id );
                    $password = 'Pa$$word!' . $customer -> id;
                    $user     = ( new UserService() ) -> save ( $customer, $password );
                    $user -> notify ( new AccountInformation( $password ) );
                    Auth ::login ( $user, true );
                }
                
                $sale = $this -> saleService -> sale ( $request, $customer );
                $this -> saleService -> sale_products ( $request, $sale );
                $user -> notify ( new OrderCreatedNotification( $sale ) );
                DB ::commit ();
                
                if ( $customer -> id > 0 ) {
                    Cart ::destroy ();
                    session () -> remove ( 'coupon-code' );
                    return redirect ( route ( 'sales.index', [ 'sale' => $sale -> sale_id ] ) )
                        -> with ( 'message', 'Your purchase has been successfully completed, and a confirmation email has been sent to you for your records.' );
                }
                else
                    return redirect () -> back () -> with ( 'error', 'Unexpected error occurred. Please contact administrator.' ) -> withInput ();
                
            }
            catch ( QueryException | \Exception $exception ) {
                DB ::rollBack ();
                Log ::error ( $exception );
                return redirect () -> back () -> with ( 'error', $exception -> getMessage () ) -> withInput ();
            }
        }
        
        public function show ( string $id ) {
            //
        }
        
        public function edit ( string $id ) {
            //
        }
        
        public function update ( Request $request, string $id ) {
            //
        }
        
        public function destroy ( string $id ) {
            //
        }
    }
