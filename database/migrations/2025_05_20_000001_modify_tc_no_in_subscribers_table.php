<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('subscribers', function (Blueprint $table) {
            // Drop the existing unique constraint
            $table->dropUnique(['tc_no']);
            // Modify the column to allow NULL and add unique constraint back
            $table->string('tc_no')->nullable()->unique()->change();
        });
    }

    public function down()
    {
        Schema::table('subscribers', function (Blueprint $table) {
            // Drop the unique constraint
            $table->dropUnique(['tc_no']);
            // Add back the non-nullable unique constraint
            $table->string('tc_no')->unique()->change();
        });
    }
}; 