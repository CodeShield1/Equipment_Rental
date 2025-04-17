<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('workers', function (Blueprint $table) {
            // Add price_per_day column to workers table
            $table->decimal('price_per_day', 8, 2)->nullable()->after('status');
        });
    }

    public function down()
    {
        Schema::table('workers', function (Blueprint $table) {
            // Drop the price_per_day column if we need to rollback the migration
            $table->dropColumn('price_per_day');
        });
    }
};
