<?php
    
    namespace App\Services;
    
    use App\Models\Category;
    use App\Models\Page;
    use App\Services\GeneralService;
    
    class PageService {
        
        public function all () {
            return Page ::get ();
        }
    }