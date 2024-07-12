<?php
    
    namespace App\Models;
    
    use App\Services\GeneralService;
    use Illuminate\Database\Eloquent\Factories\HasFactory;
    use Illuminate\Database\Eloquent\Model;
    use Illuminate\Database\Eloquent\Relations\BelongsTo;
    use Illuminate\Database\Eloquent\Relations\HasMany;
    use Illuminate\Database\Eloquent\SoftDeletes;
    use Illuminate\Support\Facades\DB;
    
    class Sale extends Model {
        use HasFactory;
        use SoftDeletes;
        
        protected $guarded = [];
        
        public function customer (): BelongsTo {
            return $this -> belongsTo ( Customer::class );
        }
        
        public function courier (): BelongsTo {
            return $this -> belongsTo ( Courier::class );
        }
        
        public function coupon (): BelongsTo {
            return $this -> belongsTo ( Coupon::class );
        }
        
        public function products (): HasMany {
            return $this -> hasMany ( SaleProducts::class );
        }
        
        public function createdAt (): string {
            return ( new GeneralService() ) -> date_formatter ( $this -> created_at );
        }
    }
