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
        Schema::table('products', function (Blueprint $table) {
            $table->float('weight')->nullable();   // To store the weight of the product
            $table->string('fuel_type')->nullable(); // To store the fuel type of the product
            $table->string('brand')->nullable(); // To store the brand of the product
            $table->string('dimensions')->nullable(); // To store the dimensions of the product
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn('weight');
            $table->dropColumn('fuel_type');
            $table->dropColumn('brand');
            $table->dropColumn('dimensions');
        });
    }
};
