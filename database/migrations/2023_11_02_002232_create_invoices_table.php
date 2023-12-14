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
        Schema::create('invoices', function (Blueprint $table) {
            $table->id()->comment('id');
            $table->foreignId('id_toko')->comment('id toko')->constrained('tokos')->onUpdate('cascade');
            $table->foreignId('id_sopir')->comment('id sopir')->constrained('users')->onUpdate('cascade');
            $table->foreignId('id_mobil')->comment('id mobil')->constrained('mobils')->onUpdate('cascade');
            $table->string('no_faktur', 12)->comment('nomor faktur');
            $table->date('tanggal')->comment('tanggal');
            $table->integer('total')->length(8)->comment('total');
            $table->string('note', 100)->nullable()->comment('note');
            $table->enum('status', ['Proses', 'Selesai'])->default('Proses')->comment('status');
            $table->enum('tagihan', ['Lunas', 'Belum Lunas'])->default('Belum Lunas')->comment('tagihan');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invoices');
    }
};
