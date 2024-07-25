<?php
    
    use App\Services\SiteSettingService;
    use Illuminate\Support\Facades\Cache;
    
    function serverPath ( $param ): string {
        return 'https://backoffice.milimart.pk/' . $param;
    }
    
    // function serverPath ( $param ): string {
    //     return 'https://www.ims.bookmytrip.pk/' . $param;
    // }
    // function serverPath ( $param ): string {
    //     return 'https://backlink2.broadmax.shop/' . $param;
    // }

    function siteSettings () {
        return ( new SiteSettingService() ) -> get_settings_by_slug ( 'site-settings' );
    }
    
    function isWishList ( $productId ): bool {
        $ip       = request () -> ip ();
        $wishlist = Cache ::get ( "wishlist_{$ip}", [] );
        return in_array ( $productId, $wishlist );
    }
    
    function avgRating ( $product ): string {
        $ratings      = $product -> reviews -> sum ( 'rating' );
        $totalReviews = $product -> reviews -> count ();
        return $totalReviews > 0 ? ( ( $ratings / $totalReviews ) * 20 ) . '%' : '0%';
    }