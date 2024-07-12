<?php
    
    namespace App\Providers;
    
    use App\Services\CategoryService;
    use App\View\Composers\CategoryMenuCreator;
    use App\View\Composers\MobileMenuCreator;
    use App\View\Composers\SearchBarViewComposer;
    use Illuminate\Support\ServiceProvider;
    use Illuminate\Support\Facades\View;
    
    class AppServiceProvider extends ServiceProvider {
        
        public function register (): void {
            //
        }
        
        public function boot (): void {
            View ::composer ( [ 'partials._topbar' ], CategoryMenuCreator::class );
            View ::composer ( [ 'components.home' ], MobileMenuCreator::class );
            View ::composer ( [ 'partials._searchbar' ], SearchBarViewComposer::class );
        }
    }
