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
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('title');
            $table->text('description')->nullable();
            $table->string('address', 500);
            $table->string('city', 100);
            $table->string('state', 100)->nullable();
            $table->string('postal_code', 20)->nullable();
            $table->string('type'); // house, apartment, villa, etc.
            $table->string('status'); // available, rented, sold, etc.
            $table->string('rental_status'); // for_rent, for_sale, both, etc.
            $table->integer('bedrooms')->nullable();
            $table->integer('bathrooms')->nullable();
            $table->decimal('area', 10, 2)->nullable(); // dalam meter persegi
            $table->decimal('lot_size', 10, 2)->nullable(); // ukuran tanah
            $table->integer('year_built')->nullable();
            $table->decimal('monthly_rent', 12, 2)->nullable();
            $table->decimal('estimated_value', 15, 2)->nullable();
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