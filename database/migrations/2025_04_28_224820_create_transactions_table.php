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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('paket_id')->constrained()->onDelete('cascade');
            
            $table->date('tanggal_transaksi');
            $table->enum('metode_pembayaran', ['bank_transfer', 'e_wallet', 'qris', 'credit_card', 'gopay', 'shopeepay']);
            $table->integer('jumlah')->unsigned();
            $table->enum('status', ['pending', 'success', 'failed', 'expired', 'capture', 'settlement'])->default('pending');
            
            // Midtrans fields
            $table->string('order_id')->unique();
            $table->string('snap_token')->nullable();
            $table->json('payment_data')->nullable(); // Changed from text to json type for better handling
            $table->string('payment_type')->nullable();
            $table->string('bank')->nullable();
            $table->string('va_number')->nullable();
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
