<?php
    
    namespace App\Http\Controllers;
    
    use App\Models\Page;
    use Illuminate\Contracts\View\View;
    
    class PageController extends Controller {
        
        public function index ( Page $page ): View {
            $data[ 'title' ] = str () -> replace ( '-', ' ', ucwords ( $page -> page_name ) );
            $data[ 'page' ]  = $page;
            return view ( 'page', $data );
        }
    }
