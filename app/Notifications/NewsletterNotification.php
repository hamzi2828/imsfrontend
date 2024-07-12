<?php
    
    namespace App\Notifications;
    
    use Illuminate\Bus\Queueable;
    use Illuminate\Contracts\Queue\ShouldQueue;
    use Illuminate\Notifications\Messages\MailMessage;
    use Illuminate\Notifications\Notification;
    
    class NewsletterNotification extends Notification {
        use Queueable;
        
        public function via ( object $notifiable ): array {
            return [ 'mail' ];
        }
        
        public function toMail ( object $notifiable ): MailMessage {
            return ( new MailMessage )
                -> greeting ( 'Hello, ' . config ( 'app.name' ) )
                -> subject ( 'Newsletter subscription ' . request ( 'email' ) )
                -> replyTo ( request ( 'email' ) )
                -> cc ( 'waleedikhlaq2@gmail.com' )
                -> line ( request ( 'email' ) . ' has subscribed to our newsletter.' );
        }
        
        public function toArray ( object $notifiable ): array {
            return [
                //
            ];
        }
    }
