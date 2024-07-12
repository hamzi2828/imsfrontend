<?php
    
    namespace App\View\Composers;
    
    use App\Services\CategoryService;
    use Illuminate\View\View;
    
    class CategoryMenuCreator {
        
        public function compose ( View $view ): void {
            $categories = collect ( ( new CategoryService() ) -> all () ) -> whereNull ( 'parent_id' );
            $menu       = ( new CategoryService() ) -> generateMenu ( $categories );
            $view -> with ( 'categories', $menu );
            $view -> with ( 'categories_sidebar', view ( 'partials._menubar', compact ( 'menu' ) ) );
        }
        
    }