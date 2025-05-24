<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('devices', function (Blueprint $table) {
            $table->id();
            $table->string('ad');
            $table->string('marka');
            $table->string('model');
            $table->string('seri_no')->unique();
            $table->timestamp('satis_tarihi')->useCurrent();
            $table->decimal('fiyat', 10, 2);
            $table->string('durum');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('devices');
    }
}; 