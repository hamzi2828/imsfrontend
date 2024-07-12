<?php
    
    namespace App\Models;
    
    use Illuminate\Database\Eloquent\Factories\HasFactory;
    use Illuminate\Database\Eloquent\Model;
    use Illuminate\Database\Eloquent\Relations\HasMany;
    use Illuminate\Database\Eloquent\SoftDeletes;
    
    class Attribute extends Model {
        use HasFactory;
        
        public function terms (): HasMany {
            return $this -> hasMany ( Term::class );
        }
    }
