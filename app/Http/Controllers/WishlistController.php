<?php
    
    namespace App\Http\Controllers;
    
    use App\Models\Product;
    use Illuminate\Contracts\View\View;
    use Illuminate\Support\Facades\Cache;
    
    class WishlistController extends Controller {
        
        public function index (): View {
            $title    = 'Wishlist';
            $ip       = request () -> ip ();
            $wishlist = Cache ::get ( "wishlist_{$ip}", [] );
            $products = Product ::whereIn ( 'id', $wishlist ) -> get ();
            return view ( 'wishlist.index', compact ( 'title', 'products' ) );
        }
        
        public function destroy ( string $id ) {
            //
        }
    }
