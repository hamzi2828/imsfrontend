<?php
    
    namespace App\Services;
    
    use App\Models\SiteSettings;
    use Illuminate\Support\Facades\File;
    use Ramsey\Uuid\Uuid;
    
    class SiteSettingService {
        
        /**
         * --------------
         * @param $slug
         * @return mixed
         * fetch settings by slug
         * --------------
         */
        
        public function get_settings_by_slug ( $slug ) {
            return SiteSettings ::where ( [ 'slug' => $slug ] ) -> first ();
        }
        
        /**
         * --------------
         * @param $request
         * @return void
         * save site settings
         * --------------
         */
        
        public function save ( $request ) {
            
            $settings = SiteSettings ::where ( [ 'slug' => 'site-settings' ] ) -> first ();
            
            $info = [
                'slug'     => 'site-settings',
                'settings' => json_encode ( [
                                                'title'              => $request -> input ( 'title' ),
                                                'email'              => $request -> input ( 'email' ),
                                                'phone'              => $request -> input ( 'phone' ),
                                                'address'            => $request -> input ( 'address' ),
                                                'display_on_pdf'     => $request -> input ( 'display_on_pdf' ),
                                                'e_commerce'         => $request -> input ( 'e_commerce' ),
                                                'pdf_footer_content' => $request -> input ( 'pdf-footer-content' ),
                                                'logo'               => $this -> upload_image ( $request, $settings ),
                                            ] )
            ];
            
            if ( !empty( $settings ) )
                $settings -> update ( $info );
            else {
                $info[ 'license_key' ] = Uuid ::uuid4 () -> toString ();
                SiteSettings ::create ( $info );
            }
        }
        
        /**
         * --------------
         * @param $request
         * @return mixed|void
         * upload image
         * --------------
         */
        
        private function upload_image ( $request, $settings ) {
            $savePath = './uploads/site-settings/logo';
            
            File ::ensureDirectoryExists ( $savePath, 0755, true );
            
            if ( $request -> hasFile ( 'logo' ) ) {
                $filenameWithExt = $request -> file ( 'logo' ) -> getClientOriginalName ();
                $filename        = pathinfo ( $filenameWithExt, PATHINFO_FILENAME );
                $extension       = $request -> file ( 'logo' ) -> getClientOriginalExtension ();
                $fileNameToStore = $filename . '-' . time () . '.' . $extension;
                return $request -> file ( 'logo' ) -> storeAs ( $savePath, $fileNameToStore );
            }
            
            if ( !empty( $settings ) )
                return $settings -> settings -> logo;
            
        }
    }