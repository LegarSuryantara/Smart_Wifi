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
            $table->string('midtrans_order_id')->unique();
            $table->foreignId('paket_id')->constrained('pakets')->onDelete('cascade'); // relasi ke tabel pakets
            $table->string('name');
            $table->text('address');
            $table->string('phone');
            $table->string('qty');
            $table->bigInteger('total_price');
            $table->enum('status', ['Unpaid', 'Paid'])->default('Unpaid');
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
