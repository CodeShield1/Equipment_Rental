<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('worker_equipment', function (Blueprint $table) {
            $table->id();
            // Change the foreign key to reference products instead of equipment
            $table->foreignId('worker_id')->constrained()->onDelete('cascade'); // Link to workers
            // Make sure the foreign key references the correct table and column
            $table->foreignId('product_id')->constrained('products')->onDelete('cascade'); // Link to products
            $table->timestamps();
        });
    }
    
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('worker_equipment');
    }
};
