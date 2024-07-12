<?php
    
    namespace App\Services;
    
    use App\Models\Country;
    use App\Models\User;
    use Carbon\Carbon;
    use Illuminate\Support\Facades\Hash;
    
    class UserService {
        
        public function save ( $customer, $password ) {
            $country = Country ::where ( [ 'slug' => 'pakistan' ] ) -> first ();
            return User ::create ( [
                                       'country_id' => $country -> id,
                                       'branch_id'  => '1',
                                       'name'       => $customer -> name,
                                       'email'      => $customer -> email,
                                       'password'   => Hash ::make ( $password ),
                                       'mobile'     => $customer -> mobile,
                                       'type'       => 'frontend',
                                       'gender'     => '1',
                                       'address'    => $customer -> address,
                                   ] );
        }
        
        public function edit ( $request, $user ): void {
            $user -> name    = $request -> input ( 'name' );
            $user -> email   = $request -> input ( 'email' );
            $user -> dob     = Carbon ::createFromFormat ( 'Y-m-d', $request -> input ( 'dob' ) );
            $user -> address = $request -> input ( 'address' );
            
            if ( $request -> has ( 'password' ) and !empty( trim ( $request -> input ( 'password' ) ) ) )
                $user -> password = Hash ::make ( $request -> input ( 'password' ) );
            
            $user -> update ();
        }
    }
