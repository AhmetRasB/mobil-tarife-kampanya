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
        Schema::create('kampanyalar', function (Blueprint $table) {
            $table->id();
            $table->string('ad');
            $table->text('aciklama');
            $table->date('baslangic_tarihi');
            $table->date('bitis_tarihi');
            $table->integer('indirim_orani');
            $table->boolean('aktif')->default(true);
            $table->timestamps();
        });

        Schema::create('kampanya_tarife', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kampanya_id')->constrained('kampanyalar')->onDelete('cascade');
            $table->foreignId('tarife_id')->constrained('tarifeler')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kampanya_tarife');
        Schema::dropIfExists('kampanyalar');
    }
};
