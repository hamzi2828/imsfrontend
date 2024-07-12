<?php
    
    namespace App\Services;
    
    use App\Models\Category;
    use App\Models\Manufacturer;
    use App\Models\Product;
    use App\Models\ProductTerm;
    use Illuminate\Support\Facades\DB;
    
    class ProductService {
        
        public function sliderProducts () {
            return Product ::where ( [ 'slider_product' => '1' ] ) -> NotVariation () -> Active () -> get ();
        }
        
        public function deals () {
            return Product ::where ( [ 'deal_of_they_day' => '1' ] ) -> NotVariation () -> Active () -> get ();
        }
        
        public function best_seller () {
            return Product ::where ( [ 'best_seller' => '1' ] ) -> NotVariation () -> Active () -> get ();
        }
        
        public function new_arrivals () {
            return Product ::latest () -> NotVariation () -> Active () -> get ();
        }
        
        public function populars () {
            return Product ::where ( [ 'popular' => '1' ] ) -> NotVariation () -> Active () -> get ();
        }
        
        public function featured () {
            return Product ::where ( [ 'featured' => '1' ] ) -> NotVariation () -> Active () -> get ();
        }
        
        public function products ( $request ) {
            $perPage  = $request -> filled ( 'per-page' ) ? (int)$request -> input ( 'per-page' ) : 25;
            $products = Product ::query () -> NotVariation () -> Active ();
            
            if ( $request -> filled ( 'category' ) ) {
                $category = Category ::where ( [ 'slug' => $request -> input ( 'category' ) ] ) -> first ();
                if ( $category ) {
                    $childCategories = ( new CategoryService() ) -> getAllChildCategories ( $category -> id );
                    if ( count ( $childCategories ) > 0 )
                        $products -> whereIn ( 'category_id', $childCategories );
                }
            }
            
            if ( $request -> filled ( 'manufacturer' ) ) {
                $manufacturer = Manufacturer ::where ( [ 'slug' => $request -> input ( 'manufacturer' ) ] ) -> first ();
                if ( $manufacturer )
                    $products -> where ( [ 'manufacturer_id' => $manufacturer -> id ] );
            }
            
            if ( $request -> filled ( 'min-price' ) && $request -> filled ( 'max-price' ) ) {
                $minPrice = $request -> input ( 'min-price' );
                $maxPrice = $request -> input ( 'max-price' );
                $products -> whereBetween ( DB ::raw ( '(sale_box - (sale_box * (discount/100)))' ), [ $minPrice, $maxPrice ] );
            }
            
            if ( $request -> filled ( 'search' ) ) {
                $search = $request -> input ( 'search' );
                $products -> where ( 'title', 'LIKE', '%' . $search . '%' );
            }
            
            if ( $request -> filled ( 'orderBy' ) && in_array ( $request -> input ( 'orderBy' ), [ 'default', 'latest', 'asc', 'desc' ] ) ) {
                $orderBy = $request -> input ( 'orderBy' );
                
                if ( $orderBy === 'latest' )
                    $products -> orderBy ( 'id', 'DESC' );
                
                if ( $orderBy === 'asc' )
                    $products -> orderBy ( 'sale_box', 'ASC' );
                
                if ( $orderBy === 'desc' )
                    $products -> orderBy ( 'sale_box', 'DESC' );
            }
            
            return $products -> paginate ( $perPage );
        }
        
        public function displayPriceRanges ( $startingPrice, $endingPrice ): string {
            $numberOfChunks = 5;
            $stepSize       = ( $endingPrice - $startingPrice ) / $numberOfChunks;
            $formattedRange = null;
            $existingParams = request () -> query ();
            
            for ( $i = 0; $i < $numberOfChunks; $i++ ) {
                $minPrice       = $startingPrice + ( $i * $stepSize );
                $maxPrice       = $startingPrice + ( ( $i + 1 ) * $stepSize );
                $queryParams    = array_merge ( $existingParams, [ 'min-price' => $minPrice, 'max-price' => $maxPrice ] );
                $formattedRange .= '<li>';
                $formattedRange .= '<a href="' . route ( 'products.index', $queryParams ) . '">';
                $formattedRange .= number_format ( $minPrice, 2 ) . ' - ' . number_format ( $maxPrice, 2 );
                $formattedRange .= '</a>';
                $formattedRange .= '</li>';
            }
            return $formattedRange;
        }
        
        public function getPriceRange () {
            $range = Product ::select ( DB ::raw ( 'MIN(sale_unit) as minPrice' ), DB ::raw ( 'MAX(sale_unit) as maxPrice' ) );
            if ( request () -> filled ( 'category' ) ) {
                $category = Category ::where ( [ 'slug' => request ( 'category' ) ] ) -> first ();
                if ( $category ) {
                    $childCategories = ( new CategoryService() ) -> getAllChildCategories ( $category -> id );
                    if ( count ( $childCategories ) > 0 )
                        $range -> whereIn ( 'category_id', $childCategories );
                }
            }
            return $range -> first ();
        }
        
        public function get_related_products ( $product ) {
            return Product ::where ( [ 'category_id' => $product -> category_id ] )
                -> NotVariation ()
                -> whereNotIn ( 'id', [ $product -> id ] )
                -> limit ( 10 )
                -> get ();
        }
        
        public function get_variations ( $product ) {
            if ( !empty( trim ( $product -> parent_id ) ) )
                $product_id = $product -> parent_id;
            else
                $product_id = $product -> id;
            
            $products = Product ::where ( [ 'parent_id' => $product_id ] ) -> pluck ( 'id' ) -> toArray ();
            return ProductTerm ::selectRaw ( 'GROUP_CONCAT(term_id) as terms, attribute_id, GROUP_CONCAT(product_id) as products' )
                -> whereIn ( 'product_id', $products )
                -> groupBy ( 'attribute_id' )
                -> get ();
        }
    }
