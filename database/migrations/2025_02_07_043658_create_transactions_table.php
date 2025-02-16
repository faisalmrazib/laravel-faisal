<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionsTable extends Migration
{
    /**
     * Jalankan migrasi.
     */
    public function up(): void
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Relasi ke user
            $table->decimal('total_price', 12, 2); // Total harga (contoh: 1000000.00)
            $table->string('payment_status')->default('pending'); // Status pembayaran (pending/success/failed)
            $table->string('payment_method')->nullable(); // Metode pembayaran (bank transfer/credit card/dll)
            $table->string('transaction_code')->unique(); // Kode transaksi unik (contoh: TRX-123456)
            $table->timestamps(); // created_at dan updated_at
        });
    }

    /**
     * Batalkan migrasi.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions'); // Hapus tabel saat rollback
    }
}