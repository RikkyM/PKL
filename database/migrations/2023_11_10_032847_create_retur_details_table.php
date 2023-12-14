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
        Schema::create('retur_details', function (Blueprint $table) {
            $table->id()->comment('id');
            $table->foreignId('id_retur')->comment('id retur')->constrained('returs')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('id_barang')->comment('')->constrained('barangs')->onUpdate('cascade');
            $table->integer('qty')->comment('');
            $table->integer('harga')->comment('');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('retur_details');
    }
};
