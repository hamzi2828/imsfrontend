<?php
    
    namespace App\Models;
    
    use Illuminate\Database\Eloquent\Factories\HasFactory;
    use Illuminate\Database\Eloquent\Model;
    use Illuminate\Database\Eloquent\Relations\BelongsTo;
    use Illuminate\Database\Eloquent\Relations\HasMany;
    use Illuminate\Database\Eloquent\SoftDeletes;
    
    class Category extends Model {
        use HasFactory , SoftDeletes;
        
        public function products (): HasMany {
            return $this -> hasMany ( Product::class );
        }
        
        public function parentCategory (): BelongsTo {
            return $this -> belongsTo ( Category::class, 'parent_id' );
        }
        
        public function subcategories (): HasMany {
            return $this -> hasMany ( Category::class, 'parent_id' );
        }
    }
