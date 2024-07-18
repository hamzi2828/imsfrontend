<?php
    
    namespace App\Http\Controllers;
    
    use App\Models\Product;
    use App\Models\ProductVariation;
    use App\Services\CategoryService;
    use App\Services\ManufacturerService;
    use App\Services\ProductService;
    use Illuminate\Contracts\View\View;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Cache;
    
    class ProductController extends Controller {
        
        public function index ( Request $request ): View {
            $title                = 'Shop';
            $products             = ( new ProductService() ) -> products ( $request );
            $categories           = ( new CategoryService() ) -> category_products ();
            $productPriceRange    = ( new ProductService() ) -> getPriceRange ();
            $productPriceRange    = ( new ProductService() ) -> displayPriceRanges ( $productPriceRange -> minPrice, $productPriceRange -> maxPrice );
            $manufacturers        = ( new ManufacturerService() ) -> all ();
            return view ( 'shop.index', compact ( 'title', 'products', 'categories', 'productPriceRange', 'manufacturers' ) );
        }
        
        public function show ( Product $product ): View {
            $product -> load ( [ 'product_images', 'product_variations.terms.attribute', 'product_variations.terms' ] );
            $title           = $product -> title ();
            $relatedProducts = ( new ProductService() ) -> get_related_products ( $product );
            $variations      = ( new ProductService() ) -> get_variations ( $product );
            $ip              = request () -> ip ();
            $wishlist        = Cache ::get ( "viewed_products{$ip}", [] );
            $productId       = $product -> id;
            
            if ( !in_array ( $productId, $wishlist ) ) {
                $wishlist[] = $productId;
                Cache ::put ( "viewed_products{$ip}", $wishlist, now () -> addDays ( 30 ) );
            }
            
            return view ( 'shop.view', compact ( 'title', 'product', 'relatedProducts', 'variations' ) );
        }
        
        public function quick_view ( Product $product ): View {
            $product -> load ( [ 'product_images', 'variations' ] );
            $title       = $product -> title ();
            $pVariations = ( new ProductService() ) -> get_variations ( $product );
            return view ( 'partials._quick-view', compact ( 'title', 'product', 'pVariations' ) );
        }
        
        public function get_variation ( Product $product, Request $request ) {
            $query = ProductVariation ::query ();
            $query -> where ( [ 'product_id' => $product -> id ] );
            
            foreach ( $request -> all () as $attributeName => $termId ) {
                $query -> whereHas ( 'terms', function ( $q ) use ( $termId ) {
                    $q -> where ( 'term_id', $termId );
                } );
            }
            
            $variation = $query -> first ();
            
            if ( $variation ) {
                return response () -> json ( [
                                                 'success'   => true,
                                                 'variation' => [
                                                     'sku'   => $variation -> sku,
                                                     'price' => $variation -> price,
                                                     'stock' => $variation -> stock,
                                                 ]
                                             ] );
            }
            
            return response () -> json ( [ 'success' => false ] );
        }
        
        public function add_to_wishlist ( Request $request, Product $product ) {
            $ip        = $request -> ip ();
            $wishlist  = Cache ::get ( "wishlist_{$ip}", [] );
            $productId = $product -> id;
            
            if ( !in_array ( $productId, $wishlist ) ) {
                $wishlist[] = $productId;
                Cache ::put ( "wishlist_{$ip}", $wishlist, now () -> addDays ( 30 ) );
            }
            
            return $product -> id;
        }
    }
