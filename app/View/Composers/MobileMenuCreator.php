<?php
    
    namespace App\View\Composers;
    
    use App\Services\CategoryService;
    use Illuminate\View\View;
    
    class MobileMenuCreator {
        
        public function compose(View $view): void
        {
            $categories = collect((new CategoryService())->all())->whereNull('parent_id');
            $menu = (new CategoryService())->generateMenu($categories);
            $mobilemenu = (new CategoryService())->generateMobileMenu($categories);
        
            // \Log::info($mobilemenu); // Log the output to check if it's being generated correctly
        
            $view->with('categories', $menu);
            $view->with('mobile_sidebar', view('partials._mobile-menu', compact('mobilemenu')));
        }
        
        
    }

    