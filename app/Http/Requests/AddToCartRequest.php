<?php
    
    namespace App\Http\Requests;
    
    use Illuminate\Foundation\Http\FormRequest;
    
    class AddToCartRequest extends FormRequest {
        
        public function authorize (): bool {
            return true;
        }
        
        public function rules (): array {
            return [
                'product'  => [ 'required', 'string', 'exists:products,slug' ],
                'quantity' => [ 'required', 'numeric', 'min:1' ]
            ];
        }
    }
