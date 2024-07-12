<?php
    
    namespace App\Models;
    
    use Illuminate\Database\Eloquent\Factories\HasFactory;
    use Illuminate\Database\Eloquent\Model;
    use Illuminate\Database\Eloquent\SoftDeletes;
    use Illuminate\Support\Carbon;
    use Illuminate\Support\Facades\DB;
    
    class Account extends Model {
        use HasFactory;
        use SoftDeletes;
        
        protected $guarded = [];
        protected $table   = 'account_heads';
    }
