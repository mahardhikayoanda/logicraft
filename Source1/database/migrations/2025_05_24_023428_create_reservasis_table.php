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
    Schema::create('reservasis', function (Blueprint $table) {
    $table->id();
    $table->string('nama_tamu');
    $table->string('email');
    $table->string('no_hp');
    $table->date('tanggal_checkin');
    $table->date('tanggal_checkout');
    $table->string('tipe_kamar');
    $table->timestamps();
    $table->softDeletes(); // Tambahkan ini
});
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservasis');
    }
};
