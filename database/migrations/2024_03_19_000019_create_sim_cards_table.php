<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('sim_cards', function (Blueprint $table) {
            $table->id();
            $table->string('numara')->unique();
            $table->string('puk');
            $table->string('pin');
            $table->timestamp('aktivasyon_tarihi')->useCurrent();
            $table->string('durum');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('sim_cards');
    }
}; 