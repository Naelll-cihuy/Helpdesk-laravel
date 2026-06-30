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
        Schema::create('complaints', function (Blueprint $table) {
    $table->id();

    $table->string('kode_laporan')->unique();

    $table->foreignId('user_id')->constrained()->cascadeOnDelete();

    $table->foreignId('device_id')->constrained()->cascadeOnDelete();

    $table->foreignId('technician_id')
          ->nullable()
          ->constrained('users')
          ->nullOnDelete();

    $table->string('judul');
    $table->text('deskripsi');

    $table->date('tanggal_lapor');

    $table->enum('status',[
        'Pending',
        'Diproses',
        'Remote',
        'Kunjungan Lokasi',
        'Menunggu Sparepart',
        'Selesai'
    ])->default('Pending');

    $table->timestamps();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('complaints');
    }
};
