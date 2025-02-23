<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
   // File: create_products_table.php
public function up()
{
    Schema::create('products', function (Blueprint $table) {
        $table->id(); // Ini akan membuat kolom `id` dengan tipe BIGINT dan PRIMARY KEY
        $table->string('name');
        $table->decimal('price', 10, 2);
        $table->text('description')->nullable();
        $table->string('image')->nullable(); 
        $table->timestamps();
    });

}

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product');
    }
};
