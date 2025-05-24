<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('subscriptions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('abone_id')->constrained('subscribers')->onDelete('cascade');
            $table->string('tarife_adi');
            $table->decimal('aylik_ucret', 10, 2);
            $table->timestamp('baslangic_tarihi')->useCurrent();
            $table->timestamp('bitis_tarihi')->nullable();
            $table->boolean('aktif_mi')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('subscriptions');
    }
}; 