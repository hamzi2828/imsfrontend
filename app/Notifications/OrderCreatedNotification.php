<?php
    
    namespace App\Notifications;
    
    use Illuminate\Bus\Queueable;
    use Illuminate\Contracts\Queue\ShouldQueue;
    use Illuminate\Notifications\Messages\MailMessage;
    use Illuminate\Notifications\Notification;
    
    class OrderCreatedNotification extends Notification {
        use Queueable;
        
        protected $sale;
        
        public function __construct ( $sale ) {
            $this -> sale = $sale;
        }
        
        public function via ( object $notifiable ): array {
            return [ 'mail' ];
        }
        
        public function toMail ( object $notifiable ): MailMessage {
            return ( new MailMessage )
                -> subject ( 'Thank you for your purchase! Sale# ' . $this -> sale -> sale_id )
                -> cc ( [ 'waleedikhlaq2@gmail.com', optional ( siteSettings () -> settings ) -> email ] )
                -> view ( 'emails.order-created', [
                    'sale' => $this -> sale,
                    'user' => $notifiable
                ] );
        }
        
        public function toArray ( object $notifiable ): array {
            return [
                //
            ];
        }
    }
