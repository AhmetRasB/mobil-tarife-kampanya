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
        Schema::create('abonelikler', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('set null');
            $table->string('musteri_adi');
            $table->string('telefon');
            $table->string('email');
            $table->foreignId('tarife_id')->constrained('tarifeler');
            $table->foreignId('kampanya_id')->nullable()->constrained('kampanyalar');
            $table->dateTime('baslangic_tarihi');
            $table->dateTime('bitis_tarihi')->nullable();
            $table->boolean('aktif')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('abonelikler');
    }
};
