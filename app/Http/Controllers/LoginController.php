<?php
    
    namespace App\Http\Controllers;
    
    use App\Http\Requests\LoginRequest;
    use App\Services\LoginService;
    use Illuminate\Contracts\View\View;
    use Illuminate\Database\QueryException;
    use Illuminate\Http\RedirectResponse;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Auth;
    use Illuminate\Support\Facades\Log;
    
    class LoginController extends Controller {
        
        public function index (): View {
            $data[ 'title' ] = 'Login';
            return view ( 'login.index', $data );
        } 
        
        public function authenticate ( LoginRequest $request ): RedirectResponse {
            try {
                $user_id = ( new LoginService() ) -> login ( $request );
                if ( $user_id > 0 )
                    return redirect () -> intended ( route ( 'users.index' ) );
                else
                    return redirect () -> back () -> with ( 'login_invalid', 'Invalid Username or Password.' );
            }
            catch ( QueryException | \Exception $exception ) {
                Log ::info ( $exception );
                return redirect () -> back () -> with ( 'error', $exception -> getMessage () ) -> withInput ();
            }
        }
        
        public function logout ( Request $request ): RedirectResponse {
            Auth ::logout ();
            $request -> session () -> regenerate ();
            return redirect ( route ( 'home' ) );
        }
    }
