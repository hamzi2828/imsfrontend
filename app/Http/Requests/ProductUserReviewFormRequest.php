<?php
    
    namespace App\Http\Requests;
    
    use Illuminate\Foundation\Http\FormRequest;
    
    class ProductUserReviewFormRequest extends FormRequest {
        
        public function authorize (): bool {
            return true;
        }
        
        public function rules (): array {
            return [
                'rating' => [ 'required', 'numeric', 'between:0,5' ],
                'review' => [ 'required', 'string' ]
            ];
        }
    }