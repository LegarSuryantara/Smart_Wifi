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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('paket_id')->constrained()->onDelete('cascade');
            $table->integer('qty');

            // Data Midtrans
            $table->string('midtrans_order_id')->unique(); // ORDER-xxx
            $table->string('transaction_id')->nullable();  // dari Midtrans
            $table->string('payment_type')->nullable();    // bank_transfer, gopay, shopeepay, dll
            $table->string('transaction_status')->default('unpaid'); // settlement, pending, cancel, expire
            $table->string('fraud_status')->nullable();    // accept, challenge, deny
            $table->decimal('gross_amount', 12, 2)->nullable();

            // Extra info VA / e-wallet
            $table->string('va_bank')->nullable();
            $table->string('va_number')->nullable();
            $table->string('ewallet_type')->nullable();    // contoh: gopay/shopeepay
            $table->string('bill_key')->nullable();        // untuk indosat/mandiri
            $table->string('biller_code')->nullable();

            // Status aktivasi
            $table->enum('is_activated', ['yes', 'no'])->default('no');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
