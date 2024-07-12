<?php
    
    namespace App\Http\Controllers;
    
    use App\Models\Sale;
    use Illuminate\Contracts\View\View;
    
    class SaleController extends Controller {
        
        public function index ( Sale $sale ): View {
            $data[ 'title' ] = 'Order #' . $sale -> sale_id;
            $data[ 'sale' ]  = $sale;
            
            if ( $sale -> user_id !== auth () -> user () -> id )
                abort ( 404 );
            
            return view ( 'sale', $data );
        }
        
    }
