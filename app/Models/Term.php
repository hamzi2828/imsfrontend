<?php
    
    namespace App\Models;
    
    use Illuminate\Database\Eloquent\Factories\HasFactory;
    use Illuminate\Database\Eloquent\Model;
    use Illuminate\Database\Eloquent\Relations\BelongsTo;
    use Illuminate\Database\Eloquent\Relations\HasMany;
    use Illuminate\Database\Eloquent\SoftDeletes;
    
    class Term extends Model {
        use HasFactory;
        
        public function attribute (): BelongsTo {
            return $this -> belongsTo ( Attribute::class );
        }
        
        public function product_terms (): HasMany {
            return $this -> hasMany ( ProductTerm::class );
        }
        
    }
