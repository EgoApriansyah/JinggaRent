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
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->constrained('orders')->cascadeOnDelete();
            $table->string('midtrans_transaction_id')->nullable();
            $table->string('midtrans_order_id')->unique();
            $table->string('payment_type')->nullable();
            $table->decimal('gross_amount', 10, 2);
            $table->enum('status', ['pending', 'sukses', 'gagal', 'expired', 'refunded'])->default('pending');
            $table->string('snap_token')->nullable();
            $table->string('snap_url')->nullable();
            $table->json('midtrans_response')->nullable();
            $table->timestamp('paid_at')->nullable();
            $table->timestamp('expired_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
