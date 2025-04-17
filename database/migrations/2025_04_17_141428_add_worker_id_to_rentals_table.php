<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('rentals', function (Blueprint $table) {
            $table->unsignedBigInteger('worker_id'); // Add the user_id column
            $table->foreign('worker_id')->references('id')->on('users')->onDelete('cascade'); // Add foreign key constraint
        });
    }
    
    public function down()
    {
        Schema::table('rentals', function (Blueprint $table) {
            $table->dropForeign(['worker_id']);
            $table->dropColumn('worker_id');
        });
    }
};
