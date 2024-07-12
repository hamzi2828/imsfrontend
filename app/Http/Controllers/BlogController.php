<?php
    
    namespace App\Http\Controllers;
    
    use Illuminate\Contracts\View\View;
    use Illuminate\Http\Request;
    
    class BlogController extends Controller {
        
        public function index (): View {
            $title = 'Blog';
            return view ( 'blog.index', compact ( 'title' ) );
        }
        
        public function view ( string $slug ): View {
            $title = 'Blog';
            return view ( 'blog.view', compact ( 'title' ) );
        }
    }
