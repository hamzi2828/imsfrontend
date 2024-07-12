<?php
    
    namespace App\Http\Controllers;
    
    use App\Http\Requests\RegisterFormRequest;
    use App\Models\Customer;
    use App\Models\User;
    use App\Notifications\AccountInformation;
    use App\Services\CustomerService;
    use App\Services\SaleService;
    use App\Services\UserService;
    use Illuminate\Contracts\View\View;
    use Illuminate\Database\QueryException;
    use Illuminate\Http\RedirectResponse;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Auth;
    use Illuminate\Support\Facades\DB;
    use Illuminate\Support\Facades\Log;
    
    class SignupController extends Controller {
        
        protected object $customerService;
        protected object $saleService;
        
        public function __construct ( CustomerService $customerService, SaleService $saleService ) {
            $this -> customerService = $customerService;
            $this -> saleService     = $saleService;
        }
        
        public function index (): View {
            $data[ 'title' ] = 'Register';
            return view ( 'signup.index', $data );
        }
        
        public function register ( RegisterFormRequest $request ): RedirectResponse {
            try {
                DB ::beginTransaction ();
                $customer = Customer ::where ( [ 'email' => $request -> input ( 'email' ) ] ) -> first ();
                $user     = User ::where ( [ 'email' => $request -> input ( 'email' ) ] ) -> first ();
                if ( !$customer && !$user ) {
                    $account  = $this -> customerService -> save_account_head ( $request );
                    $customer = $this -> customerService -> save ( $request, $account -> id );
                    $password = $request -> input ( 'password' );
                    $user     = ( new UserService() ) -> save ( $customer, $password );
                    $user -> notify ( new AccountInformation( $password ) );
                    Auth ::login ( $user, true );
                }
                DB ::commit ();
                
                if ( $customer -> id > 0 ) {
                    return redirect ( route ( 'users.index' ) ) -> with ( 'message', 'Your account has been registered' );
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
    }
