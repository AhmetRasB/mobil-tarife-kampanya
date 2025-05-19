<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('abonelikler', function (Blueprint $table) {
            $table->foreignId('subscriber_id')->nullable()->constrained('subscribers')->after('user_id');
        });
    }

    public function down()
    {
        Schema::table('abonelikler', function (Blueprint $table) {
            $table->dropForeign(['subscriber_id']);
            $table->dropColumn('subscriber_id');
        });
    }
}; 