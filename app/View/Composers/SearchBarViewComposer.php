<?php
    
    namespace App\View\Composers;
    
    use App\Services\CategoryService;
    use App\Services\SiteSettingService;
    use Illuminate\View\View;
    
    class SearchBarViewComposer {
        
        public function compose ( View $view ): void {
            $settings   = ( new SiteSettingService() ) -> get_settings_by_slug ( 'site-settings' );
            $categories = collect ( ( new CategoryService() ) -> all () ) -> whereNull ( 'parent_id' );
            $view -> with ( 'categories', $categories );
            $view -> with ( 'settings', $settings );
            $view -> with ( '_searchbar', view ( 'partials.search-form', compact ( 'categories' ) ) );
        }
        
    }