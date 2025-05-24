<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('invoices', function (Blueprint $table) {
            $table->unsignedBigInteger('abonelik_id')->nullable()->after('id');
            // If you want to enforce the relationship:
            // $table->foreign('abonelik_id')->references('id')->on('aboneliks')->onDelete('cascade');
        });
    }
    
    public function down()
    {
        Schema::table('invoices', function (Blueprint $table) {
            $table->dropColumn('abonelik_id');
        });
    }
};
