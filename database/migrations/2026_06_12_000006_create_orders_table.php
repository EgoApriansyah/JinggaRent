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
            $table->string('order_code')->unique(); // JR-YYYYMMDD-XXXX
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->foreignId('costume_id')->constrained('costumes')->cascadeOnDelete();
            $table->date('start_date');
            $table->date('end_date');
            $table->integer('rental_days');
            $table->decimal('price_per_day', 10, 2);
            $table->decimal('subtotal', 10, 2);
            $table->decimal('deposit_amount', 10, 2); // 50% subtotal
            $table->decimal('total_payment', 10, 2); // subtotal + deposit
            $table->enum('status', [
                'menunggu', 'dikonfirmasi', 'ditolak', 'dibayar', 'aktif', 'dikembalikan', 'selesai', 'dibatalkan'
            ])->default('menunggu');
            $table->text('admin_notes')->nullable();
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
