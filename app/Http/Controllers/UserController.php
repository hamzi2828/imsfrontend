<?php
    
    namespace App\Http\Controllers;
    
    use App\Models\Customer;
    use App\Models\Sale;
    use App\Models\User;
    use App\Services\UserService;
    use Illuminate\Contracts\View\View;
    use Illuminate\Database\QueryException;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\DB;
    use Illuminate\Support\Facades\Log;
    
    class UserController extends Controller {
        
        public function index (): View {
            $data[ 'title' ]  = 'My Account';
            $customer         = Customer ::where ( [ 'email' => auth () -> user () -> email ] ) -> first ();
            $data[ 'orders' ] = Sale ::where ( [ 'customer_id' => $customer -> id ] ) -> with ( [ 'customer', 'products.product' ] ) -> get ();
            return view ( 'user.index', $data );
        }
        
        public function update ( Request $request, User $user ) {
            try {
                DB ::beginTransaction ();
                ( new UserService() ) -> edit ( $request, $user );
                DB ::commit ();
                return redirect () -> back () -> with ( 'message', 'User has been updated.' );
            }
            catch ( QueryException | \Exception $exception ) {
                DB ::rollBack ();
                Log ::error ( $exception );
                return redirect () -> back () -> with ( 'error', $exception -> getMessage () ) -> withInput ();
            }
        }
        
        public function destroy ( string $id ) {
            //
        }
    }
