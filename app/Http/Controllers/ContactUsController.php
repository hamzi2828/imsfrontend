<?php
    
    namespace App\Http\Controllers;
    
    use App\Http\Requests\ContactFormRequest;
    use App\Http\Requests\NewsletterFormRequest;
    use App\Notifications\ContactNotification;
    use App\Notifications\NewsletterNotification;
    use Illuminate\Contracts\View\View;
    use Illuminate\Database\QueryException;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Cache;
    use Illuminate\Support\Facades\DB;
    use Illuminate\Support\Facades\Log;
    use Illuminate\Support\Facades\Mail;
    use Illuminate\Support\Facades\Notification;
    use App\Models\Newsletter;
    
    class ContactUsController extends Controller {
        
        public function index (): View {
            $data[ 'title' ] = 'Contact Us';
            return view ( 'contact-us', $data );
        }
        
        public function contact ( ContactFormRequest $request ) {
            try {
                Notification ::route ( 'mail', siteSettings () -> settings -> email ) -> notify ( new ContactNotification() );
                return redirect () -> back () -> with ( 'success', 'Email has been sent. We will be in touch with you shortly.' );
            }
            catch ( QueryException | \Exception $exception ) {
                DB ::rollBack ();
                Log ::error ( $exception );
                return redirect () -> back () -> with ( 'error', $exception -> getMessage () ) -> withInput ();
            }
        }
        
        public function newsletter ( NewsletterFormRequest $request ) {
            try {
                  // Get the user's IP address
                     $ip = $request->ip();

                // Create a new newsletter record with the IP address
                $newsletter = Newsletter::create([
                    'email' => $request->input('email'),
                    'auth' => false, // Set default value or based on logic
                    'ip' => $ip,
                ]);
              
                Notification ::route ( 'mail', siteSettings () -> settings -> email ) -> notify ( new NewsletterNotification() );
                Cache ::rememberForever ( 'newsletter-' . $request -> ip (), fn () => 'true' );
                return redirect () -> back ();
            }
            catch ( QueryException | \Exception $exception ) {
                DB ::rollBack ();
                Log ::error ( $exception );
                return redirect () -> back () -> with ( 'error', $exception -> getMessage () ) -> withInput ();
            }
        }
    }
