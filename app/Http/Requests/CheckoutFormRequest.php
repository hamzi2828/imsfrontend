<?php
    
    namespace App\Http\Requests;
    
    use Illuminate\Foundation\Http\FormRequest;
    
    class CheckoutFormRequest extends FormRequest {
        
        public function authorize (): bool {
            return true;
        }
        
        public function rules (): array {
            return [
                'full-name' => [ 'required', 'string' ],
                'phone'     => [ 'required', 'string' ],
                'email'     => [ 'required', 'email' ],
                'address'   => [ 'required', 'string' ],
            ];
        }
    }
