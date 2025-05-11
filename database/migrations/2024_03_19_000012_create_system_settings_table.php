<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('system_settings', function (Blueprint $table) {
            $table->id();
            $table->string('parametre_adi')->unique();
            $table->text('deger');
            $table->timestamp('olusturma_tarihi')->useCurrent();
            $table->timestamp('guncelleme_tarihi')->useCurrentOnUpdate()->useCurrent();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('system_settings');
    }
}; 