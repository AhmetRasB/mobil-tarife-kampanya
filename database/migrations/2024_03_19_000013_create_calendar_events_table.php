<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('calendar_events', function (Blueprint $table) {
            $table->id();
            $table->string('ad');
            $table->text('detay')->nullable();
            $table->timestamp('baslangic_tarihi')->useCurrent();
            $table->timestamp('bitis_tarihi')->useCurrent();
            $table->string('renk')->nullable();
            $table->boolean('tekrar_eden')->default(false);
            $table->string('tekrar_tipi')->nullable();
            $table->boolean('aktif_mi')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('calendar_events');
    }
}; 