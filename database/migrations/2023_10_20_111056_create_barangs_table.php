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
        Schema::create('barangs', function (Blueprint $table) {
            $table->id()->comment('id');
            $table->string('nama_barang', 25)->comment('nama barang');
            $table->string('kode_barang', 5)->comment('kode barang');
            $table->integer('harga_barang')->comment('harga barang');
            $table->integer('stock')->comment('stock');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('barangs');
    }
};
