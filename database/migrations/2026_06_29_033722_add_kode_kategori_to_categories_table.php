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
    Schema::table('categories', function (Blueprint $table) {

        $table->string('kode_kategori',3)
              ->after('nama_kategori')
              ->unique();

    });
}

public function down(): void
{
    Schema::table('categories', function (Blueprint $table) {

        $table->dropColumn('kode_kategori');

    });
}
};
