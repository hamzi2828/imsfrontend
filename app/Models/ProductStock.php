<?php
    
    namespace App\Models;
    
    use Illuminate\Database\Eloquent\Factories\HasFactory;
    use Illuminate\Database\Eloquent\Model;
    use Illuminate\Database\Eloquent\Relations\BelongsTo;
    use Illuminate\Database\Eloquent\SoftDeletes;
    
    class ProductStock extends Model {
        use SoftDeletes;
        
        protected $guarded = [];
        protected $table   = 'product_stock';
        
        public function product (): BelongsTo {
            return $this -> belongsTo ( Product::class );
        }
        
        public function available () {
            $quantity    = $this -> quantity;
            $sold        = $this -> sold_quantity ();
            $returned    = $this -> returned_quantity ();
            $damage_loss = $this -> damage_loss ();
            return ( $quantity - $sold - $returned - $damage_loss );
        }
        
        public function damage_loss () {
            return $this -> hasMany ( StockReturnProduct::class, 'stock_id' )
                -> whereIn ( 'stock_return_id', function ( $query ) {
                    $query
                        -> select ( 'id' )
                        -> from ( 'stock_returns' )
                        -> where ( [
                                       'type'       => 'damage-loss-stock',
                                       'deleted_at' => null
                                   ] );
                } ) -> sum ( 'quantity' );
        }
        
        public function sold_quantity () {
            return $this -> hasMany ( SaleProducts::class, 'stock_id' )
                -> whereIn ( 'sale_id', function ( $query ) {
                    $query
                        -> select ( 'id' )
                        -> from ( 'sales' )
                        -> where ( [
                                       'sale_closed' => '1',
                                       'refunded'    => '0',
                                       'deleted_at'  => null
                                   ] );
                } ) -> sum ( 'quantity' );
        }
        
        public function returned_quantity () {
            return $this -> hasMany ( StockReturnProduct::class, 'stock_id' )
                -> whereIn ( 'stock_return_id', function ( $query ) {
                    $query
                        -> select ( 'id' )
                        -> from ( 'stock_returns' )
                        -> where ( [ 'type' => 'vendor-return' ] )
                        -> where ( [
                                       'deleted_at' => null
                                   ] );
                } ) -> sum ( 'quantity' );
        }
        
    }
