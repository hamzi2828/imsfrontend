<?php

    namespace App\Models;

    use Illuminate\Database\Eloquent\Factories\HasFactory;
    use Illuminate\Database\Eloquent\Model;
    use Illuminate\Database\Eloquent\Relations\BelongsTo;
    use Illuminate\Database\Eloquent\SoftDeletes;

    class ProductTerm extends Model {
        use HasFactory;

        protected $table   = 'product_terms';

        public function term (): BelongsTo {
            return $this -> belongsTo ( Term::class );
        }

        public function product (): BelongsTo {
            return $this -> belongsTo ( Product::class );
        }
    }
