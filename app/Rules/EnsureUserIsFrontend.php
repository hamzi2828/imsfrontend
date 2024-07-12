<?php
    
    namespace App\Rules;
    
    use App\Models\User;
    use Closure;
    use Illuminate\Contracts\Validation\ValidationRule;
    
    class EnsureUserIsFrontend implements ValidationRule {
        
        public function validate ( string $attribute, mixed $value, Closure $fail ): void {
            $user = User ::where ( [ 'email' => $value ] ) -> first ();
            $fail( 'Email address is not a valid user.' );
        }
        
        public function message (): string {
            return 'The selected email is not associated with any user.';
        }
    }
