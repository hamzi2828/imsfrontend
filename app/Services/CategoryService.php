<?php
    
    namespace App\Services;
    
    use App\Models\Category;
    use Illuminate\Database\Eloquent\Collection;
    
    class CategoryService {
        
        public function all (): Collection {
            return Category ::all ();
        }
        
        public function category_products (): Collection | array {
            return Category ::with ( [ 'products' => function ( $query ) {
                $query -> NotVariation ();
                $query -> Active ();
                $query -> limit ( 8 );
            } ] ) -> get ();
        }
        
        public function generateMenu ( $categories ): string {
            $html = '<li class="has-submenu">';
            if ( count ( $categories ) > 0 ) {
                foreach ( $categories as $category ) {
                    $html .= '<li>';
                    $html .= '<a href="' . route ( 'products.index', [ 'category' => $category -> slug ] ) . '">';
                    $html .= '<i class="' . $category -> icon . '"></i>' . $category -> title;
                    $html .= '</a>';
                    
                    if ( count ( $category -> subcategories ) > 0 )
                        $html .= $this -> subMenu ( $category );
                    
                    $html .= '</li>';
                }
            }
            return $html;
        }
        
        public function subMenu ( $category, $class = 'megamenu' ): string {
            $html = '<ul class="' . $class . '">';
            if ( count ( $category -> subcategories ) > 0 ) {
                foreach ( $category -> subcategories as $subCategory ) {
                    $html .= '<li>';
                    
                    $html .= '<a href="' . route ( 'products.index', [ 'category' => $category -> slug ] ) . '">';
                    if ( !empty( trim ( $subCategory -> icon ) ) ) {
                        $html .= '<i class="' . $subCategory -> icon . '"></i>';
                    }
                    $html .= $subCategory -> title;
                    $html .= '</a>';
                    
                    if ( count ( $subCategory -> subcategories ) > 0 ) {
                        $html .= '<hr class="divider">';
                        $html .= $this -> subMenu ( $subCategory, '' );
                    }
                    
                    $html .= '</li>';
                }

//                if ( !empty( trim ( $category -> image ) ) ) {
//                    $html .= '<li>';
//                    $html .= '<div class="banner-fixed menu-banner menu-banner2">';
//                    $html .= '<figure>';
//                    $html .= '<img src="' . serverPath ( $category -> image ) . '" alt="Menu Banner" width="235" height="347">';
//                    $html .= '</figure>';
//                    $html .= '<div class="banner-content">';
//                    $html .= '<div class="banner-price-info mb-1 ls-normal">';
//                    $html .= 'Get up to';
//                    $html .= '<strong class="text-primary text-uppercase">20%Off</strong>';
//                    $html .= '</div>';
//                    $html .= '<h3 class="banner-title ls-normal">Hot Sales</h3>';
//                    $html .= '<a href="#" class="btn btn-dark btn-sm btn-link btn-slide-right btn-icon-right">';
//                    $html .= 'Shop Now';
//                    $html .= '<i class="w-icon-long-arrow-right"></i>';
//                    $html .= '</a>';
//                    $html .= '</div>';
//                    $html .= '</div>';
//                    $html .= '</li>';
//                }
            }
            $html .= '</ul>';
            
            return $html;
        }
        
        public function getAllChildCategories ( $categoryId ): array {
            $childCategories      = $this -> getChildCategories ( $categoryId );
            $allChildCategories   = [];
            $allChildCategories[] = $categoryId;
            $this -> recursiveChildCategories ( $childCategories, $allChildCategories );
            return $allChildCategories;
        }
        
        private function getChildCategories ( $categoryId ) {
            return Category ::where ( 'parent_id', $categoryId ) -> get ();
        }
        
        private function recursiveChildCategories ( $categories, &$result ): void {
            foreach ( $categories as $category ) {
                $result[]        = $category -> id;
                $childCategories = $this -> getChildCategories ( $category -> id );
                if ( $childCategories -> isNotEmpty () ) {
                    $this -> recursiveChildCategories ( $childCategories, $result );
                }
            }
        }
    }