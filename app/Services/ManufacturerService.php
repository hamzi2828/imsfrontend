<?php
    
    namespace App\Services;
    
    use App\Models\Manufacturer;
    
    class ManufacturerService {
        
        public function all () {
            return Manufacturer ::latest () -> get ();
        }
    }