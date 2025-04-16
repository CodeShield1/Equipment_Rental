<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

// Run: php artisan make:model Worker
// Worker Model
class Worker extends Model
{
    protected $fillable = ['name', 'phone', 'email', 'image', 'status'];

    // Worker can work with many products
    public function products()
    {
        return $this->belongsToMany(Product::class, 'worker_equipment');
    }
}
