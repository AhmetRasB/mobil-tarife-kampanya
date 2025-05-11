<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tele_services', function (Blueprint $table) {
            $table->id();
            $table->string('ad');
            $table->text('detay')->nullable();
            $table->string('durum');
            $table->timestamp('baslangic_tarihi')->useCurrent();
            $table->timestamp('bitis_tarihi')->nullable();
            $table->boolean('aktif_mi')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tele_services');
    }
}; 