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
{
    Schema::create('cart', function (Blueprint $table) {
        $table->id();
        $table->string('user_id', 20);
        $table->string('product_id', 20);
        $table->string('price', 10);
        $table->string('qty', 2)->default('1');
        $table->timestamps();
    });
}

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cart');
    }
};
