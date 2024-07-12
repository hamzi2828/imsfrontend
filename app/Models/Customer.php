<?php
    
    namespace App\Models;
    
    use Illuminate\Database\Eloquent\Factories\HasFactory;
    use Illuminate\Database\Eloquent\Model;
    use Illuminate\Database\Eloquent\SoftDeletes;
    use Illuminate\Notifications\Notifiable;
    
    class Customer extends Model {
        use HasFactory;
        use SoftDeletes;
        use Notifiable;
        
        protected $guarded = [];
    }
