<?php
    
    namespace App\Services;
    
    use App\Models\Account;
    use App\Models\Customer;
    use App\Models\CustomerProductPrice;
    use App\Services\GeneralService;
    use Illuminate\Support\Facades\DB;
    
    class CustomerService {
        
        public function save_account_head ( $request ): mixed {
            $account_head_id = config ( 'constants.customers' );
            $account_head    = Account ::findorFail ( $account_head_id );
            $name            = $request -> input ( 'full-name' );
            
            return Account ::create ( [
                                          'user_id'         => null,
                                          'account_head_id' => $account_head_id,
                                          'account_type_id' => $account_head -> account_type_id,
                                          'name'            => $name,
                                          'phone'           => $request -> input ( 'phone' ),
                                      ] );
        }
        
        public function save ( $request, $account_head_id ) {
            $name = $request -> input ( 'full-name' );
            return Customer ::create ( [
                                           'user_id'         => null,
                                           'account_head_id' => $account_head_id,
                                           'name'            => $name,
                                           'email'           => $request -> input ( 'email' ),
                                           'mobile'          => $request -> input ( 'phone' ),
                                           'phone'           => $request -> input ( 'phone' ),
                                           'address'         => $request -> input ( 'address' ),
                                       ] );
        }
    }