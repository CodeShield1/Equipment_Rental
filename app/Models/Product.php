<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'category_id',
        'name',
        'description',
        'price_per_day',
        'image',
        'weight', // New field
        'fuel_type', // New field
        'brand', // New field
        'dimensions', // New field
        'quantity_available',
        'city',
        'featured'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function rentals()
    {
        return $this->hasMany(Rental::class);
    }

    public function workers()
    {
        return $this->belongsToMany(Worker::class, 'worker_equipment');
    }

}
