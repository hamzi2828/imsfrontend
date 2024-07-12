<?php
    
    namespace App\Services;
    
    use App\Models\User;
    
    class GeneralService {
        
        public function date_formatter ( $date ): string {
            return date ( 'd-m-Y H:i A', strtotime ( $date ) );
        }
        
        public function only_date_formatter ( $date ): string {
            return date ( 'd-m-Y', strtotime ( $date ) );
        }
    }