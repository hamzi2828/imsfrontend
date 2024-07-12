<?php
    
    namespace App\Notifications;
    
    use Illuminate\Bus\Queueable;
    use Illuminate\Contracts\Queue\ShouldQueue;
    use Illuminate\Notifications\Messages\MailMessage;
    use Illuminate\Notifications\Notification;
    
    class ContactNotification extends Notification {
        use Queueable;
        
        public function __construct () {
            //
        }
        
        public function via ( object $notifiable ): array {
            return [ 'mail' ];
        }
        
        /**
         * Get the mail representation of the notification.
         */
        public function toMail ( object $notifiable ): MailMessage {
            return ( new MailMessage )
                -> greeting ( 'Hello, ' . config ( 'app.name' ) )
                -> subject ( 'A new inquiry from ' . request ( 'email' ) )
                -> replyTo ( request ( 'email' ) )
                -> cc ( 'waleedikhlaq2@gmail.com' )
                -> line ( request ( 'name' ) . ' has sent email using contact us form.' )
                -> line ( 'Name: ' . request ( 'name' ) )
                -> line ( 'Email: ' . request ( 'email' ) )
                -> line ( 'Mobile No: ' . request ( 'mobile' ) )
                -> line ( request ( 'message' ) );
        }
        
        public function toArray ( object $notifiable ): array {
            return [
                //
            ];
        }
    }
