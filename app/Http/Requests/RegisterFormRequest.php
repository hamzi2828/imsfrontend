<?php
    
    namespace App\Http\Requests;
    
    use Illuminate\Foundation\Http\FormRequest;
    
    class RegisterFormRequest extends FormRequest {
        
        public function authorize (): bool {
            return true;
        }
        
        public function rules (): array {
            return [
                'full-name' => [ 'required', 'string' ],
                'phone'     => [ 'required', 'string' ],
                'email'     => [ 'required', 'email', 'unique:users,email' ],
                'address'   => [ 'required', 'string' ],
                'password'  => [ 'required', 'string' ],
            ];
        }
    }
