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
        
        // public function generateMenu ( $categories ): string {
        //     $html = '<li class="has-submenu">';
        //     if ( count ( $categories ) > 0 ) {
        //         foreach ( $categories as $category ) {
        //             $html .= '<li>';
        //             $html .= '<a href="' . route ( 'products.index', [ 'category' => $category -> slug ] ) . '">';
        //             $html .= '<i class="' . $category -> icon . '"></i>' . $category -> title;
        //             $html .= '</a>';
                    
        //             if ( count ( $category -> subcategories ) > 0 )
        //                 $html .= $this -> subMenu ( $category );
                    
        //             $html .= '</li>';
        //         }
        //     }
        //     return $html;
        // }
        
//         public function subMenu ( $category, $class = 'megamenu' ): string {
//             $html = '<ul class="' . $class . '">';
//             if ( count ( $category -> subcategories ) > 0 ) {
//                 foreach ( $category -> subcategories as $subCategory ) {
//                     $html .= '<li>';
                    
//                     $html .= '<a href="' . route ( 'products.index', [ 'category' => $category -> slug ] ) . '">';
//                     if ( !empty( trim ( $subCategory -> icon ) ) ) {
//                         $html .= '<i class="' . $subCategory -> icon . '"></i>';
//                     }
//                     $html .= $subCategory -> title;
//                     $html .= '</a>';
                    
//                     if ( count ( $subCategory -> subcategories ) > 0 ) {
//                         $html .= '<hr class="divider">';
//                         $html .= $this -> subMenu ( $subCategory, '' );
//                     }
                    
//                     $html .= '</li>';
//                 }

// //                if ( !empty( trim ( $category -> image ) ) ) {
// //                    $html .= '<li>';
// //                    $html .= '<div class="banner-fixed menu-banner menu-banner2">';
// //                    $html .= '<figure>';
// //                    $html .= '<img src="' . serverPath ( $category -> image ) . '" alt="Menu Banner" width="235" height="347">';
// //                    $html .= '</figure>';
// //                    $html .= '<div class="banner-content">';
// //                    $html .= '<div class="banner-price-info mb-1 ls-normal">';
// //                    $html .= 'Get up to';
// //                    $html .= '<strong class="text-primary text-uppercase">20%Off</strong>';
// //                    $html .= '</div>';
// //                    $html .= '<h3 class="banner-title ls-normal">Hot Sales</h3>';
// //                    $html .= '<a href="#" class="btn btn-dark btn-sm btn-link btn-slide-right btn-icon-right">';
// //                    $html .= 'Shop Now';
// //                    $html .= '<i class="w-icon-long-arrow-right"></i>';
// //                    $html .= '</a>';
// //                    $html .= '</div>';
// //                    $html .= '</div>';
// //                    $html .= '</li>';
// //                }
//             }
//             $html .= '</ul>';
            
