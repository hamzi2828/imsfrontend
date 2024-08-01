<?php
    
    namespace App\Services;
    
    use App\Models\ProductUserReview;
    
    class ProductUserReviewService {
        
        public function save($request, $product): mixed {
            // Check if user is authenticated
            $userId = auth()->check() ? auth()->user()->id : null;
            $userName = auth()->check() ? auth()->user()->name : $request->input('author', 'Anonymous');
            $userEmail = auth()->check() ? auth()->user()->email : $request->input('email', '');
            
            // Prepare data for insertion
            $info = array(
                'user_id'    => $userId, // Can be null for unauthenticated users
                'product_id' => $product->id,
                'rating'     => $request->input('rating', 0),
                'review'     => $request->input('review'),
                'user_name'  => $userName, // Use the provided name if unauthenticated
                'email'      => $userEmail, // Use the provided email if unauthenticated
            );
            
            // Create the review record
            $data = ProductUserReview::create($info);
        
            return $data;
        }
        
        
    }
