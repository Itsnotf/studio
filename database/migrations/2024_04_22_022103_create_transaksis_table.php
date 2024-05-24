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
        Schema::create('transaksis', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('product_id')->constrained('products')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('paket_id')->constrained('pakets')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('mtd_pembayaran_id')->constrained('mtd_pembayarans')->cascadeOnDelete()->cascadeOnUpdate();
            $table->string('bukti_pembayaran')->nullable();
            $table->string('telpon');
            $table->enum('status', ['menunggu pembayaran', 'sedang diproses', 'selesai'])->default('menunggu pembayaran');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaksis');
    }
};
