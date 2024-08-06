<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Newsletter extends Model
{
    use HasFactory;
 
    // Define the table name if it's not the plural form of the model
    protected $table = 'newsletters';

    // Define the fillable attributes to allow mass assignment
    protected $fillable = [
        'email',
        'auth',
        'ip',
    ];

    // If you want to cast attributes to a specific type, you can do so
    protected $casts = [
        'auth' => 'boolean',
    ];

}
