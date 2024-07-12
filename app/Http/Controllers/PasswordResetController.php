<?php
    
    namespace App\Http\Controllers;
    
    use App\Models\User;
    use App\Rules\EnsureUserIsFrontend;
    use Illuminate\Auth\Events\PasswordReset;
    use Illuminate\Contracts\View\View;
    use Illuminate\Http\RedirectResponse;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Hash;
    use Illuminate\Support\Facades\Password;
    use Illuminate\Support\Str;
    
    class PasswordResetController extends Controller {
        
        public function index (): View {
            $data[ 'title' ] = 'Forgot Password';
            return view ( 'forgot-password.index', $data );
        }
        
        public function email_password ( Request $request ): RedirectResponse {
            $request -> validate ( [
                                       'email' => [ 'required', 'email', 'exists:users,email', new EnsureUserIsFrontend ]
                                   ] );
            
            $status = Password ::sendResetLink (
                $request -> only ( 'email' )
            );
            
            return $status === Password::RESET_LINK_SENT
                ? back () -> with ( [ 'status' => __ ( $status ) ] )
                : back () -> withErrors ( [ 'email' => __ ( $status ) ] );
        }
        
        public function password_reset ( string $token ): View {
            $data[ 'title' ] = 'Password Reset';
            $data[ 'token' ] = $token;
            return view ( 'forgot-password.reset', $data );
        }
        
        public function password_update ( Request $request ): RedirectResponse {
            $request -> validate ( [
                                       'token'    => 'required',
                                       'email'    => 'required|email',
                                       'password' => 'required|min:8|confirmed',
                                   ] );
            
            $status = Password ::reset (
                $request -> only ( 'email', 'password', 'password_confirmation', 'token' ),
                function ( User $user, string $password ) {
                    $user -> forceFill ( [
                                             'password' => Hash ::make ( $password )
                                         ] ) -> setRememberToken ( Str ::random ( 60 ) );
                    
                    $user -> save ();
                    
                    event ( new PasswordReset( $user ) );
                }
            );
            
            return $status === Password::PASSWORD_RESET
                ? redirect () -> route ( 'login' ) -> with ( 'status', __ ( $status ) )
                : back () -> withErrors ( [ 'email' => [ __ ( $status ) ] ] );
        }
        
    }
