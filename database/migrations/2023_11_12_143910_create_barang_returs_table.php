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
        Schema::create('barang_returs', function (Blueprint $table) {
            $table->id()->comment('id');
            // $table->string('no_faktur');
            $table->foreignId('no_faktur')->comment('nomor faktur')->constrained('invoices')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('id_toko')->comment('id toko')->constrained('tokos')->onUpdate('cascade')->onDelete('cascade');
            $table->string('note', 100)->nullable()->comment('note');
            $table->string('alasan_retur', 15)->nullable()->comment('alasan retur');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('barang_returs');
    }
};
