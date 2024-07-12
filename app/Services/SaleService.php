<?php
    
    namespace App\Services;
    
    use App\Models\Coupon;
    use App\Models\Customer;
    use App\Models\Product;
    use App\Models\ProductStock;
    use App\Models\Sale;
    use App\Models\SaleProducts;
    use App\Models\Stock;
    use Carbon\Carbon;
    use Gloudemans\Shoppingcart\Facades\Cart;
    use Illuminate\Support\Facades\DB;
    
    class SaleService {
        
        public function sale ( $request, $customer ): mixed {
            $total       = Cart ::initial ( 0, 0, '' );
            $net         = Cart ::subtotal ( 0, 0, '' );
            $boxes       = 1;
            $courier     = optional ( ( siteSettings () ) -> settings ) ?-> courier ?? null;
            $shipping    = optional ( ( siteSettings () ) -> settings ) ?-> shipping_charges ?? 0;
            $coupon_code = session () -> get ( 'coupon-code' );
            
            $info = array (
                'user_id'             => auth () -> user () -> id,
                'customer_id'         => $customer -> id,
                'sale_id'             => $this -> generateSaleId (),
                'courier_id'          => $courier,
                'total'               => $total,
                'flat_discount'       => 0,
                'percentage_discount' => 0,
                'shipping'            => $shipping,
                'net'                 => ( $net + $shipping ),
                'amount_added'        => 0,
                'customer_type'       => 'credit',
                'boxes'               => $boxes,
                'is_online'           => '1',
                'remarks'             => $request -> input ( 'order-notes' ),
            );
            
            if ( !empty( trim ( $coupon_code ) ) ) {
                $coupon                        = Coupon ::where ( [ 'code' => $coupon_code ] ) -> first ();
                $info[ 'coupon_id' ]           = $coupon -> id;
                $info[ 'percentage_discount' ] = $coupon -> discount;
            }
            
            return Sale ::create ( $info );
        }
        
        public function sale_products ( $request, $sale ): void {
            
            $sale_id  = $sale -> id;
            $items    = Cart ::content ();
            $discount = 0;
            
            if ( count ( $items ) > 0 ) {
                foreach ( $items as $item ) {
                    $product   = Product ::findorFail ( $item -> id );
                    $sale_qty  = $item -> qty;
                    $sale_unit = $item -> price;
                    $product -> load ( [ 'stocks' => function ( $query ) {
                        $query -> orderBy ( 'expiry_date', 'ASC' );
                        $query -> orderBy ( 'id', 'ASC' );
                    } ] );
                    
                    if ( count ( $product -> stocks ) > 0 ) {
                        foreach ( $product -> stocks as $stock ) {
                            if ( $sale_qty > 0 ) {
                                $available_qty = $stock -> available ();
                                if ( $available_qty > 0 ) {
                                    $sale[ 'sale_qty' ] = $available_qty >= $sale_qty ? $sale_qty : $available_qty;
                                    $sale_qty           -= $sale[ 'sale_qty' ];
                                    $sale_qty           = $sale_qty < 0 ? 0 : $sale_qty;
                                    
                                    $info = array (
                                        'sale_id'    => $sale_id,
                                        'product_id' => $product -> id,
                                        'stock_id'   => $stock -> id,
                                        'quantity'   => $sale[ 'sale_qty' ],
                                        'price'      => $sale_unit,
                                        'discount'   => $discount,
                                        'net_price'  => ( $sale[ 'sale_qty' ] * $sale_unit ),
                                    );
                                    SaleProducts ::create ( $info );
                                }
                            }
                        }
                    }
                }
            }
        }
        
        private function generateSaleId (): string {
            $date      = now () -> format ( 'Ymd' );
            $lastSale  = Sale ::latest () -> first ();
            $increment = $lastSale ? intval ( substr ( $lastSale -> sale_id, 9 ) ) + 1 : 1;
            return $date . sprintf ( '%04d', $increment );
        }
    }
