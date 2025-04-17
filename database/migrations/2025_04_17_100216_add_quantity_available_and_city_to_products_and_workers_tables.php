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
        // Adding the quantity_available field to the products table
        Schema::table('products', function (Blueprint $table) {
            $table->integer('quantity_available')->default(0);
            $table->string('city')->nullable();
        });

        // Adding the city field to the workers table
        Schema::table('workers', function (Blueprint $table) {
            $table->string('city')->nullable();
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
            $table->dropColumn('quantity_available');
            $table->dropColumn('available');
            $table->dropColumn('city');
        });

        Schema::table('workers', function (Blueprint $table) {
            $table->dropColumn('city');
        });
    }
};
