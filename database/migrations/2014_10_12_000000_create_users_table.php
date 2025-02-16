<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id(); // Ini sama dengan `id` bigint unsigned not null auto_increment primary key
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps(); // Ini sudah mencakup `created_at` dan `updated_at`
            $table->boolean('is_admin')->default(false); // Kolom tambahan
            $table->id()->change();
        });
    }

    public function down()
    {
        Schema::dropIfExists('users');
    }
}