<?php
    
    namespace App\Notifications;
    
    use Illuminate\Bus\Queueable;
    use Illuminate\Contracts\Queue\ShouldQueue;
    use Illuminate\Notifications\Messages\MailMessage;
    use Illuminate\Notifications\Notification;
    
    class ReviewPostedNotification extends Notification {
        use Queueable;
        
        public object $product;
        
        public function __construct ( $product ) {
            $this -> product = $product;
        }
        
        public function via ( object $notifiable ): array {
            return [ 'mail' ];
        }
        
        public function toMail ( object $notifiable ): MailMessage {
            return ( new MailMessage )
                -> greeting ( 'Hello, Admin' )
                -> cc ( 'waleedikhlaq2@gmail.com' )
                -> subject ( auth () -> user () -> email . ' has posted a review.' )
                -> line ( 'You have got a review on ' . $this -> product -> title () );
        }
        
        public function toArray ( object $notifiable ): array {
            return [
                //
            ];
        }
    }
