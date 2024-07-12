<?php
    
    namespace App\Services;
    
    use App\Models\ProductUserReview;
    
    class ProductUserReviewService {
        
        public function save ( $request, $product ): mixed {
            $info = array (
                'user_id'    => auth () -> user () -> id,
                'product_id' => $product -> id,
                'rating'     => $request -> input ( 'rating', 0 ),
                'review'     => $request -> input ( 'review' ),
            );
            return ProductUserReview ::create ( $info );
        }
    }