//             return $html;
//         }
        



            // public function generateMenu($categories): string {
                
            //     $html = '<li class="has-submenu">';
            //     if (count($categories) > 0) {
            //         foreach ($categories as $category) {
            //             if ($category->trashed() || $category->status === 'inactive') {
            //                 continue; // Skip soft-deleted categories
            //             }
            //             $html .= '<li>';
            //             $html .= '<a href="' . route('products.index', ['category' => $category->slug]) . '">';
            //             $html .= '<i class="' . $category->icon . '"></i>' . $category->title;
            //             $html .= '</a>';

            //             if (count($category->subcategories) > 0) {
            //                 $html .= $this->subMenu($category);
            //             }

            //             $html .= '</li>';
            //         }
            //     }
            //     return $html;
            // }


            // public function subMenu($category, $class = 'megamenu'): string {
                
            //     $html = '<ul class="' . $class . '">';
            //     if (count($category->subcategories) > 0) {
            //         foreach ($category->subcategories as $subCategory) {
            //             if ($subCategory->trashed() || $category->status === 'inactive') {
            //                 continue; // Skip soft-deleted subcategories
            //             }
            //             $html .= '<li>';

            //             $html .= '<a href="' . route('products.index', ['category' => $subCategory->slug]) . '">';
            //             if (!empty(trim($subCategory->icon))) {
            //                 $html .= '<i class="' . $subCategory->icon . '"></i>';
            //             }
            //             $html .= $subCategory->title;
            //             $html .= '</a>';

            //             if (count($subCategory->subcategories) > 0) {
            //                 $html .= '<hr class="divider">';
            //                 $html .= $this->subMenu($subCategory, '');
            //             }

            //             $html .= '</li>';
            //         }
            //     }
            //     $html .= '</ul>';

            //     return $html;
            // }

                    
                public function generateMenu($categories): string {
                    $html = '<li class="has-submenu">';
                    $count = 0;

                    if (count($categories) > 0) {
                    foreach ($categories as $category) {
                        if ($category->trashed() || $category->status === 'inactive') {
                            continue; // Skip soft-deleted categories
                        }

                        if ($count >= 11) {
                            break; // Stop after 12 iterations
                        }

                        $html .= '<li class=" d-flex align-items-center justify-content-between">';
                        $html .= '<a class="w-100" href="' . route('products.index', ['category' => $category->slug]) . '">';
                        $html .= '<i class="' . $category->icon . '"></i>' . $category->title;
                     
                        $html .= '</a>';
                        
                        if (count($category->subcategories) > 0) {
                            $html .= '<i class="w-icon-angle-right  fs-5 "></i>'; 
                        }

                        if (count($category->subcategories) > 0) {
                            $html .= $this->subMenu($category);
                        }

                        $html .= '</li>';

                        $count++;
                    }
                    }

                    return $html;
                }


                public function subMenu($category, $class = 'megamenu'): string {
                    // Skip inactive categories at the top level
                    if ($category->status === 'inactive') {
                        return ''; // Return an empty string if the category is inactive
                    }
                
                    $html = '<ul class="' . $class . '">';
                    if (count($category->subcategories) > 0) {
                        foreach ($category->subcategories as $subCategory) {
                            // Skip soft-deleted or inactive subcategories
                            if ($subCategory->trashed() || $subCategory->status === 'inactive') {
                                continue;
                            }
                            $html .= '<li>';
                
                            $html .= '<a href="' . route('products.index', ['category' => $subCategory->slug]) . '">';
                            if (!empty(trim($subCategory->icon))) {
                                $html .= '<i class="' . $subCategory->icon . '"></i>';
                            }
                            $html .= $subCategory->title;
                            $html .= '</a>';
                
                            if (count($subCategory->subcategories) > 0) {
                                $html .= '<hr class="divider">';
                                $html .= $this->subMenu($subCategory, '');
                            }
                
                            $html .= '</li>';
                        }
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
        public function generateMobileMenu($categories): string {

            
            $html = '<ul class="mobile-menu">'; // Start with an unordered list
            
            $count = 0;
        
            foreach ($categories as $category) {
                if ($category->trashed() || $category->status === 'inactive') {
                    continue; // Skip soft-deleted or inactive categories
                }
        
                if ($count >= 12) {
                    break; // Limit to 12 top-level categories
                }
        
                $hasSubcategories = $category->subcategories->count() > 0;
                $html .= '<li class="' . ($hasSubcategories ? 'has-submenu' : '') . '">';
                $html .= '<a href="' . route('products.index', ['category' => $category->slug]) . '">';
                $html .= '<i class="' . $category->icon . '"></i>' . $category->title;
                if ($hasSubcategories) {
                    $html .= '<span class="submenu-arrow"></span>'; // Add arrow for categories with subcategories
                }
                $html .= '</a>';
        
                if ($hasSubcategories) {
                    $html .= $this->subMobileMenu($category->subcategories); // Render subcategories
                }
        
                $html .= '</li>';
        
                $count++;
            }
        
            $html .= '</ul>'; // Close the unordered list
            return $html;
        }
        
        // Method to generate submenus recursively for mobile menu
        private function subMobileMenu($subcategories): string {
            $html = '<ul>'; // Start with an unordered list for subcategories
        
            foreach ($subcategories as $subcategory) {
                if ($subcategory->trashed() || $subcategory->status === 'inactive') {
                    continue; // Skip soft-deleted or inactive subcategories
                }
        
                $hasSubcategories = $subcategory->subcategories->count() > 0;
                $html .= '<li class="' . ($hasSubcategories ? 'has-submenu' : '') . '">';
                $html .= '<a href="' . route('products.index', ['category' => $subcategory->slug]) . '">';
                $html .= $subcategory->title;
                if ($hasSubcategories) {
                    $html .= '<span class="submenu-arrow"></span>'; // Add arrow for subcategories with children
                }
                $html .= '</a>';
        
                if ($hasSubcategories) {
                    $html .= $this->subMobileMenu($subcategory->subcategories); // Render nested subcategories
                }
        
                $html .= '</li>';
            }
        
            $html .= '</ul>'; // Close the unordered list
            return $html;
        }
        
        


    }



    