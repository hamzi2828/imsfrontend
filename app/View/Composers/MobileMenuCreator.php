<?php
    
    namespace App\View\Composers;
    
    use App\Services\CategoryService;
    use Illuminate\View\View;
    
    class MobileMenuCreator {
        
        public function compose ( View $view ): void {
            $categories = collect ( ( new CategoryService() ) -> all () ) -> whereNull ( 'parent_id' );
            $menu       = ( new CategoryService() ) -> generateMenu ( $categories );
            $view -> with ( 'categories', $menu );
            $view -> with ( 'mobile_sidebar', view ( 'partials._mobile-menu', compact ( 'menu' ) ) );
        }
        
    }