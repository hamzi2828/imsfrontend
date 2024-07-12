<?php
    
    namespace App\Http\Requests;
    
    use Illuminate\Foundation\Http\FormRequest;
    
    class LoginRequest extends FormRequest {
        
        public function authorize (): bool {
            return true;
        }
        
        public function rules (): array {
            return [
                'email'    => [
                    'required',
                    'email',
                    'exists:users,email'
                ],
                'password' => [
                    'required',
                    'string',
                    'min:3',
                ]
            ];
        }
        
        public function messages (): array {
            return [
                'login-email.exists' => 'Invalid email address.',
                'login-password.min' => 'Password should be atleast 3 characters long.',
            ];
        }
    }
