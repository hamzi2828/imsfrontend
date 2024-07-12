<?php
    
    namespace App\Models;
    
    use Illuminate\Database\Eloquent\Factories\HasFactory;
    use Illuminate\Database\Eloquent\Model;
    use Illuminate\Database\Eloquent\Relations\BelongsTo;
    use Illuminate\Database\Eloquent\Relations\HasMany;
    
    class Category extends Model {
        use HasFactory;
        
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
