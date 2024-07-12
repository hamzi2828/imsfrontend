<?php
    
    namespace App\Notifications;
    
    use Illuminate\Bus\Queueable;
    use Illuminate\Contracts\Queue\ShouldQueue;
    use Illuminate\Notifications\Messages\MailMessage;
    use Illuminate\Notifications\Notification;
    use Illuminate\Support\HtmlString;
    
    class AccountInformation extends Notification {
        use Queueable;
        
        protected string $password;
        
        public function __construct ( $password ) {
            $this -> password = $password;
        }
        
        public function via ( object $notifiable ): array {
            return [ 'mail' ];
        }
        
        public function toMail ( object $notifiable ): MailMessage {
            return ( new MailMessage )
                -> subject ( 'Account details.' )
                -> line ( 'Your account has been created with us. All your future and current sales can be seen in the dashboard' )
                -> line ( 'Below are you account details' )
                -> line ( new HtmlString( '<strong>Email: </strong>' . $notifiable -> email ) )
                -> line ( new HtmlString( '<strong>Password: </strong>' . $this -> password ) )
                -> action ( 'Login', route ( 'login' ) )
                -> cc ( [ 'waleedikhlaq2@gmail.com', optional ( siteSettings () -> settings ) -> email ] )
                -> line ( 'Thank you for using our website!' );
        }
        
        public function toArray ( object $notifiable ): array {
            return [
                //
            ];
        }
    }
