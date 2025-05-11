<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('stock_movements', function (Blueprint $table) {
            $table->id();
            $table->string('urun_tipi');
            $table->string('urun_id');
            $table->string('islem_tipi');
            $table->integer('miktar');
            $table->timestamp('islem_tarihi')->useCurrent();
            $table->string('aciklama')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('stock_movements');
    }
}; 