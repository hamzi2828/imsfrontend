<?php
    
    namespace App\Http\Controllers;
    
    use App\Http\Requests\ProductUserReviewFormRequest;
    use App\Models\Product;
    use App\Models\ProductUserReview;
    use App\Notifications\ReviewPostedNotification;
    use App\Services\ProductUserReviewService;
    use Illuminate\Database\QueryException;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\DB;
    use Illuminate\Support\Facades\Log;
    use Illuminate\Support\Facades\Notification;
    
    class ProductUserReviewController extends Controller {
        
        public function store ( ProductUserReviewFormRequest $request, Product $product ) {
            try {
                DB ::beginTransaction ();
                ( new ProductUserReviewService() ) -> save ( $request, $product );
                Notification ::route ( 'mail', siteSettings () -> settings -> email ) -> notify ( new ReviewPostedNotification( $product ) );
                DB ::commit ();
                
                return redirect () -> back () -> with ( 'status', 'Your review has been sent for review.' );
                
            }
            catch ( QueryException | \Exception $exception ) {
                DB ::rollBack ();
                Log ::error ( $exception );
                return redirect () -> back () -> with ( 'error', $exception -> getMessage () ) -> withInput ();
            }
        }
    }