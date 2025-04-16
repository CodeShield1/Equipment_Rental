<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;

    // Specify the table name (optional if it's the default "contacts")
    protected $table = 'contacts';

    // Define the fillable attributes for mass assignment
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'phone',
        'message',
    ];

    // If you want to customize the date formats (optional)
    protected $dates = ['created_at', 'updated_at'];
}
