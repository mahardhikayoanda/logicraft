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
        Schema::create('properties', function (Blueprint $table) {
        $table->id();
        $table->string('name');
        $table->string('location');
        $table->decimal('price_per_night', 10, 2);
        $table->text('description')->nullable();
        $table->text('facilities')->nullable(); // Bisa nanti dipisah jadi tabel fasilitas
        $table->timestamps();
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('properties');
    }
};
