<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // 1. Copy data dari user_id ke owner_id jika ada data dengan user_id
        if (Schema::hasColumn('properties', 'user_id') && Schema::hasColumn('properties', 'owner_id')) {
            DB::table('properties')
                ->whereNull('owner_id')
                ->whereNotNull('user_id')
                ->update(['owner_id' => DB::raw('user_id')]);
        }

        // 2. Set default owner_id = 1 untuk data yang masih NULL (jika ada user dengan id = 1)
        $firstUser = DB::table('users')->first();
        if ($firstUser) {
            DB::table('properties')
                ->whereNull('owner_id')
                ->update(['owner_id' => $firstUser->id]);
        }

        // 3. Drop user_id column jika ada
        if (Schema::hasColumn('properties', 'user_id')) {
            Schema::table('properties', function (Blueprint $table) {
                // Drop foreign key dulu jika ada
                try {
                    $table->dropForeign(['user_id']);
                } catch (Exception $e) {
                    // Ignore if foreign key doesn't exist
                }
                $table->dropColumn('user_id');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Add user_id back if needed
        if (!Schema::hasColumn('properties', 'user_id')) {
            Schema::table('properties', function (Blueprint $table) {
                $table->foreignId('user_id')->nullable()->constrained()->onDelete('cascade');
                // Copy data back from owner_id to user_id
                DB::table('properties')->update(['user_id' => DB::raw('owner_id')]);
            });
        }
    }
};