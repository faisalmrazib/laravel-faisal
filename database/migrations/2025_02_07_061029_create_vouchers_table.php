<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVouchersTable extends Migration
{
    /**
     * Jalankan migrasi.
     */
    // database/migrations/xxxx_xx_xx_create_vouchers_table.php

public function up()
{
    Schema::create('vouchers', function (Blueprint $table) {
        $table->id();
        $table->string('code')->unique();
        $table->decimal('discount', 8, 2); // Jumlah diskon
        $table->date('expires_at'); // Tanggal kedaluwarsa
        $table->timestamps();
    });
}

    /**
     * Batalkan migrasi.
     */
    public function down(): void
    {
        Schema::dropIfExists('vouchers'); // Hapus tabel saat rollback
    }
}