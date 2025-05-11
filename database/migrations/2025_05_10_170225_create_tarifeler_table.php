<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tarifeler', function (Blueprint $table) {
            $table->id();
            $table->string('ad');
            $table->decimal('fiyat', 10, 2);
            $table->integer('internet_miktari');
            $table->integer('dakika_miktari');
            $table->integer('sms_miktari');
            $table->boolean('aktif')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tarifeler');
    }
};
