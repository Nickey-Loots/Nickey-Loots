<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id(); // 👈 maakt een AUTO_INCREMENT PRIMARY KEY kolom 'id'
            $table->string('email', 255);
            $table->string('password', 255);
            $table->string('role', 20);
            $table->string('PRIMARY');
            $table->string('UNIQUE');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
