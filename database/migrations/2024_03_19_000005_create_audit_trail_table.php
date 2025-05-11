<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('audit_trail', function (Blueprint $table) {
            $table->id();
            $table->string('tablo_ad');
            $table->string('islem_turu');
            $table->string('degisen_alan');
            $table->text('eski_deger')->nullable();
            $table->text('yeni_deger')->nullable();
            $table->foreignId('kullanici_id')->constrained('users')->onDelete('cascade');
            $table->timestamp('degistirme_tarihi')->useCurrent();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('audit_trail');
    }
}; 