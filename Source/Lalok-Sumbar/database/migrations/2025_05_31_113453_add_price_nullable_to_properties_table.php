<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('properties', function (Blueprint $table) {
            // Jika kolom price sudah ada, ubah menjadi nullable
            $table->decimal('price', 15, 2)->nullable()->change();
        });
    }

    public function down()
    {
        Schema::table('properties', function (Blueprint $table) {
            $table->decimal('price', 15, 2)->nullable(false)->change();
        });
    }
};