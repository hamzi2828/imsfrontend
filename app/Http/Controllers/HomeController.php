<?php
    
    namespace App\Http\Controllers;
    
    use App\Models\HomeSetting;
    use App\Models\Product;
    use App\Services\CategoryService;
    use App\Services\ProductService;
    use Illuminate\Contracts\View\View;
    use Illuminate\Http\Request;
    use App\Models\SiteSettings;

    use Illuminate\Support\Facades\Cache;
    
    class HomeController extends Controller {
        
        public function index (): View {
          
            $data[ 'title' ]      = 'Home';
            $data[ 'categories' ] = collect ( ( new CategoryService() ) -> all () ) -> take ( 11 );
            
            $data[ 'sliderProducts' ] = collect ( ( new ProductService() ) -> sliderProducts () ) -> take ( 10 );
            if ( optional ( siteSettings () -> settings ) -> display_out_of_stock_products == '0' ) {
                $data[ 'sliderProducts' ] = collect ( ( new ProductService() ) -> sliderProducts () ) -> filter ( function ( $products ) {
                    return $products -> available_quantity () > 0;
                } ) -> take ( 10 );
            }
            
            $data[ 'deals' ] = collect ( ( new ProductService() ) -> deals () ) -> take ( 5 );
            if ( optional ( siteSettings () -> settings ) -> display_out_of_stock_products == '0' ) {
                $data[ 'deals' ] = collect ( ( new ProductService() ) -> deals () ) -> filter ( function ( $products ) {
                    return $products -> available_quantity () > 0;
                } ) -> take ( 5 );
            }
            
            $data[ 'best_selling' ] = collect ( ( new ProductService() ) -> best_seller () ) -> take ( 4 );
            if ( optional ( siteSettings () -> settings ) -> display_out_of_stock_products == '0' ) {
                $data[ 'best_selling' ] = collect ( ( new ProductService() ) -> best_seller () ) -> filter ( function ( $products ) {
                    return $products -> available_quantity () > 0;
                } ) -> take ( 4 );
            }
            
            // $data[ 'category_products' ] = collect ( ( new CategoryService() ) -> category_products () ) -> take ( 4 );
            // if ( optional ( siteSettings () -> settings ) -> display_out_of_stock_products == '0' ) {
            //     $data[ 'category_products' ] = collect ( ( new CategoryService() ) -> category_products () ) -> filter ( function ( $categories ) {
            //         return $categories -> products -> filter ( function ( $product ) {
            //             return $product -> available_quantity () > 0;
            //         } );
            //     } ) -> take ( 4 );
               
            // }
            $data['category_products'] = collect((new CategoryService())->category_products())->map(function ($category) {
                if (optional(siteSettings()->settings)->display_out_of_stock_products == '0') {
                    // Filter out products with available_quantity() == 0
                    $category->products = $category->products->filter(function ($product) {
                        return $product->available_quantity() > 0;
                    })->take(4); // Limit to 4 products after filtering
                } else {
                    // Otherwise, take the first 4 products directly
                    $category->products = $category->products->take(4);
                }
                return $category;
            });
            
           
            
            $data[ 'newArrivals' ] = collect ( ( new ProductService() ) -> new_arrivals () ) -> take ( 10 );
            if ( optional ( siteSettings () -> settings ) -> display_out_of_stock_products == '0' ) {
                $data[ 'newArrivals' ] = collect ( ( new ProductService() ) -> new_arrivals () ) -> filter ( function ( $products ) {
                    return $products -> available_quantity () > 0;
                } ) -> take ( 10 );
            }
            
            $data[ 'bestSellers' ] = collect ( ( new ProductService() ) -> best_seller () ) -> take ( 10 );
            if ( optional ( siteSettings () -> settings ) -> display_out_of_stock_products == '0' ) {
                $data[ 'bestSellers' ] = collect ( ( new ProductService() ) -> best_seller () ) -> filter ( function ( $products ) {
                    return $products -> available_quantity () > 0;
                } ) -> take ( 10 );
            }
            
            $data[ 'populars' ] = collect ( ( new ProductService() ) -> populars () ) -> take ( 10 );
            if ( optional ( siteSettings () -> settings ) -> display_out_of_stock_products == '0' ) {
                $data[ 'populars' ] = collect ( ( new ProductService() ) -> populars () ) -> filter ( function ( $products ) {
                    return $products -> available_quantity () > 0;
                } ) -> take ( 10 );
            }
            
            $data[ 'featured' ] = collect ( ( new ProductService() ) -> featured () ) -> take ( 10 );
            if ( optional ( siteSettings () -> settings ) -> display_out_of_stock_products == '0' ) {
                $data[ 'featured' ] = collect ( ( new ProductService() ) -> featured () ) -> filter ( function ( $products ) {
                    return $products -> available_quantity () > 0;
                } ) -> take ( 10 );
            }
            
            $data[ 'banners' ]        = HomeSetting ::first ();
            $ip                       = request () -> ip ();
            $wishlist                 = Cache ::get ( "viewed_products{$ip}", [] );
            $data[ 'products' ]       = Product ::whereIn ( 'id', $wishlist ) -> Active () -> get ();
            $data[ 'top_categories' ] = collect ( ( new CategoryService() ) -> all () ) -> take ( 6 );
            return view ( 'index', $data );
        }
        
        public function getPhoneNumber()
        {
            
            $siteSettings = SiteSettings::first();
            $phoneNumber = optional($siteSettings->settings)->phone;
    // dd($phoneNumber);
            return response()->json([
                'phone_number' => $phoneNumber,
            ]);
        }
    }
