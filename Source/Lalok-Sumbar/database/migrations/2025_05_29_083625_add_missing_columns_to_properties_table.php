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
        Schema::table('properties', function (Blueprint $table) {
            // Cek dan tambahkan kolom yang belum ada
            if (!Schema::hasColumn('properties', 'name')) {
                $table->string('name')->after('id');
            }
            
            if (!Schema::hasColumn('properties', 'type')) {
                $table->string('type')->after('name');
            }
            
            if (!Schema::hasColumn('properties', 'description')) {
                $table->text('description')->nullable()->after('type');
            }
            
            if (!Schema::hasColumn('properties', 'address')) {
                $table->string('address', 500)->after('description');
            }
            
            if (!Schema::hasColumn('properties', 'city')) {
                $table->string('city', 100)->after('address');
            }
            
            if (!Schema::hasColumn('properties', 'state')) {
                $table->string('state', 100)->nullable()->after('city');
            }
            
            if (!Schema::hasColumn('properties', 'postal_code')) {
                $table->string('postal_code', 20)->nullable()->after('state');
            }
            
            if (!Schema::hasColumn('properties', 'bedrooms')) {
                $table->integer('bedrooms')->nullable()->after('postal_code');
            }
            
            if (!Schema::hasColumn('properties', 'bathrooms')) {
                $table->integer('bathrooms')->nullable()->after('bedrooms');
            }
            
            if (!Schema::hasColumn('properties', 'area')) {
                $table->decimal('area', 10, 2)->nullable()->after('bathrooms');
            }
            
            if (!Schema::hasColumn('properties', 'year_built')) {
                $table->integer('year_built')->nullable()->after('area');
            }
            
            if (!Schema::hasColumn('properties', 'status')) {
                $table->string('status')->after('year_built');
            }
            
            if (!Schema::hasColumn('properties', 'rental_status')) {
                $table->string('rental_status')->after('status');
            }
            
            if (!Schema::hasColumn('properties', 'monthly_rent')) {
                $table->decimal('monthly_rent', 12, 2)->nullable()->after('rental_status');
            }
            
            if (!Schema::hasColumn('properties', 'estimated_value')) {
                $table->decimal('estimated_value', 15, 2)->nullable()->after('monthly_rent');
            }
            
            // Tambahkan user_id jika belum ada (foreign key ke users)
            if (!Schema::hasColumn('properties', 'user_id')) {
                $table->foreignId('user_id')->nullable()->constrained()->onDelete('cascade')->after('estimated_value');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('properties', function (Blueprint $table) {
            $columns = [
                'name', 'type', 'description', 'address', 'city', 'state', 
                'postal_code', 'bedrooms', 'bathrooms', 'area', 'year_built', 
                'status', 'rental_status', 'monthly_rent', 'estimated_value', 'user_id'
            ];
            
            foreach ($columns as $column) {
                if (Schema::hasColumn('properties', $column)) {
                    $table->dropColumn($column);
                }
            }
        });
    }
};