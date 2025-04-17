<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rental extends Model
{
    use HasFactory;

    // Add user_id to the fillable property
    protected $fillable = [
        'user_id',
        'product_id',
        'start_date',
        'end_date',
        'location',
        'worker_id',
        'status',
    ];

    // Relationship to the user
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relationship to the product
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    // Relationship to the worker
    public function worker()
    {
        return $this->belongsTo(Worker::class);
    }
}
