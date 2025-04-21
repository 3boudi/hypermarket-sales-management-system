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
        Schema::create('transfers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained('products','id')->cascadeOnDelete();
            $table->foreignId('from_supermarket')->constrained('supermarkets','id')->cascadeOnDelete();
            $table->foreignId('to_supermarket')->constrained('supermarkets','id')->cascadeOnDelete();
            $table->integer('quantity');
            $table->enum('status',['pending','in_transit','delevired']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transfers');
    }
};
