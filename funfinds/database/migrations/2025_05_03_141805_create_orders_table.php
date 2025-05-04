<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('user_id', 20);
            $table->string('name', 50);
            $table->string('email', 50);
            $table->string('number', 10);
            $table->string('address', 200);
            $table->string('product_id', 20);
            $table->string('price', 10);
            $table->string('qty', 2);
            $table->timestamp('date');
            $table->string('status', 50);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
