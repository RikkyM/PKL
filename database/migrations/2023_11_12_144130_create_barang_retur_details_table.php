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
        Schema::create('barang_retur_details', function (Blueprint $table) {
            $table->id()->comment('id');
            $table->foreignId('barang_retur_id')->comment('barang retur id')->constrained('barang_returs')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('id_barang')->comment('id barang')->constrained('barangs')->onDelete('cascade')->onUpdate('cascade');
            $table->integer('qty')->comment('quantity');
            $table->integer('harga')->comment('harga');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('barang_retur_details');
    }
};
