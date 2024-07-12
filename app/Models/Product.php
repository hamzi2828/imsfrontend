<?php
    
    namespace App\Models;
    
    use Illuminate\Database\Eloquent\Factories\HasFactory;
    use Illuminate\Database\Eloquent\Model;
    use Illuminate\Database\Eloquent\Relations\BelongsTo;
    use Illuminate\Database\Eloquent\Relations\HasMany;
    use Illuminate\Database\Eloquent\Relations\HasOne;
    
    class Product extends Model {
        use HasFactory;
        
        public function title (): string {
            $title = '';
            
            $title .= $this -> title;
            
            if ( !empty( $this -> term -> term -> attribute ) )
                $title .= ' - ' . $this -> term -> term -> attribute -> title;
            
            if ( !empty( $this -> term ) )
                $title .= ' ' . $this -> term -> term -> title;
            
            return $title;
        }
        
        public function term (): HasOne {
            return $this -> hasOne ( ProductTerm::class );
        }
        
        public function getRouteKeyName (): string {
            return 'slug';
        }
        
        public function product_images (): HasMany {
            return $this -> hasMany ( ProductImage::class );
        }
        
        public function category (): BelongsTo {
            return $this -> belongsTo ( Category::class );
        }
        
        public function productPrice () {
            return $this -> hasMany ( ProductStock::class ) -> avg ( 'sale_box' );
        }
        
        public function productStocks (): HasMany {
            return $this -> hasMany ( ProductStock::class );
        }
        
        public function discountPrice () {
            $price    = $this -> productPrice ();
            $discount = $this -> discount;
            return $discount > 0 ? ( $price - ( $price * ( $discount / 100 ) ) ) : $price;
        }
        
        public function scopeNotVariation ( $query ) {
            return $query -> whereNull ( 'parent_id' );
        }
        
        public function scopeActive ( $query ) {
            return $query -> where ( [ 'status' => '1' ] );
        }
        
        public function variations (): HasMany {
            return $this -> hasMany ( Product::class, 'parent_id' );
        }
        
        public function available_quantity () {
            $stock               = $this -> stock_quantity ();
            $sold                = $this -> sold_quantity ();
            $issued              = $this -> issued_quantity ();
            $returned            = $this -> returned_quantity ();
            $adjustment_decrease = $this -> adjustment_decrease ();
            $damage_loss         = $this -> damage_loss ();
            
            return ( $stock - $sold - $issued - $returned - $adjustment_decrease - $damage_loss );
        }
        
        public function stock_quantity () {
            return $this -> hasMany ( ProductStock::class )
                -> whereIn ( 'stock_id', function ( $query ) {
                    $query -> select ( 'id' ) -> from ( 'stocks' ) -> whereNull ( 'deleted_at' );
                } )
                -> sum ( 'quantity' );
        }
        
        public function issued_quantity () {
            return $this -> hasMany ( IssuedProducts::class )
                -> whereIn ( 'issuance_id', function ( $query ) {
                    $query
                        -> select ( 'id' )
                        -> from ( 'issuance' )
                        -> where ( [ 'deleted_at' => null ] );
                } ) -> sum ( 'quantity' );
        }
        
        public function returned_quantity () {
            return $this -> hasMany ( StockReturnProduct::class )
                -> whereIn ( 'stock_return_id', function ( $query ) {
                    $query
                        -> select ( 'id' )
                        -> from ( 'stock_returns' )
                        -> where ( [ 'type' => 'vendor-return', 'deleted_at' => null ] );
                } ) -> sum ( 'quantity' );
        }
        
        public function adjustment_decrease () {
            return $this -> hasMany ( StockReturnProduct::class )
                -> whereIn ( 'stock_return_id', function ( $query ) {
                    $query
                        -> select ( 'id' )
                        -> from ( 'stock_returns' )
                        -> where ( [ 'type' => 'adjustment-decrease', 'deleted_at' => null ] );
                } ) -> sum ( 'quantity' );
        }
        
        public function damage_loss () {
            return $this -> hasMany ( StockReturnProduct::class )
                -> whereIn ( 'stock_return_id', function ( $query ) {
                    $query
                        -> select ( 'id' )
                        -> from ( 'stock_returns' )
                        -> where ( [ 'type' => 'damage-loss-stock', 'deleted_at' => null ] );
                } ) -> sum ( 'quantity' );
        }
        
        public function sold_quantity () {
            return $this -> hasMany ( SaleProducts::class )
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
        
        public function product_variations (): HasMany {
            return $this -> hasMany ( ProductVariation::class );
        }
        
        public function stocks (): HasMany {
            return $this -> hasMany ( ProductStock::class )
                -> whereIn ( 'stock_id', function ( $query ) {
                    $query -> select ( 'id' ) -> from ( 'stocks' ) -> where ( [ 'deleted_at' => null ] );
                } );
        }
        
        public function reviews (): HasMany {
            return $this -> hasMany ( ProductUserReview::class ) -> where ( [ 'active' => '1' ] ) -> latest ();
        }
    }
